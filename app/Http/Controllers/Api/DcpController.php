<?php

namespace App\Http\Controllers\Api;

use App\Core_modules\User\Model\User;
use App\Http\Controllers\Controller;
use App\Modules\Additional\Model\Additional;
use App\Modules\Availability\Model\Availability;
use App\Modules\Availability_date\Model\Availability_date;
use App\Modules\Booking\Model\Booking;
use App\Modules\Compliance\Model\Compliance;
use App\Modules\Day\Model\Day;
use App\Modules\Dcp\Model\Dcp;
use App\Modules\Document\Model\Document;
use App\Modules\Experience\Model\Experience;
use App\Modules\Identity\Model\Identity;
use App\Modules\Immunization\Model\Immunization;
use App\Modules\Invoice\Model\Invoice;
use App\Modules\Timesheet\Model\Timesheet;
use App\Modules\User_comp\Model\User_comp;
use App\Modules\User_identity\Model\User_identity;
use App\Modules\User_immunization\Model\User_immunization;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Ramsey\Uuid\Type\Time;

class DcpController extends Controller
{
    public function profile(){
        $dcp = Dcp::where('user_id', auth()->user()->id)->first();
        $data = [
            'experience' => Experience::all(),
            'user_experience' => User::where('id', auth()->user()->id)->with('experiences')->get(),
            'immunization' => Immunization::all(),
            'user_immunization' => User::where('id', auth()->user()->id)->with('dcp.immunization')->get(),
            'compliance' => Compliance::all(),
            'user_compliance' => User::where('id', auth()->user()->id)->with('dcp.compliance')->get(),
            'identity' => Identity::all(),
            'user_identity' => User::where('id', auth()->user()->id)->with('dcp.identity')->get(),
        ];
        $response = [
            'success' => true,
            'message' => 'User Profile Data',
            'result' => $data
        ];
        return response($response, 200);
    }

    public function recordProfile(Request $request){
        $for = $request->for;
        switch ($for){
            case "compliance":
                $compliance = new User_comp();
                $data = [
                    'comp_id' => $request->id,
                    'user_id' => auth()->user()->id,
                    'status' => 0,
                ];
                if ($request->hasFile('picture')) {
                    $file = $request->file('picture');
                    $uploadPath = public_path('uploads/compliance/');
                    $data['picture'] = $this->fileUpload($file, $uploadPath);
                }
                if(User_comp::where('user_id', auth()->user()->id)->where('comp_id', $request->id)->exists()){
                    $data['status'] = 2;
                    $compliance->update($data);
                }else{
                    $compliance->create($data);
                }
                $response = [
                    'success' => true,
                    'message' => 'User Experience Updated',
                    'result' => null
                ];
                return response($response, 200);
                break;

            case "experience":
                $user = User::where('id', auth()->user()->id)->first();
                $user->experiences()->sync($request->experience);
//                $experience = DB::table('experience_user')->where('user_id', auth()->user()->id)->get();
//                $experience->delete();
//                for($i = 0; $i<count($request->experience); $i++){
//                    DB::table('experience_user')->create([
//                        'user_id' => auth()->user()->id,
//                        'experience_id' => $request->experience[$i]
//                    ]);
//                }
                $response = [
                    'success' => true,
                    'message' => 'User Experience Updated',
                    'result' => null
                ];
                return response($response, 200);
                break;

            case "identity":
                $identity = new User_identity();
                $data = [
                    'ide_id' => $request->id,
                    'user_id' => auth()->user()->id,
                    'status' => 0,
                ];
                if ($request->hasFile('picture')) {
                    $file = $request->file('picture');
                    $uploadPath = public_path('uploads/identity/');
                    $data['picture'] = $this->fileUpload($file, $uploadPath);
                }
                if(User_identity::where('user_id', auth()->user()->id)->where('ide_id', $request->id)->exists()){
                    $data['status'] = 2;
                    $identity->update($data);
                }else{
                    $identity->create($data);
                }
                $response = [
                    'success' => true,
                    'message' => 'User Experience Updated',
                    'result' => null
                ];
                return response($response, 200);
                break;

            case "immunization":
                $immunization = new User_immunization();
                $data = [
                    'imm_id' => $request->id,
                    'user_id' => auth()->user()->id,
                    'status' => 0,
                ];
                if ($request->hasFile('picture')) {
                    $file = $request->file('picture');
                    $uploadPath = public_path('uploads/immunization/');
                    $data['picture'] = $this->fileUpload($file, $uploadPath);
                }
                if(User_immunization::where('user_id', auth()->user()->id)->where('imm_id', $request->id)->exists()){
                    $data['status'] = 2;
                    $immunization->update($data);
                }else{
                    $immunization->create($data);
                }
                $response = [
                    'success' => true,
                    'message' => 'User Experience Updated',
                    'result' => null
                ];
                return response($response, 200);
                break;
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
        $timesheet = Timesheet::whereHas('booking.booking_status.user', function ($q){
            $q->where('id', auth()->user()->id);
        })->with('additional')->get();

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
                    $image = $request->signature;  // your base64 encoded
                    $image = str_replace('data:image/png;base64,', '', $image);
                    $imageFile = base64_decode(str_replace(' ', '+', $image));
//                    $imageName = str_random(10).'.'.'png';
//                    \File::put(storage_path(). '/' . $imageName, base64_decode($image));
////                    $file = $request->file('signature');
                    $uploadPath = public_path('uploads/signatures/');
                    $data['signature'] = $this->fileUpload($imageFile, $uploadPath);
//                    $data['signature'] = $request->signature;
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

    public function additionalExpenses(Request $request){
        $timesheet = Timesheet::where('slug', $request->slug)->first();
        $data = [
            'invoice_id' => $timesheet->id,
            'amount' => $request->amount,
            'purpose' => $request->purpose,
            'status' => 0,
        ];
        if ($request->hasFile('receipt')) {
            $file = $request->file('receipt');
            $uploadPath = public_path('uploads/additional/receipt');
            $data['receipt'] = $this->fileUpload($file, $uploadPath);
        }
        Additional::create($data);
        $response = [
            'success' => true,
            'message' => 'Data Recorded!',
            'result' => $data
        ];
        return response($response, 200);
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
