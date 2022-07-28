<?php

namespace App\Modules\User_comp\Controllers;

use App\Core_modules\User\Model\User;
use App\Http\Controllers\Controller;
use App\Modules\Compliance\Model\Compliance;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Schema;
use App\Modules\User_comp\Model\User_comp;

class AdminUser_compController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page['title'] = 'User_comp';
        return view("User_comp::index",compact('page'));

        //
    }
    /**
     * Get datatable format json file.
     *
     *
     */

    public function getuser_compsJson(Request $request)
    {
        $user_comp = new User_comp;
        $where = $this->_get_search_param($request);

        // For pagination
        $filterTotal = $user_comp->where( function($query) use ($where) {
            if($where !== null) {
                foreach($where as $val) {
                    $query->orWhere($val[0],$val[1],$val[2]);
                }
            }
        })->orderBy('id', 'DESC')->get();

        // Display limited list
        $rows = $user_comp->where( function($query) use ($where) {
            if($where !== null) {
                foreach($where as $val) {
                    $query->orWhere($val[0],$val[1],$val[2]);
                }
            }
        })->limit($request->length)->offset($request->start)->orderBy('id', 'DESC')->get();

        //To count the total values present
        $total = $user_comp->get();


        echo json_encode(['draw'=>$request['draw'],'recordsTotal'=>count($total),'recordsFiltered'=>count($filterTotal),'data'=>$rows]);


    }

    /**
     *Search Params
     *
     * @return \Illuminate\Http\Response
     */


    public function _get_search_param($params)
    {
        $where = null;
        foreach ($params['columns'] as $value) {
            if($value['searchable'] == 'true'){

                if($params['search']['value'] != '')
                {
                    $where[] = [ $value['name'], 'like' , "%".$params['search']['value']."%" ];
                }

                if($value['search']['value'] != '')
                {
                }
            }
        }

        return $where;

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page['title'] = 'User_comp | Create';
        $compliances = Compliance::select('type')->distinct()->get();
        return view("User_comp::add",compact('page', 'compliances'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $uploadPath = public_path('uploads/compliance/');
            $data['picture'] = $this->fileUpload($file, $uploadPath);
        }
        $compliance = Compliance::where('type', $request->comp_id)->first();
        $data['comp_id'] = $compliance->id;
        $success = User_comp::Create($data);
        return redirect()->route('admin.user_comps');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_comp = User_comp::where('id',$id)->with('compliance', 'dcp.user')->get();
        $page['title'] = 'User_comp | Update';
        return view("User_comp::edit",compact('page','user_comp'));

        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->except('_token', '_method', 'picture');
        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $uploadPath = public_path('uploads/compliance/');
            $data['picture'] = $this->fileUpload($file, $uploadPath);
        }
        $success = User_comp::where('id', $request->id)->update($data);
        return redirect()->route('admin.user_comps');

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $success = User_comp::where('id', $id)->delete();
        return redirect()->route('admin.user_comps');

        //
    }

    public function fileUpload($file, $path){
        $ext = $file->getClientOriginalExtension();
        $imageName = md5(microtime()) . '.' . $ext;
        if (!$file->move($path, $imageName)) {
            return redirect()->back();
        }
        return $imageName;
    }

    public function getDcp(Request $request){
        if(!isset($request->searchTerm)){
            $fetchData = User::select('*')->where('role', 2)->orWhere('role', 3)->limit(5)->get();
            $data = array();
            foreach ($fetchData as  $row){
                $data[] = array(
                    'id' => $row->id,
                    'text' => $row->email
                );
            }
        }
        else{
            $search = $request->searchTerm;
            $fetchData = User::where('email', 'like', '%'.$search.'%' )->where('role', 2)->orWhere('role', 3)->limit(5)->get();
            $data = array();
            foreach ($fetchData as  $row){
                $data[] = array(
                    'id' => $row->id,
                    'text' => $row->email
                );
            }
        }
        echo json_encode($data);
    }
}
