<?php

namespace App\Modules\User_immunization\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Immunization\Model\Immunization;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Schema;
use App\Modules\User_immunization\Model\User_immunization;

class AdminUser_immunizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page['title'] = 'User_immunization';
        return view("User_immunization::index",compact('page'));

        //
    }
    /**
     * Get datatable format json file.
     *
     *
     */

    public function getuser_immunizationsJson(Request $request)
    {
        $user_immunization = new User_immunization;
        $where = $this->_get_search_param($request);

        // For pagination
        $filterTotal = $user_immunization->where( function($query) use ($where) {
            if($where !== null) {
                foreach($where as $val) {
                    $query->orWhere($val[0],$val[1],$val[2]);
                }
            }
        })->orderBy('id', 'DESC')->get();

        // Display limited list
        $rows = $user_immunization->where( function($query) use ($where) {
            if($where !== null) {
                foreach($where as $val) {
                    $query->orWhere($val[0],$val[1],$val[2]);
                }
            }
        })->limit($request->length)->offset($request->start)->orderBy('id', 'DESC')->get();

        //To count the total values present
        $total = $user_immunization->get();


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
        $page['title'] = 'User_immunization | Create';
        $immunizations = Immunization::select('type')->distinct()->get();
        return view("User_immunization::add",compact('page', 'immunizations'));
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
        $data = $request->except('_token', 'picture');
        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $uploadPath = public_path('uploads/immunization/');
            $data['picture'] = $this->fileUpload($file, $uploadPath);
        }
        $imm = Immunization::where('type', $request->imm_id)->first();
        $data['imm_id'] = $imm->id;
        $success = User_immunization::Create($data);
        return redirect()->route('admin.user_immunizations');
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
        $user_immunization = User_immunization::where('id',$id)->with('dcp.user', 'immunization')->first();
        $page['title'] = 'User_immunization | Update';
        return view("User_immunization::edit",compact('page','user_immunization'));

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
            $uploadPath = public_path('uploads/immunization/');
            $data['picture'] = $this->fileUpload($file, $uploadPath);
        }
        $success = User_immunization::where('id', $request->id)->update($data);
        return redirect()->route('admin.user_immunizations');

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
        $success = User_immunization::where('id', $id)->delete();
        return redirect()->route('admin.user_immunizations');

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
}
