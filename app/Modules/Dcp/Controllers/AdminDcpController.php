<?php

namespace App\Modules\Dcp\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Availability\Model\Availability;
use App\Modules\Booking\Model\Booking;
use App\Modules\Day\Model\Day;
use App\Modules\Staff\Model\Staff;
use App\Core_modules\User\Model\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Schema;
use App\Modules\Dcp\Model\Dcp;

class AdminDcpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page['title'] = 'Dcp';
        return view("Dcp::index",compact('page'));

        //
    }
    /**
     * Get datatable format json file.
     *
     *
     */

    public function getdcpsJson(Request $request)
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
        $page['title'] = 'Dcp | Create';
        $staffs = Staff::all();
        return view("Dcp::add",compact('page', 'staffs'));
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
        $dcp = new Dcp();
        $request->validate([
            'password' => 'required|confirmed|min:6'
        ]);
        if(User::where('email', $request->email)->exists()){
            return redirect()->back()->with('error', 'Email already exists');
        }
        $user_data = [
            'name' => $request->full_name,
            'email' => $request->email,
            'contact' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'email_verified_at' => Carbon::now()->toDateTimeString(),
            'status' => 0,
        ];
        $user = User::create($user_data);
        $data = [
            'id' => $user->id,
            'user_id' => $user->id,
//            'staff_id' => $request->staff_id,
            'employment_history' => $request->employment_history,
            'status' => 0,
        ];
        $success = $dcp->Create($data)->staff()->attach($request->staff_id);
        return redirect()->route('admin.dcps');
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
        $dcp = Dcp::where('id', $id)->with('user')->with('practice.user')->first();
        if($dcp->user->role == 2){
            $availability = Dcp::where('id', $id)->with('user.available_dates')->first();
        }else{
            $availability = Dcp::where('id', $id)->with('user.availability')->first();
        }
        $days = Day::all();
        $staffs = Staff::all();
        $page['title'] = 'Dcp | Update';
        return view("Dcp::edit",compact('page','dcp', 'staffs', 'days', 'availability'));

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
//        $data = $request->except('_token', '_method');
        $user_data = [
            'name' => $request->full_name,
            'contact' => $request->phone,
            'role' => $request->role,
            'email_verified_at' => Carbon::now()->toDateTimeString(),
            'status' => $request->status,
        ];
        $user = User::where('id', $request->user_id)->update($user_data);
        $data = [
            'user_id' => $request->user_id,
            'staff_id' => $request->staff_id,
            'employment_history' => $request->employment_history,
        ];
        $success = Dcp::where('id', $request->id)->update($data);
        return redirect()->route('admin.dcps');

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
        $success = Dcp::where('id', $id)->delete();
        return redirect()->route('admin.dcps');

        //
    }

    public function history(Request $request){
        if(!isset($request->searchTerm)){
            $fetchData = User::select('*')->where('role', 1)->where('status', 1)->orderBy('name')->limit(5)->get();
            $data = array();
            foreach ($fetchData as  $row){
                $data[] = array(
                    'id' => $row->id,
                    'text' => $row->name
                );
            }
        }
        else{
            $search = $request->searchTerm;
//            $fetchData = City::with('state')->where('name', 'like', '%'. $search .'%')->whereHas('state', function($q) use($search, $country_id){
//                $q->where('country_id', $country_id)->orWhere('name', 'like', '%'. $search .'%');
//            })
//            ->limit(5)
//            ->get();
//            $fetchData = \Illuminate\Support\Facades\DB::select('SELECT cities.name AS city, cities.id, states.name AS state FROM cities JOIN states ON states.id = cities.state_id WHERE (cities.name LIKE "%'.$search.'%" OR states.name LIKE "%'.$search.'%") AND states.country_id = '.$country_id.' LIMIT 5');
            $fetchData = User::where('name', 'like', '%'.$search.'%' )->where('role', 1)->limit(5)->get();
            $data = array();
            foreach ($fetchData as  $row){
                $data[] = array(
                    'id' => $row->id,
                    'text' => $row->name
                );
            }
        }
        echo json_encode($data);
    }

    public function listBookings($id){
        $bookings = Booking::where('status', 1)
            ->whereHas('booking_status.user', function ($q) use($id){
                return $q->where('id', $id);
            })->with('practice.user')->get();

        $page['title'] = 'Dcp | Assigned Bookings';
        return view("Dcp::bookings",compact('page', 'bookings'));
    }

    public function availability(Request $request){
        if($request->role == 3){
            $dcp = Dcp::where('id', $request->dcp_id)->with('user.availability')->first();
            $dcp->user->availability()->delete();
            for($i=0; $i<count($request->available_days); $i++){
                $data = [
                    'user_id' => $dcp->user->id,
                    'days_id' => $request->available_days[$i],
                ];
                Availability::create($data);
            }
        }else{

        }

        return redirect()->route('admin.dcps');
    }
}
