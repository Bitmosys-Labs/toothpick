<?php

namespace App\Modules\Practice\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Dcp\Model\Dcp;
use App\Core_modules\User\Model\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Schema;
use App\Modules\Practice\Model\Practice;

class AdminPracticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page['title'] = 'Practice';
        return view("Practice::index",compact('page'));

        //
    }
    /**
     * Get datatable format json file.
     *
     *
     */

    public function getpracticesJson(Request $request)
    {
        $practice = new Practice;
        $where = $this->_get_search_param($request);

        // For pagination
        $filterTotal = $practice->join('users', 'users.id', '=', 'practice.user_id')->where( function($query) use ($where) {
            if($where !== null) {
                foreach($where as $val) {
                    $query->orWhere($val[0],$val[1],$val[2]);
                }
            }
        })->whereHas('user', function($q){
            return $q->whereNotNull('email_verified_at')->where('role', 1);
        })->orderBy('practice.id', 'DESC')->get();

        // Display limited list
        $rows = $practice->join('users', 'users.id', '=', 'practice.user_id')->where( function($query) use ($where) {
            if($where !== null) {
                foreach($where as $val) {
                    $query->orWhere($val[0],$val[1],$val[2]);
                }
            }
        })->whereHas('user', function($q){
            return $q->whereNotNull('email_verified_at')->where('role', 1);
        })->limit($request->length)->offset($request->start)->with('user')->orderBy('practice.id', 'DESC')
            ->select('users.name', 'users.email', 'practice.owners_name', 'practice.id')->get();

        //To count the total values present
        $total = $practice->get();


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
        $page['title'] = 'Practice | Create';
        return view("Practice::add",compact('page'));
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
        $request->validate([
            'password' => 'required|confirmed|min:6'
        ]);
        if(User::where('email', $request->email)->whereNotNull('email_verified_at')->exists()){
            return redirect()->back()->with('error', 'Email already exists');
        }
//        dd($request->all());
        $user_data = [
            'name' => $request->full_name,
            'email' => $request->email,
            'contact' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 1,
            'email_verified_at' => Carbon::now()->toDateTimeString(),
            'status' => 0,
        ];
        $user = User::create($user_data);
        $data = [
            'id' => $user->id,
            'user_id' => $user->id,
            'payment' => $request->payment,
            'status' => 0,
            'owners_name' => $request->owners_name,
        ];
        $success = Practice::Create($data);
        return redirect()->route('admin.practices');
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
        $practice = Practice::where('id',$id)->with('user')->first();
        $page['title'] = 'Practice | Update';
        return view("Practice::edit",compact('page','practice'));

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
        $user_data = [
            'name' => $request->full_name,
            'contact' => $request->phone,
            'email_verified_at' => Carbon::now()->toDateTimeString(),
            'status' => $request->status,
        ];
        $user = User::where('id', $request->user_id)->update($user_data);
        $data = [
            'user_id' => $request->user_id,
            'owners_name' => $request->owners_name,
            'payment' => $request->payment,
            'parking' => $request->parking,
            'pay_rate' => $request->pay_rate,
        ];
        $success = Practice::where('id', $request->id)->update($data);
        return redirect()->route('admin.practices');

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
        $success = Practice::where('id', $id)->delete();
        return redirect()->route('admin.practices');

        //
    }
}
