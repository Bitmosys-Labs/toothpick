<?php

namespace App\Modules\Booking\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Booking_status\Model\Booking_status;
use App\Modules\Parking\Model\Parking;
use App\Modules\Practice\Model\Practice;
use App\Modules\Staff\Model\Staff;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Schema;
use App\Modules\Booking\Model\Booking;
use Illuminate\Support\Str;

class AdminBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page['title'] = 'Booking';
        return view("Booking::index",compact('page'));

        //
    }
    /**
     * Get datatable format json file.
     *
     *
     */

    public function getbookingsJson(Request $request)
    {
        $booking = new Booking();
        $where = $this->_get_search_param($request);

        // For pagination
        $filterTotal = $booking
            ->where( function($query) use ($where) {
            if($where !== null) {
                foreach($where as $val) {
                    $query->orWhere($val[0],$val[1],$val[2]);
                }
            }
        })
            ->join('staff', 'booking.staff_id', 'staff.id')
            ->join('users', 'booking.practice_id', 'users.id')
            ->select('users.name', 'staff.type', 'booking.id', 'booking.status', 'booking.date', 'booking.slug')
            ->orderBy('booking.id', 'DESC')->get();

        // Display limited list
        $rows = $booking
            ->where( function($query) use ($where) {
            if($where !== null) {
                foreach($where as $val) {
                    $query->orWhere($val[0],$val[1],$val[2]);
                }
            }
        })
            ->join('staff', 'booking.staff_id', 'staff.id')
            ->join('users', 'booking.practice_id', 'users.id')
            ->select('users.name', 'staff.type', 'booking.id', 'booking.status', 'booking.date', 'booking.slug')
            ->limit($request->length)->offset($request->start)->orderBy('booking.id', 'DESC')->get();

        //To count the total values present
        $total = $booking->get();


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
        $page['title'] = 'Booking | Create';
        $staffs = Staff::all();
        $parkings = Parking::all();
        return view("Booking::add",compact('page', 'staffs', 'parkings'));
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
        $practice = \App\Core_modules\User\Model\User::where('id', $request->practice_id)->first();
        do{
            $slug = strtoupper(str::slug(substr($practice->name, 0, 2).' '.substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 6), '-'));
        }while(Booking::where('slug', $slug)->exists());
        $data['slug'] = $slug;
        $data['status'] = 0;
        $success = Booking::Create($data);
        return redirect()->route('admin.bookings');
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
        $booking = Booking::findOrFail($id);
        $page['title'] = 'Booking | Update';
        $staffs = Staff::all();
        $parkings = Parking::all();
        return view("Booking::edit",compact('page','booking', 'staffs', 'parkings'));

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
        $data = $request->except('_token', '_method', 'files', 'nurse');
        if($request->nurse){
            $data['status'] = 1;
            $assign_data = [
                'id' => $request->id,
                'user_id' => $request->nurse,
            ];
            if(Booking_status::where('id', $request->id)->exists()){
                Booking_status::where('id',$request->id)->update($assign_data);
            }else{
                Booking_status::create($assign_data);
            }
        }
        $success = Booking::where('id', $request->id)->update($data);
        return redirect()->route('admin.bookings');

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
        $success = Booking::where('id', $id)->delete();
        return redirect()->route('admin.bookings');

        //
    }

    public function assignNurse(Request $request){
        if(!isset($request->searchTerm)){
            $full = $request->full_time;
            $part = $request->part_time;
            $fetchData = User::where(function ($query) use($full, $part){
                if($full){
                    $query->Where('role', 3);
                }
                elseif($part){
                    $query->where('role', 2);
                }
                else{
                    $query->where('role', 2)
                        ->orWhere('role', 3);
                }
            })->where('status', 2)->limit(7)->get();
            $data = array();
            foreach ($fetchData as  $row){
                if(Booking_status::where('user_id', $row->id)->exists()){
                    continue;
                }else{
                    $data[] = array(
                        'id' => $row->id,
                        'text' => $row->name
                    );
                }
            }
        }
        else{
            $search = $request->searchTerm;
            $full = $request->full_time;
            $part = $request->part_time;

//            $fetchData = City::with('state')->where('name', 'like', '%'. $search .'%')->whereHas('state', function($q) use($search, $country_id){
//                $q->where('country_id', $country_id)->orWhere('name', 'like', '%'. $search .'%');
//            })
//            ->limit(5)
//            ->get();
//            $fetchData = \Illuminate\Support\Facades\DB::select('SELECT cities.name AS city, cities.id, states.name AS state FROM cities JOIN states ON states.id = cities.state_id WHERE (cities.name LIKE "%'.$search.'%" OR states.name LIKE "%'.$search.'%") AND states.country_id = '.$country_id.' LIMIT 5');
            $fetchData = User::where('name', 'like', '%'.$search.'%' )->where(function ($query) use($full, $part){
                if($full){
                    $query->Where('role', 3);
                }
                elseif($part){
                    $query->where('role', 2);
                }
                else{
                    $query->where('role', 2)
                        ->orWhere('role', 3);
                }
            })->where('status', 2)->limit(7)->get();
            $data = array();
            foreach ($fetchData as  $row){
                if(Booking_status::where('user_id', $row->id)->exists()){
                    continue;
                }else{
                    $data[] = array(
                        'id' => $row->id,
                        'text' => $row->name
                    );
                }
            }
        }
        echo json_encode($data);
    }
}
