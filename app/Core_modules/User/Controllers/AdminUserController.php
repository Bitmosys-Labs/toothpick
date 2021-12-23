<?php

namespace App\Core_modules\User\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CoreController;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Schema;
use App\Core_modules\User\Model\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Core_modules\Role\Model\Role;
use App\Core_modules\Role_user\Model\Role_user;
use Yajra\DataTables\Facades\DataTables;


class AdminUserController extends CoreController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page['title'] = 'User';
        $roles = Role::all();
        return view("User::index",compact('page','roles'));

        //
    }
    /**
     * Get datatable format json file.
     *
     *
     */

    public function getusersJson(Request $request)
    {
        $where = $this->_get_search_param($request);
        $users = User::where( function($query) use ($where) {
            if($where !== null) {
                foreach($where as $val) {
                    $query->orWhere($val[0],$val[1],$val[2]);
                }
            }
        })->limit($request->length)->offset($request->start)->with("roles");

        return DataTables::of($users)
            ->addColumn('roles', function ($users) {
               foreach ($users->roles as $role){
                   return $role->name;
               }
            })
            ->make(true);
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
        $page['title'] = 'User | Create';
        $roles = Role::all();
        return view("User::add",compact('page','roles'));
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
        $data = $request->except('_token','roles');
        $id = $request->id;
        $role_store = $request->roles;
        if(!$id) {
            $this->validate($request, [
                'username' => 'required|unique:users,username',
                'password' => 'required|min:6',
                'confirm_password' => 'required|min:6|same:password',
                'email' => 'required|email|unique:users,email'
            ],
                [
                    'username.required' => 'Username Cannot Be Empty!!',
                    'password.required' => 'Password Cannot Be Empty!!',
                    'confirm_password.same' => 'Password and Confirm Password Doesnot Match!!',
                    'confirm_password.required' => 'Confirm Password Cannot Be Empty!!',
                    'email.required' => 'Email Cannot Be Empty!!',
                ]);
            $data['status'] = 1;
            $data['control'] = 0;
            $data['last_visit'] = date('Y-m-d H:m:s');
            $data['created_at'] = date('Y-m-d H:m:s');
            $data['updated_at'] = date('Y-m-d H:m:s');
            $data['password'] = Hash::make($request->password);
            $data['name'] = $request->username;
            // $data[]
            $user = User::Create($data);
            $user->assignRole($role_store);
            if($user){
                $success = true;
            }else{
                $success = false;
            }
        }else{
            if($request->password == null){
                $this->validate($request, [
                    'username' => 'required|unique:users,username,'.$id,
                    'email' => 'required|email|unique:users,email,'.$id
                ],
                    [
                        'username.required' => 'Username Cannot Be Empty!!',
                        'email.required' => 'Email Cannot Be Empty!!',
                    ]);
               $data = $request->except('_token','_method','password','confirm_password','roles');
               $success =  User::where('id',$id)->update($data);
               $user = User::find($id);
                $user->syncRoles($role_store);
               if($success){
                   $success = true;
               }else{
                   $success = false;
               }
            }else{
                $this->validate($request, [
                    'username' => 'required|unique:users,username,'.$id,
                    'password' => 'required|min:6',
                    'confirm_password' => 'required|min:6|same:password',
                    'email' => 'required|email|unique:users,email,'.$id
                ],
                    [
                        'username.required' => 'Username Cannot Be Empty!!',
                        'password.required' => 'Password Cannot Be Empty!!',
                        'confirm_password.same' => 'Password and Confirm Password Doesnot Match!!',
                        'confirm_password.required' => 'Confirm Password Cannot Be Empty!!',
                        'email.required' => 'Email Cannot Be Empty!!',
                    ]);
                $data = $request->except('_token','_method','confirm_password','roles');
                $data['password'] = Hash::make($request->password);
                $success =  User::where('id',$id)->update($data);
                $user = User::find($id);
                $user->syncRoles($role_store);
                if($success){
                    $success = true;
                }else{
                    $success = false;
                }
            }

        }
        return response()->json(['success'=>$success]);
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
        $user = User::findOrFail($id);
        $roles = Role::all();
        $user_role = Role_user::where('user_id',$user->id)->first();
        $page['title'] = 'User | Update';
        return view("User::edit",compact('page','user','roles','user_role'));

        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

            $user = User::find($request->get('id'));
            $newPassword = $request->get('password');
            $checkPassword = Hash::check($newPassword,$user->password);
           // if( $checkPassword){
           //      echo "yes";
           //      exit();
           // }
           // else{
           //  echo "no";
           //  exit();
           // }

            if ($request->username == $user->username ) {
                if ($request->email == $user->email) {
                    if($request->password == null){
                        $this->validate($request, [
                            'username' => 'required|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
                            'email' => 'required|email',
                        ],
                        [
                            'username.required' => 'Username Cannot Be Empty!!',
                            'email.required' => 'Email Cannot Be Empty!!',
                        ]);
                    }
                    elseif(!$checkPassword){
                        $this->validate($request, [
                            'username' => 'required|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
                            'email' => 'required|email',
                            'password' => 'required|min:6',
                            'confirm_password' => 'required|min:6|same:password',
                        ],
                        [
                            'username.required' => 'Username Cannot Be Empty!!',
                            'email.required' => 'Email Cannot Be Empty!!',
                            'password.required' => 'Password Cannot Be Empty!!',
                            'confirm_password.same' => 'Password and Confirm Password Doesnot Match!!',
                            'confirm_password.required' => 'Confirm Password Cannot Be Empty!!',
                        ]);
                    }

                } elseif ($request->email != $user->email) {
                    if($request->password == null){
                        $this->validate($request, [
                            'username' => 'required|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
                            'email' => 'required|email|unique:users,email',
                        ],
                        [
                            'username.required' => 'Username Cannot Be Empty!!',
                            'email.required' => 'Email Cannot Be Empty!!',

                        ]);
                    }
                    elseif(!$checkPassword){
                        $this->validate($request, [
                            'username' => 'required|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
                            'email' => 'required|email|unique:users,email',
                            'password' => 'required|min:6',
                            'confirm_password' => 'required|min:6|same:password',
                        ],
                        [
                            'username.required' => 'Username Cannot Be Empty!!',
                            'email.required' => 'Email Cannot Be Empty!!',
                            'password.required' => 'Password Cannot Be Empty!!',
                            'confirm_password.same' => 'Password and Confirm Password Doesnot Match!!',
                            'confirm_password.required' => 'Confirm Password Cannot Be Empty!!',
                        ]);
                    }

                }
            }
            elseif ($request->username != $user->username ) {
                if ($request->email == $user->email) {
                    if($request->password == null){
                        $this->validate($request, [
                            'username' => 'required|regex:/(^([a-zA-Z]+)(\d+)?$)/u|unique:users,username',
                            'email' => 'required|email'
                        ],
                        [
                            'username.required' => 'Username Cannot Be Empty!!',
                            'username.unique' => 'Username Has Already Been Taken!!',
                            'email.required' => 'Email Cannot Be Empty!!',
                        ]);
                    }
                    elseif(!$checkPassword){
                        $this->validate($request, [
                            'username' => 'required|regex:/(^([a-zA-Z]+)(\d+)?$)/u|unique:users,username',
                            'email' => 'required|email',
                            'password' => 'required|min:6',
                            'confirm_password' => 'required|min:6|same:password',
                        ],
                        [
                            'username.required' => 'Username Cannot Be Empty!!',
                            'username.unique' => 'Username Has Already Been Taken!!',
                            'email.required' => 'Email Cannot Be Empty!!',
                            'password.required' => 'Password Cannot Be Empty!!',
                            'confirm_password.same' => 'Password and Confirm Password Doesnot Match!!',
                            'confirm_password.required' => 'Confirm Password Cannot Be Empty!!',
                        ]);
                    }

                } else if ($request->email != $user->email) {
                    if($request->password == null){

                    }
                    elseif (!$checkPassword) {
                        $this->validate($request, [
                            'username' => 'required|regex:/(^([a-zA-Z]+)(\d+)?$)/u|unique:users,username',
                            'email' => 'required|email|unique:users,email',
                            'password' => 'required|min:6',
                            'confirm_password' => 'required|min:6|same:password',
                        ],
                        [
                            'username.required' => 'Username Cannot Be Empty!!',
                            'username.unique' => 'Username Has Already Been Taken!!',
                            'email.required' => 'Email Cannot Be Empty!!',
                            'password.required' => 'Password Cannot Be Empty!!',
                            'confirm_password.same' => 'Password and Confirm Password Doesnot Match!!',
                            'confirm_password.required' => 'Confirm Password Cannot Be Empty!!',
                        ]);
                    }

                }
            }
            DB::table('role_user')->where('user_id',$id)->delete();
        $success1 = DB::table('role_user')->insert(['user_id'=>$id,'role_id'=>$request->roles]);
        if($newPassword == null)
        {
            $data = $request->except('_token','_method','password','confirm_password','roles');
        }
        else{
            $data = $request->except('_token','_method','confirm_password','roles');
            $data['password'] = Hash::make($request->password);
        }
        $data['status'] = 1;
        $data['control'] = 0;
        $data['last_visit'] = date('Y-m-d H:m:s');
        $data['updated_at'] = date('Y-m-d H:m:s');

        $success = User::where('id', $id)->update($data);
        return redirect()->route('admin.users');

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
        $success = User::where('id', $id)->delete();
        return redirect()->route('admin.users');

        //
    }
}
