<?php

namespace App\Core_modules\Role\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CoreController;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Schema;
use App\Core_modules\Role\Model\Role;

class AdminRoleController extends CoreController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page['title'] = 'Role';
        return view("Role::index",compact('page'));

        //
    }
    /**
     * Get datatable format json file.
     *
     *
     */

    public function getrolesJson(Request $request)
    {
        $role = new Role;
        $where = $this->_get_search_param($request);

        // For pagination
        $filterTotal = $role->where( function($query) use ($where) {
            if($where !== null) {
                foreach($where as $val) {
                    $query->orWhere($val[0],$val[1],$val[2]);
                }
            }
        } )->get();

        // Display limited list
        $rows = $role->where( function($query) use ($where) {
            if($where !== null) {
                foreach($where as $val) {
                    $query->orWhere($val[0],$val[1],$val[2]);
                }
            }
        })->limit($request->length)->offset($request->start)->get();

        //To count the total values present
        $total = $role->get();


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
        $page['title'] = 'Role | Create';
        return view("Role::add",compact('page'));
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
                        ],
                        [
                            'name.required' => 'Name Cannot Be Empty!!',
                        ]);

        $data['created_at'] = date('Y-m-d H:m:s');
        $data['updated_at'] = date('Y-m-d H:m:s');
        $success = \Spatie\Permission\Models\Role::Create($data);
        return redirect()->route('admin.roles');
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
        $role = Role::findOrFail($id);
        $page['title'] = 'Role | Update';
        return view("Role::edit",compact('page','role'));

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
                            'description' => 'required',
                        ],
                        [
                            'name.required' => 'Name Cannot Be Empty!!',
                            'display_name.required' => 'Password Cannot Be Empty!!',
                            'description.required' => 'Description Cannot Be Empty!!',
                        ]);
        $success = Role::where('id', $id)->update($data);
        return redirect()->route('admin.roles');

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
        $success = Role::where('id', $id)->delete();
        return redirect()->route('admin.roles');

        //
    }
}
