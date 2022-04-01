<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Booking\Model\Booking;
use App\Modules\Staff\Model\Staff;
use Illuminate\Http\Request;

class BookingApiController extends Controller
{
    public function staffType(){
        $data = Staff::select('id', 'type')->get();

        $response = [
            'success' => true,
            'message' => 'List of staff type for DCP registration',
            'result' => $data
        ];
        return response($response, 200);
    }

    public function BookingCreate(Request $request){
        $count = count($request->staff_id);
        $booking_info = new Booking();
        for ($i = 0; $i < $count; $i++) {
            $booking_info_data['practice_id'] = auth()->user()->id;
            $booking_info_data['staff_id'] = $request->staff_id[$i];
            $booking_info_data['date'] = $request->date[$i];
            $booking_info_data['from'] = $request->from[$i];
            $booking_info_data['to'] = $request->to[$i];
            $booking_info_data['parking'] = $request->parking;
            $booking_info_data['additional'] = $request->additional;
            if ($booking_info->create($booking_info_data)) {
                continue;
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Booking Failed!',
                    'result' => null
                ];
                return response($response, 400);
            }
        }
        $response = [
            'success' => true,
            'message' => 'Booking Successful!',
            'result' => null
        ];
        return response($response, 200);
    }
}
