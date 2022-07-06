<?php

namespace App\Http\Controllers\Api;

use App\Core_modules\User\Model\User;
use App\Http\Controllers\Controller;
use App\Modules\Availability\Model\Availability;
use App\Modules\Availability_date\Model\Availability_date;
use App\Modules\Booking\Model\Booking;
use App\Modules\Compliance\Model\Compliance;
use App\Modules\Day\Model\Day;
use App\Modules\Dcp\Model\Dcp;
use App\Modules\Experience\Model\Experience;
use App\Modules\Identity\Model\Identity;
use App\Modules\Immunization\Model\Immunization;
use App\Modules\Invoice\Model\Invoice;
use App\Modules\Timesheet\Model\Timesheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        })->with('practice.user')->get();

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

    public function recordTimesheet(Request $request){
//        try{
            $timesheet = new Timesheet();
            $booking = Booking::where('slug', $request->slug)->whereHas('booking_status', function ($q){
                return $q->where('user_id', auth()->user()->id);
            })->with('practice.user')->first();
            $invoice = Invoice::where('practice_id', $booking->practice_id)->whereMonth('issue_date', Carbon::now()->startOfMonth())->first();
            if(!$invoice){
                $cr_in = new Invoice();
                do{
                    $slug_inv = strtoupper(str::slug(substr($booking->practice->user->name, 0, 2).' '.substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6)));
                }while(Invoice::where('slug', $slug_inv)->exists());
                $due_date = Carbon::now()->endOfMonth();
                $data_inv = [
                    'slug' => $slug_inv,
                    'practice_id' => $booking->practice_id,
                    'issue_date' => $booking->date,
                    'due_date' => $due_date->addDays($booking->practice->payment),
                    'status' => 0,
                ];

                $invoice = $cr_in->create($data_inv);
            }
            do{
                $slug = str::slug(substr(auth()->user()->name, 0, 2).' '.substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6));
            }while(Timesheet::where('slug', $slug)->exists());
            $total_hours = explode('.',$request->total_hours);
            $payable_hours = ($total_hours[0] * 60) + $total_hours[1];
            $payable_amount = $payable_hours * ($booking->hourly_rate/60);
            $data = [
                'booking_id' => $booking->booking_id,
                'slug' => $slug,
                'invoice_id' => $invoice->id,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'lunch_time' => $request->lunch_time,
                'total_hours' => $payable_hours,
                'approved_by' => $request->approved_by,
                'due_date' => $invoice->due_date,
                'vat' => ($payable_amount*0.2),
                'payable_amount' => $payable_amount,
                'status' => 1,
            ];
            if($booking->booking_status->id){
//                if ($request->hasFile('signature')) {
                if ($request->signature) {
//                    $file = $request->file('signature');
//                    $uploadPath = public_path('uploads/signatures/');
//                    $data['signature'] = $this->fileUpload($file, $uploadPath);
                    $data['signature'] = $request->signature;
                    if($timesheet->where('booking_id', $booking->booking_id)->exists()){
                        $response = [
                            'success' => false,
                            'message' => 'Timesheet already recorded!',
                            'result' => null
                        ];
                        return response($response, 400);
                    }
                    else{
                        $timesheet->create($data);
                        $booking->update(['status' => 3]);
                        $response = [
                            'success' => true,
                            'message' => 'Timesheet Created Successfully',
                            'result' => null
                        ];
                        return response($response, 200);
                    }
                }
                $response = [
                    'success' => false,
                    'message' => 'Missing Signature!',
                    'result' => null
                ];
                return response($response, 400);
            }else{
                $response = [
                    'success' => false,
                    'message' => 'Something Went Wrong!',
                    'result' => null
                ];
                return response($response, 400);
            }
//        }
//        catch (\Exception $e){
//            $response = [
//                'success' => false,
//                'message' => 'Something Went Wrong!',
//                'result' => null
//            ];
//            return response($response, 400);
//        }

    }

    public function details(){
        $data = User::where('id', auth()->user()->id)->with('dcp')->first();
        $response = [
            'success' => true,
            'message' => 'User Data',
            'result' => $data
        ];
        return response($response, 200);
    }

    public function setAvailability(Request $request){
        $role = auth()->user()->role;
        if($role == 3){
            $availability = new Availability();
            $availability->where('user_id', auth()->user()->id)->delete();
            for($i=0;$i<count($request->days);$i++){
                $days = Day::where('day', $request->days[$i])->first();
                $data = [
                    'user_id' => auth()->user()->id,
                    'days_id' => $days->id
                ];
                $availability->create($data);
            }
            $response = [
                'success' => true,
                'message' => 'Record created successfully!',
                'result' => null
            ];
            return response($response, 200);
        }elseif ($role == 2){
            $availability = new Availability_date();
            $availability->where('user_id', auth()->user()->id)->delete();
            for($i=0;$i<count($request->days);$i++){
                $data = [
                    'user_id' => auth()->user()->id,
                    'date' => $request->days[$i],
                ];
                $availability->create($data);
            }
            $response = [
                'success' => true,
                'message' => 'Record created successfully!',
                'result' => null
            ];
            return response($response, 200);
        }
    }

    public function getAvailability()
    {
        $role = auth()->user()->role;
        if($role == 3){
            $data = Availability::where('user_id', auth()->user()->id)->with('days')->get();
            $response = [
                'success' => true,
                'message' => 'Available days!',
                'result' => $data
            ];
            return response($response, 200);
        }elseif ($role == 2){
            $data = Availability_date::where('user_id', auth()->user()->id)->get();
            $response = [
                'success' => true,
                'message' => 'Available dates!',
                'result' => $data
            ];
            return response($response, 200);
        }
    }

    public function fileUpload($file, $path){
        $ext = $file->getClientOriginalExtension();
        $imageName = md5(microtime()) . '.' . $ext;
        if (!$file->move($path, $imageName)) {
            return redirect()->back();
        }
        return $imageName;
    }
}
