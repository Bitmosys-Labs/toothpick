<?php

namespace App\Http\Controllers\Api;

use App\Core_modules\User\Model\User;
use App\Http\Controllers\Controller;
use App\Mail\tokenMail;
use App\Modules\Dcp\Model\Dcp;
use App\Modules\Kin\Model\Kin;
use App\Modules\Password_reset\Model\Password_reset;
use App\Modules\Practice\Model\Practice;
use App\Modules\Token\Model\Token;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class RegistrationController extends Controller
{
    public function refreshLogin()
    {
        return auth()->refresh();
    }

    public function userDetails(Request $request){
        if(auth()->check()) {
            if (auth()->user()->role == 1) {
                $practice = new Practice();
                $data = [
                    'owners_name' => $request->owners_name,
                    'postcode' => $request->postcode,
                    'address' => $request->address,
                    'emergency_contact' => $request->emergency_contact,
                    'gdc_no' => $request->gdc_no,
                    'contact' => $request->contact,
//                    'status' => 1,
                ];
                if ($practice->where('user_id', auth()->user()->id)->update($data)) {
                    \App\Core_modules\User\Model\User::where('id', auth()->user()->id)->update(['status' => 1]);
                    $response = [
                        'success' => true,
                        'message' => 'Data successfully registered',
                        'result' => null
                    ];
                    return response($response, 201);
                }
            } elseif (auth()->user()->role == 2 || auth()->user()->role == 3) {
                $dcp = new Dcp();
                $kin = new Kin();

                $data = [
                    'postcode' => $request->postcode,
                    'address' => $request->address,
                    'gdc_no' => $request->gdc_no,
                    'travel' => $request->travel,
                ];
                $save_dcp = $dcp->where('user_id', auth()->user()->id)->first();
                if ($save_dcp->update($data)) {
                    $kin_data = [
                        'name' => $request->emergencycontactname,
                        'contact' => $request->emergencycontact,
                        'home_contact' => $request->homecontact,
                        'relation' => $request->relation,
                        'address' => $request->addressemergency,
                        'dcp_id' => $save_dcp->id,
                    ];
                    if($kin->where('dcp_id', $save_dcp->id)->exists()){
                        $kin->where('dcp_id', $save_dcp->id)->update($kin_data);
                    }else{
                        $kin->create($kin_data);
                    }
                    \App\Core_modules\User\Model\User::where('id', auth()->user()->id)->update(['status' => 1]);
                    $response = [
                        'success' => true,
                        'message' => 'Data successfully registered',
                        'result' => null
                    ];
                    return response($response, 201);
                }
            }
        }else{
            return response('Unauthorized', 401);
        }
    }

    public function forgotPassword(Request $request){
        $token = substr(uniqid(), 7, 11);
        $password_reset = new Password_reset();
        $user = User::where('email', $request->email)->first();
        if($user){
            if (Password_reset::where('email', $user->email)->where('token', $token)
                ->where('created_at', '>=', Carbon::now()->subMinutes(2)->toDateTimeString())->exists()) {
                $response = [
                    'success' => false,
                    'message' => 'Too many token request!',
                    'result' => null
                ];
                return response($response, 400);
            }
            $password_reset->where('email', $user->email)->delete();
            $data = [
                'email' => $user->email,
                'token' => $token,
            ];
            if($password_reset->create($data)){
                $details = [
                    'password' => true,
                    'token' => $token
                ];
                Mail::to($user->email)->send(new tokenMail($details));
                $response = [
                    'success' => true,
                    'message' => 'Email sent',
                    'result' => null
                ];
                return response($response, 201);
            }
        }else{
            $response = [
                'success' => false,
                'message' => 'No user with this email!',
                'result' => null
            ];
            return response($response, 400);
        }

    }

    public function changePassword(Request $request){
        $email = $request->email;
        $token = $request->token;
        if (Password_reset::where('email', $email)->where('token', $token)
            ->where('created_at', '>=', Carbon::now()->subMinutes(15)->toDateTimeString())->exists()) {
            $user = User::where('email', $email)->first();
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }
        $response = [
            'success' => true,
            'message' => 'Password Successfully Changed!',
            'result' => null
        ];
        return response($response, 201);
    }

    public function me(Request $request){
            $data = User::where('id', auth()->user()->id)
                ->select('id','name', 'email', 'status', 'role')
                ->first();
            return $data;
    }
}
