<?php

namespace App\Http\Controllers\Api;

use App\Core_modules\User\Model\User;
use App\Http\Controllers\Api\Controller;
use App\Mail\tokenMail;
use App\Modules\Dcp\Model\Dcp;
use App\Modules\Practice\Model\Practice;
use App\Modules\Staff\Model\Staff;
use App\Modules\Token\Model\Token;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserApiController extends Controller
{
    public function register(){
        $data = Staff::select('id', 'type')->get();

        $response = [
            'success' => true,
            'message' => 'List of staff type for DCP registration',
            'result' => $data
        ];
        return response($response, 200);
    }

    public function registerUser(Request $request){
         if(User::where('email', '=', $request->email)->whereNotNull('email_verified_at')->exists()) {
             return response('Email already exists!');
         }
         $user = new User();
         if($request->role == 1){
             $data = [
                 'name' => $request->full_name,
                 'email' => $request->email,
                 'contact' => $request->contact,
                 'password' => Hash::make($request->password),
                 'role' => 1,
                 'status' => 0,
             ];
             $newUser = $user->create($data);
             $practice = new Practice();
             $practice_data = [
                 'user_id' => $newUser->id,
             ];

             try{
                 $practice->save($practice_data);

                 $response = [
                     'success' => true,
                     'message' => 'Successfully registered!',
                     'result' => null
                 ];
                 return response($response, 201);
             }
             catch (\Exception $e){
                 $user->where('id', $newUser->id)->delete();
                 $response = [
                     'success' => false,
                     'message' => 'Registration failed!',
                     'result' => null
                 ];
                 return response($response, 400);
             }
         }elseif ($request->role == 2){
             $data = [
                 'name' => $request->full_name,
                 'email' => $request->email,
                 'contact' => $request->contact,
                 'password' => Hash::make($request->password),
                 'role' => 2,
                 'status' => 0,
             ];
             $newUser = $user->create($data);
             $dcp = new Dcp();
             $dcp_data = [
                 'user_id' => $newUser->id,
                 'staff_id' => $request->staff_id,
             ];
             try{
                 $dcp->save($dcp_data);
                 $response = [
                     'success' => true,
                     'message' => 'Successfully registered!',
                     'result' => null
                 ];
                 return response($response, 201);
             }
             catch (\Exception $e){
                 $user->where('id', $newUser->id)->delete();
                 $response = [
                     'success' => false,
                     'message' => 'Registration failed!',
                     'result' => null
                 ];
                 return response($response, 400);
             }
         }
    }

    public function emailCheck(Request $request){
        if(User::where('email', '=', $request->email)->whereNotNull('email_verified_at')->exists()) {
            $response = [
                'success' => false,
                'message' => 'Email already exists!',
                'result' => null
            ];
            return response($response, 403);
        }else{
            $response = [
                'success' => true,
                'message' => 'Email is unique!',
                'result' => null
            ];
            return response($response, 200);
        }
    }

    public function userLogin(Request $request)
    {
        $user = User::where('email', $request->email)->orderBy('created_at', 'DESC')->first();
        if($user){
            if($user->email_verified_at != null){
                if (!$user || !Hash::check($request->password, $user->password)) {
                    $response = [
                        'success' => false,
                        'message' => 'Wrong credentials!',
                        'result' => null
                    ];
                    return response($response, 401);
                }else{
                    $token = auth()->attempt($request->only(['email', 'password']));
                    if($user->role == 1){
                        session(['token' => $token]);
                        session()->save();
                        $data = [
                          'token' => $token,
                          'url' => "https://practice.toothpickdentalstaff.com",
                        ];
                        $response = [
                            'success' => true,
                            'message' => 'Login Successful!',
                            'result' => $data
                        ];
                        return response($response, 200);
                    }
                    if($user->role == 2){
                        session(['token' => $token]);
                        session()->save();
                        $data = [
                            'token' => $token,
                            'url' => "https://dcp.toothpickdentalstaff.com",
                        ];
                        $response = [
                            'success' => true,
                            'message' => 'Login Successful!',
                            'result' => $data
                        ];
                        return response($response, 200);
                    }
                }
            }else{
                $response = [
                    'success' => false,
                    'message' => 'Email Not Verified!',
                    'result' => null
                ];
                return response($response, 403);
            }
        }
    }

    public function fetchToken(){
            return json_encode(session('token'));
    }

    public function emailVerification(Request $request){
        if($request->email){
            if(User::where('email',$request->email)->whereNotNull('email_verified_at')->exists()){
                return response('Verified');
            }
            $token = substr(uniqid(), 7, 11);
            $user = User::where('email', $request->email)->orderBy('created_at', 'DESC')->first();
            $record = new Token();
            $data = [
                'user_id' => $user->id,
                'token' => $token,
            ];
            $record->where('user_id', $user->id)->delete();
            if($record->create($data)){
                $details = [
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
                'message' => 'Something went wrong',
                'result' => null
            ];
            return response($response, 400);
        }
    }

    public function emailVerify(Request $request){
        $user = User::where('email', $request->email)->orderBy('created_at', 'DESC')->first();
        $token = $request->token;

        if(Token::where('user_id', $user->id)->where('token', $token)
            ->where('created_at', '>=', Carbon::now()->subMinutes(20)->toDateTimeString())->exists()){
            $data = [
              'email_verified_at' => Carbon::now()->toDateTimeString()
            ];
            User::where('id', $user->id)->update($data);
            $response = [
                'success' => true,
                'message' => 'Verified',
                'result' => null
            ];
            return response($response, 200);
        }else{
            $response = [
                'success' => false,
                'message' => 'Token Expired',
                'result' => null
            ];
            return response($response, 401);
        }
    }


}
