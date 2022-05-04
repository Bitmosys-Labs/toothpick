<?php

namespace App\Modules\Compliance\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Staff\Model\Staff;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Schema;
use App\Modules\Compliance\Model\Compliance;

class AdminComplianceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page['title'] = 'Compliance';
        return view("Compliance::index",compact('page'));

        //
    }
    /**
     * Get datatable format json file.
     *
     *
     */

    public function getcompliancesJson(Request $request)
    {
        $compliance = new Compliance;
        $where = $this->_get_search_param($request);

        // For pagination
        $filterTotal = $compliance->where( function($query) use ($where) {
            if($where !== null) {
                foreach($where as $val) {
                    $query->orWhere($val[0],$val[1],$val[2]);
                }
            }
        })->orderBy('compliance.id', 'DESC')->get();

        // Display limited list
        $rows = $compliance->where( function($query) use ($where) {
            if($where !== null) {
                foreach($where as $val) {
                    $query->orWhere($val[0],$val[1],$val[2]);
                }
            }
        })->limit($request->length)->offset($request->start)->orderBy('compliance.id', 'DESC')->with('staff')->get();

        //To count the total values present
        $total = $compliance->get();


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
        $page['title'] = 'Compliance | Create';
        $staffs = Staff::select('id', 'type')->get();
        return view("Compliance::add",compact('page', 'staffs'));
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
        $count = count($request->staff_id);
        for ($i = 0; $i < $count; $i++) {
            $data = [
                'staff_id' => $request->staff_id[$i]  ,
                'type' => $request->type,
                'requirement' => $request->requirement,
            ];
            Compliance::Create($data);
        }
        return redirect()->route('admin.compliances');
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
        $compliance = Compliance::findOrFail($id);
        $staffs = Staff::select('id', 'type')->get();
        $page['title'] = 'Compliance | Update';
        return view("Compliance::edit",compact('page','compliance', 'staffs'));

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
        $data = $request->except('_token', '_method');
        $success = Compliance::where('id', $request->id)->update($data);
        return redirect()->route('admin.compliances');

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
        $success = Compliance::where('id', $id)->delete();
        return redirect()->route('admin.compliances');

        //
    }
}
