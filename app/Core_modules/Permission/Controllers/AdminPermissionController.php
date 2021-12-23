<?php

namespace App\Core_modules\Permission\Controllers;

use App\Core_modules\User\Model\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CoreController;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Schema;
use App\Core_modules\Permission\Model\Permission;

class AdminPermissionController extends CoreController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page['title'] = 'Permission';
        return view("Permission::index",compact('page'));

        //
    }
    /**
     * Get datatable format json file.
     *
     *
     */

    public function getpermissionsJson(Request $request)
    {
        $permission = new Permission;
        $where = $this->_get_search_param($request);

        // For pagination
        $filterTotal = $permission->where( function($query) use ($where) {
            if($where !== null) {
                foreach($where as $val) {
                    $query->orWhere($val[0],$val[1],$val[2]);
                }
            }
        } )->get();

        // Display limited list
        $rows = $permission->where( function($query) use ($where) {
            if($where !== null) {
                foreach($where as $val) {
                    $query->orWhere($val[0],$val[1],$val[2]);
                }
            }
        })->limit($request->length)->offset($request->start)->get();

        //To count the total values present
        $total = $permission->get();


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
        $page['title'] = 'Permission | Create';
        return view("Permission::add",compact('page'));
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
        $this->validate($request, [
                            'name' => 'required|unique:roles,name',
                            'display_name' => 'required',
                        ],
                        [
                            'name.required' => 'Name Cannot Be Empty!!',
                            'display_name.required' => 'Password Cannot Be Empty!!',
                        ]);
        $data['created_at'] = date('Y-m-d H:m:s');
        $data['updated_at'] = date('Y-m-d H:m:s');
        $data['rank'] = 0;
        $permission = \Spatie\Permission\Models\Permission::Create($data);
        $role = \Spatie\Permission\Models\Role::findOrFail(1);
        $role->givePermissionTo([$permission]);
        return redirect()->route('admin.permissions');
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
        $permission = Permission::findOrFail($id);
        $page['title'] = 'Permission | Update';
        return view("Permission::edit",compact('page','permission'));

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
        $data = $request->except('_token','_method');
        $this->validate($request, [
                            'name' => 'required',
                            'display_name' => 'required',
                        ],
                        [
                            'name.required' => 'Name Cannot Be Empty!!',
                            'display_name.required' => 'Password Cannot Be Empty!!',
                        ]);
        $success = Permission::where('id', $id)->update($data);
        return redirect()->route('admin.permissions');

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
        $success = Permission::where('id', $id)->delete();
        return redirect()->route('admin.permissions');

        //
    }
}
