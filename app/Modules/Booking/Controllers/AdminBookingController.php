<?php

namespace App\Modules\Booking\Controllers;

use App\Core_modules\User\Model\User;
use App\Http\Controllers\Controller;
use App\Mail\bookingAlertMail;
use App\Modules\Booking_status\Model\Booking_status;
use App\Modules\Parking\Model\Parking;
use App\Modules\Practice\Model\Practice;
use App\Modules\Staff\Model\Staff;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
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
        $status = Booking_status::Create([
            'booking_id' => $success->id,
            'date' => $success->date,
        ]);
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
        $booking = Booking::where('id', $id)->with('booking_status.user', 'practice.user')->first();
//        dd($booking);
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
        $data = $request->except('_token', '_method', 'files', 'nurse', 'fulltime', 'parttime');
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
        }else{
            $data['status'] = 0;
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
            $booking_date = $request->booking_date;
            $staff_id = $request->staff_id;
            $fetchData = User::where(function ($query) use($full, $part, $booking_date, $staff_id){
//                if($full){
//                    $query->Where('role', 3)->whereHas('availability.days', function ($q) use ($booking_date){
//                        return $q->where('days.day', date('l', strtotime($booking_date)));
//                    })->whereHas('dcp.staff', function ($q) use($staff_id){
//                        return $q->where('staff.id', $staff_id);
//                    });
//                }
//                elseif($part){
                    $query->where('role', 2)->whereHas('available_dates',function ($q) use($booking_date){
                        return $q->where('date', $booking_date);
                    })->whereHas('dcp.staff', function ($q) use($staff_id){
                        return $q->where('staff.id', $staff_id);
                    });
//                }
//                else{
//                    $query->where('role', 2)->whereHas('available_dates',function ($q) use($booking_date){
//                        return $q->where('date', $booking_date);
//                    })
//                        ->orWhere('role', 3)->whereHas('availability.days', function ($q) use ($booking_date){
//                            return $q->where('days.day', date('l', strtotime($booking_date)));
//                        })->whereHas('dcp.staff', function ($q) use($staff_id){
//                            return $q->where('staff.id', $staff_id);
//                        });
//                }
            })->where('status', 2)->limit(7)->get();
            $data = array();
            foreach ($fetchData as  $row){
                if(Booking_status::where('user_id', $row->id)->where('date', $booking_date)->exists()){
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
            $booking_date = $request->booking_date;
            $full = $request->full_time;
            $part = $request->part_time;
            $staff_id = $request->staff_id;
            $fetchData = User::where('name', 'like', '%'.$search.'%' )->where(function ($query) use($full, $part, $booking_date, $staff_id){
                if($full){
                    $query->Where('role', 3)->whereHas('availability.days', function ($q) use ($booking_date){
                        return $q->where('days.day', date('l', strtotime($booking_date)));
                    })->whereHas('dcp.staff', function ($q) use($staff_id){
                        return $q->where('staff.id', $staff_id);
                    });
                }
                elseif($part){
                    $query->where('role', 2)->whereHas('available_dates',function ($q) use($booking_date){
                        return $q->where('date', $booking_date);
                    })->whereHas('dcp.staff', function ($q) use($staff_id){
                        return $q->where('staff.id', $staff_id);
                    });
                }
                else{
                    $query->where('role', 2)->whereHas('available_dates',function ($q) use($booking_date){
                        return $q->where('date', $booking_date);
                    })
                        ->orWhere('role', 3)->whereHas('availability.days', function ($q) use ($booking_date){
                            return $q->where('days.day', date('l', strtotime($booking_date)));
                        })->whereHas('dcp.staff', function ($q) use($staff_id){
                            return $q->where('staff.id', $staff_id);
                        });
                }
            })->where('status', 2)->limit(7)->get();
            $data = array();
            foreach ($fetchData as  $row){
                if(Booking_status::where('user_id', $row->id)->where('date', $booking_date)->exists()){
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

    public function getAssignedNurse(Request $request)
    {
        $booking_id = $request->id;
        $booking = Booking::select('users.id AS user_id', 'users.name AS user_name', 'booking.id AS booking_id', 'booking.date AS booking_date')
            ->where('booking.id', $request->id)
            ->join('booking_status', 'booking.id', 'booking_status.id')
            ->join('users', 'booking_status.user_id', 'users.id')
            ->first();
        return response($booking);
    }

    public function removeAssignedNurse(Request $request){
        $booking = Booking::where('id', $request->booking_id)->with('booking_status')->first();
        $booking->update(['status' => 0]);
        $booking->booking_status->update(['user_id' => null]);
        return redirect()->back();
    }

    public function listBooking(){
        $page['title'] = 'Booking | Confirm';
        $bookings = Booking::where('status', 1)->with('booking_status.user', 'practice.user')->get();
        return view("Booking::confirm",compact('page', 'bookings'));
    }

    public function confirmBooking(){
        $bookings = Booking::where('status', 1)->with('booking_status.user')->get();
        $user_ids = array();
        foreach($bookings as $booking){
            array_push($user_ids, $booking->booking_status->user->id);
        }
        $user_id = array_unique($user_ids);

        for($i=0; $i<count($user_id); $i++){
            $booking_list = Booking::where('status', 1)
                ->whereHas('booking_status.user', function ($q) use($user_id, $i){
                    return $q->where('id', $user_id[$i]);
                })->with('practice.user')->get();
            $details = [
              'data' =>   $booking_list
            ];
            $user = User::where('id', $user_id[$i])->first();
            Mail::to($user->email)->send(new bookingAlertMail($details));
        }
        $bookings->update([
            'status' => 2
        ]);
        return redirect()->route('admin.bookings');
    }

    public function bookingCancel(Request $request){
        $booking = Booking::where('id', $request->booking_id)->with('booking_status')->first();
//        $booking_status = Booking_status::where('id', $booking['id'])->first();
        $data = [
            'status' => 4
        ];
        $booking->update($data);
//        if($request->other){
//            $data = [
//                'canceled_by' => $request->by,
//                'reason_for_cancel' => $request->other,
//            ];
//        }else{
            $data = [
                'canceled_by' => $request->by,
                'reason_for_cancel' => $request->reason_for_cancel,
            ];
//        }
        if($booking->booking_status){
            $booking->booking_status->update($data);
        }
        else{
            $status = [
                'id' => $booking->id
            ];
            $booking->booking_status->create($status);
            $booking->booking_status->update($data);
        }
        return redirect()->route('admin.bookings');
//        $response = [
//            'success' => true,
//            'message' => 'Booking Canceled',
//            'result' => null
//        ];
//        return response($response, 200);
    }
}
