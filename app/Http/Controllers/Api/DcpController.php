<?php

namespace App\Http\Controllers\Api;

use App\Core_modules\User\Model\User;
use App\Http\Controllers\Controller;
use App\Modules\Booking\Model\Booking;
use App\Modules\Compliance\Model\Compliance;
use App\Modules\Dcp\Model\Dcp;
use App\Modules\Experience\Model\Experience;
use App\Modules\Identity\Model\Identity;
use App\Modules\Immunization\Model\Immunization;
use App\Modules\Timesheet\Model\Timesheet;
use Illuminate\Http\Request;

class DcpController extends Controller
{
    public function profile(){
        if (auth()->check()){
            $dcp = Dcp::where('user_id', auth()->user()->id)->first();
            $data = [
                'experience' => Experience::where('staff_id', $dcp->staff_id)->get(),
                'user_experience' => Experience::whereHas('users', function ($q){
                    $q->where('users.id', auth()->user()->id);
                })->get(),
                'immunization' => Immunization::where('staff_id', $dcp->staff_id)->get(),
                'user_immunization' => Immunization::whereHas('users', function ($q){
                    $q->where('users.id', auth()->user()->id);
                })->with('documents')->get(),
                'compliance' => Compliance::where('staff_id', $dcp->staff_id)->get(),
                'user_compliance' => Compliance::whereHas('users', function ($q){
                    $q->where('users.id', auth()->user()->id);
                })->with('documents')->get(),
                'identity' => Identity::where('staff_id', $dcp->staff_id)->get(),
                'user_identity' => Identity::whereHas('users', function ($q){
                    $q->where('users.id', auth()->user()->id);
                })->with('documents')->get(),
            ];
            $response = [
                'success' => true,
                'message' => 'User Profile Data',
                'result' => $data
            ];
            return response($response, 200);
        }else{
            return response('unauthorized', 401);
        }
    }

    public function booking(){
        $booking = Booking::whereHas('booking_status', function ($q){
            $q->where('user_id', auth()->user()->id);
        })->get();

        $response = [
            'success' => true,
            'message' => 'User Booking Data',
            'result' => $booking
        ];
        return response($response, 200);
    }

    public function timesheet(){
        $timesheet = Timesheet::whereHas('booking.booking_status', function ($q){
            $q->where('user_id', auth()->user()->id);
        })->get();

        $response = [
            'success' => true,
            'message' => 'User Booking Data',
            'result' => $timesheet
        ];
        return response($response, 200);
    }

    public function details(){
        $data = User::where('id', auth()->user()->id)->first();
        $response = [
            'success' => true,
            'message' => 'User Data',
            'result' => $data
        ];
        return response($response, 200);
    }
}
