<?php

namespace App\Modules\DCP_Invoice\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Booking_status\Model\Booking_status;
use App\Modules\Dcp\Model\Dcp;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Schema;
use App\Modules\Timesheet\Model\Timesheet;

class AdminDCPInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page['title'] = 'DCP Invoice';
        return view("DCP_Invoice::index",compact('page'));

        //
    }
    /**
     * Get datatable format json file.
     *
     *
     */

    public function gettimesheetsJson(Request $request)
    {
        $dcp = new Dcp;
        $where = $this->_get_search_param($request);

        // For pagination
        $filterTotal = $dcp->join('users', 'users.id', '=', 'dcp.user_id')->join('staff', 'staff.id', '=', 'dcp.staff_id')->where( function($query) use ($where) {
            if($where !== null) {
                foreach($where as $val) {
                    $query->orWhere($val[0],$val[1],$val[2]);
                }
            }
        })->whereHas('user', function($q){
            return $q->whereNotNull('email_verified_at')->Where('role', 2)->orWhere('role', 3);
        })->orderBy('dcp.id', 'DESC')->get();

        // Display limited list
        $rows = $dcp->join('users', 'users.id', '=', 'dcp.user_id')->join('staff', 'staff.id', '=', 'dcp.staff_id')->where( function($query) use ($where) {
            if($where !== null) {
                foreach($where as $val) {
                    $query->orWhere($val[0],$val[1],$val[2]);
                }
            }
        })->whereHas('user', function($q){
            return $q->whereNotNull('email_verified_at')->Where('role', 2)->orWhere('role', 3);
        })->limit($request->length)->offset($request->start)
            ->select('users.name', 'users.email', 'staff.type', 'users.role', 'dcp.id')
            ->orderBy('dcp.id', 'DESC')->with('user')->with('staff')->get();

        //To count the total values present
        $total = $dcp->get();


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
        $page['title'] = 'Timesheet | Create';
        return view("DCP_Invoice::add",compact('page'));
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
        $success = Timesheet::Create($data);
        return redirect()->route('admin.dcpInvoice');
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
//        $timesheets = Booking_status::where('user_id', $id)->whereHas('booking', function($q){
//            return $q->where('status', '!=', 0)->with('timesheet');
//        })->get();
        $timesheets = timesheet::whereHas('booking.booking_status', function($q) use($id){
            return $q->where('user_id', $id);
        })->get();

        $page['title'] = 'DCP Invoice | Detail';
        return view("DCP_Invoice::edit",compact('page','timesheets', 'id'));

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
        $success = Timesheet::where('id', $request->id)->update($data);
        return redirect()->route('admin.dcpInvoice');

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
        $success = Timesheet::where('id', $id)->delete();
        return redirect()->route('admin.dcpInvoice');

        //
    }

    public function payableHours(Request $request){
        $till_date = $request->till_date;
        $id = $request->user_id;

        $timesheet = Booking_status::where('user_id', $id)->whereHas('booking.timesheet', function($q) use($till_date){
            return $q->where('status', 1)->whereDate('created_at', '<=', $till_date);
        })->get();

//        $timesheets = timesheet::whereHas('booking.booking_status', function($q) use($id){
//            return $q->where('user_id', $id);
//        })->get();
//
//        $page['title'] = 'DCP Invoice | Detail';
//        $total_time = null;
        $total_time = $timesheet->sum("total_hours");

        echo($till_date);
//        return view("DCP_Invoice::edit",compact('page','timesheets', 'id', 'total_time'));
//        return redirect()->back()->with(compact('total_time', 'timesheets', 'id', 'page'));

    }
}
