<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Booking\Model\Booking;
use App\Modules\Booking_status\Model\Booking_status;
use App\Modules\Parking\Model\Parking;
use App\Modules\Staff\Model\Staff;
use App\User;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class BookingApiController extends Controller
{
    public function staffType(){
        $staff = Staff::select('id', 'type')->get();
        $parking = Parking::select('id', 'type')->get();

        $data = ['staff' => $staff, 'parking' => $parking];
        $response = [
            'success' => true,
            'message' => 'List of staff type for DCP registration',
            'result' => $data
        ];
        return response($response, 200);
    }

    public function BookingCreate(Request $request){
        if (auth()->check()) {
            $count = count($request->staff_id);
            $booking_info = new Booking();
            for ($i = 0; $i < $count; $i++) {
                do{
                    $slug = strtoupper(str::slug(substr(auth()->user()->name, 0, 2).' '.substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6)));
                }while(Booking::where('slug', $slug)->exists());
                $booking_info_data['practice_id'] = auth()->user()->id;
                $booking_info_data['slug'] = $slug;
                $booking_info_data['staff_id'] = $request->staff_id[$i];
                $booking_info_data['date'] = $request->date[$i];
                $booking_info_data['from'] = $request->from[$i];
                $booking_info_data['to'] = $request->to[$i];
                $booking_info_data['parking'] = $request->parking;
                $booking_info_data['additional'] = $request->additional_info;
                $booking_info_data['work_with'] = $request->work_with;
                $booking_info_data['other'] = $request->additional;
                $booking_info_data['status'] = 0;
                try{
                    $booking = $booking_info->create($booking_info_data);
                    $booking_status = [
                        'id' => $booking->id,
                        'date' => $booking->date
                    ];
                    Booking_status::create($booking_status);
                } catch (\Exception $e) {
                    $response = [
                        'success' => false,
                        'message' => 'Booking Failed!',
                        'result' => null
                    ];
                    return response($response, 400);
                }
            }
            $details = auth()->user()->name;
            Mail::to('booking@toothpickdentalstaff.com')->send(new \App\Mail\bookingMail($details));
            $response = [
                'success' => true,
                'message' => 'Booking Successful!',
                'result' => null
            ];
            return response($response, 200);
        }
        else{
            return response('Unauthorized', 401);
        }
    }
}
