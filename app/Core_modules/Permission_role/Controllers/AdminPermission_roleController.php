<?php

namespace App\Core_modules\Permission_role\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CoreController;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Schema;
use App\Core_modules\Permission_role\Model\Permission_role;
use App\Core_modules\Role\Model\Role;
use App\Core_modules\Permission\Model\Permission;

class AdminPermission_roleController extends CoreController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page['title'] = 'Permission_role';
        return view("Permission_role::index",compact('page'));

        //
    }
    /**
     * Get datatable format json file.
     *
     *
     */

    public function getpermission_rolesJson(Request $request)
    {
        $permission_role = new Permission_role;
        $where = $this->_get_search_param($request);

        // For pagination
        $filterTotal = $permission_role->where( function($query) use ($where) {
            if($where !== null) {
                foreach($where as $val) {
                    $query->orWhere($val[0],$val[1],$val[2]);
                }
            }
        } )->get();

        // Display limited list
        $rows = $permission_role->where( function($query) use ($where) {
            if($where !== null) {
                foreach($where as $val) {
                    $query->orWhere($val[0],$val[1],$val[2]);
                }
            }
        })->limit($request->length)->offset($request->start)->get();

        //To count the total values present
        $total = $permission_role->get();


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
        $page['title'] = 'Permission_role | Create';
        $roles = Role::all();
        $permissions = Permission::all();
        return view("Permission_role::add",compact('page','roles','permissions'));
        //
    }

    public function permisson_roles(){
        $permission_role = DB::table('permission_role')->get();
        return response()->json($permission_role);
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
//        $success = Permission_role::Create($data);
        DB::table('permission_role')->delete();
       if(isset($data['role_permission'] )){
           foreach ($data['role_permission'] as $key=>$value){
               $temp = explode("_",$key);
               DB::table('permission_role')->insert([
                   'permission_id'     =>$temp[1],
                   'role_id'           =>$temp[0]
               ]);
           }
       }


        return back();
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
        $permission_role = Permission_role::findOrFail($id);
        $page['title'] = 'Permission_role | Update';
        return view("Permission_role::edit",compact('page','permission_role'));

        //
    }

    public function assignPermissions($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $selected_permission = Permission_role::where('role_id',$id)->pluck('permission_id')->toArray();
        $page['title'] = 'Assign | Update Permissions';
        return view("Permission_role::assignpermission",compact('page','role','permissions','selected_permission'));

        //
    }

    public function assignPermissionsUpdate(Request $request)
    {
        $role = \Spatie\Permission\Models\Role::findOrFail($request->id);
        $permissions = $request->permission;
        $page['title'] = 'Assign | Update Permissions';
        $role->syncPermissions($permissions);
        return redirect()->back()->with('success','Roles Permissions Updated');
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
        $data = $request->except('_token');
        $success = Permission_role::where('id', $id)->update($data);
        return redirect()->route('admin.permission_roles');

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
        $success = Permission_role::where('id', $id)->delete();
        return redirect()->route('admin.permission_roles');

        //
    }
}
