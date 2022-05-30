<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Booking\Model\Booking;
use App\Modules\Booking_status\Model\Booking_status;
use App\Modules\Invoice\Model\Invoice;
use App\Modules\Practice\Model\Practice;
use App\Modules\Timesheet\Model\Timesheet;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PracticeController extends Controller
{
    public function profile(){
        if (auth()->check()) {
            $data = Practice::join('users', 'users.id', 'practice.user_id')
                ->where('practice.user_id', auth()->user()->id)
                ->select('users.name', 'users.contact', 'practice.owners_name', 'practice.postcode', 'practice.address', 'practice.gdc_no', 'practice.emergency_contact')
                ->first();
            $response = [
                'success' => true,
                'message' => 'Practice Profile Data',
                'result' => $data
            ];
            return response($response, 200);
        }
        else{
            return response("unauthorized", 401);
        }
    }

    public function updateProfile(Request $request){
        if(auth()->check()) {
            $user = User::where('id', auth()->user()->id)->first();
            $practice = Practice::where('user_id', $user->id)->first();
            $user_data = [
                'name' => $request->name,
                'contact' => $request->contact,
            ];
            $user->update($user_data);
            $practice_data = [
              'owners_name' => $request->owners_name,
                'postcode' => $request->postcode,
                'address' => $request->address,
                'gdc_no' => $request->gdc_no,
                'emergency_contact' => $request->emergency_contact,
            ];
            $practice->update($practice_data);

            $response = [
                'success' => true,
                'message' => 'Profile updated successfully!',
                'result' => null
            ];
            return response($response, 201);
        }
        else{
            return response("unauthorized", 401);
        }
    }

    public function updatePassword(Request $request)
    {
        if (auth()->check()) {
            $user = User::where('id', auth()->user()->id)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                $response = [
                    'success' => false,
                    'message' => 'Incorrect Password',
                    'result' => null
                ];
                return response($response,401);
            }else{
                $data = [
                  'password' => Hash::make($request->password)
                ];
                $user->update($data);
                $response = [
                    'success' => true,
                    'message' => 'Password Updated Successfully',
                    'result' => null
                ];
                return response($response, 201);
            }
        }
        else {
            return response("unauthorized", 401);
        }
    }

    public function listBooking(){
        $booking = Booking::where('practice_id', auth()->user()->id)->with('booking_status.user', 'parking', 'staff')->get();
        $response = [
            'success' => true,
            'message' => 'Data successfully registered',
            'result' => $booking
        ];
        return response($response, 200);
    }

    public function bookingCancel(Request $request){
        $booking = Booking::where('practice_id', auth()->user()->id)->where('id', $request->booking_id)->first();
        $booking_status = Booking_status::where('id', $booking['id'])->first();
        $data = [
          'status' => 4
        ];
        $booking->update($data);
        if($request->other){
            $data = [
                'canceled_by' => 'By Practice',
                'reason_for_cancel' => $request->other,
            ];
        }else{
            $data = [
                'canceled_by' => 'By Practice',
                'reason_for_cancel' => $request->reason_for_cancel,
            ];
        }
        if($booking_status){
            $booking_status->update($data);
        }
        else{
            $status = [
                'id' => $booking->id
            ];
            $booking_status->create($status);
            $booking_status->update($data);
        }
        $response = [
            'success' => true,
            'message' => 'Booking Canceled',
            'result' => null
        ];
        return response($response, 200);
    }

    public function invoice(){
        $invoice = Invoice::where('practice_id', auth()->user()->id)->with('timesheet.booking.staff')->get();
        $response = [
            'success' => true,
            'message' => 'Invoice List',
            'result' => $invoice
        ];
        return response($response, 200);
    }
}
