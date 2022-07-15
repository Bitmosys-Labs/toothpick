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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Cookie;
use function Symfony\Component\VarDumper\Dumper\esc;
use Illuminate\Contracts\Auth\MustVerifyEmail;


class UserApiController extends Controller
{
    public function register()
    {
        $data = Staff::select('id', 'type')->get();

        $response = [
            'success' => true,
            'message' => 'List of staff type for DCP registration',
            'result' => $data
        ];
        return response($response, 200);
    }

    public function registerUser(Request $request)
    {
        if (User::where('email', '=', $request->email)->whereNotNull('email_verified_at')->exists()) {
            $response = [
                'success' => false,
                'message' => 'Email already exists!',
                'result' => null
            ];
            return response($response, 403);
        }elseif (User::where('email', '=', $request->email)->exists()){
            $response = [
                'success' => false,
                'message' => 'Not Verified!',
                'result' => null
            ];
            return response($response, 403);
        }
        $user = new User();
        if ($request->role == 1) {
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
                'id' => $newUser->id,
                'user_id' => $newUser->id,
                'payment' => 15,
            ];
            $practice->create($practice_data);
            $token = new Token();
            $token_data = [
                'user_id' => $newUser->id,
                'token' => substr(rand(), 0, 6)
            ];
            $token->create($token_data);
            $details = [
                'token' => $token_data['token'],
            ];

            Mail::to($newUser->email)->send(new \App\Mail\tokenMail($details));
            $response = [
                'success' => true,
                'message' => 'Successfully registered!',
                'result' => null
            ];
            return response($response, 201);
        } elseif ($request->role == 2) {
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
                'id' => $newUser->id,
                'user_id' => $newUser->id,
                'staff_id' => $request->staff_id,
            ];
            $dcp->create($dcp_data);
            $token = new Token();
            $token_data = [
                'user_id' => $newUser->id,
                'token' => substr(rand(), 0, 6)
            ];
            $token->create($token_data);
            $details = [
                'token' => $token_data['token'],
            ];

            Mail::to($newUser->email)->send(new \App\Mail\tokenMail($details));
            $response = [
                'success' => true,
                'message' => 'Successfully registered!',
                'result' => null
            ];
            return response($response, 201);
        }
    }

    public function emailCheck(Request $request)
    {
        if (User::where('email', '=', $request->email)->whereNotNull('email_verified_at')->exists()) {
            $response = [
                'success' => false,
                'message' => 'Email already exists!',
                'result' => null
            ];
            return response($response, 403);
        }elseif (User::where('email', '=', $request->email)->exists()){
            $response = [
                'success' => false,
                'message' => 'Not Verified!',
                'result' => null
            ];
            return response($response, 403);
        }
        else {
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
        if (Auth::attempt($request->only('email', 'password'))) {
            $users = Auth::user();
            if(!$users->hasVerifiedEmail()){
                $response = [
                    'success' => false,
                    'message' => 'Email Not Verified!',
                    'result' => null
                ];
                return response($response, 403);
            }
            $token = $users->createToken('token')->plainTextToken;
            if($request->remember_token){
                $cookie = cookie('jwt', $token, 60 * 24 * 30);
            }else{
                $cookie = cookie('jwt', $token, 60 * 24);
            }
            $user = User::where('email', $request->email)->whereNotNull('email_verified_at')->first();
            if ($user->role == 1) {
                $data = [
                    'token' => $token,
                    'url' => "https://practice.toothpickdentalstaff.com",
                ];
                $response = [
                    'success' => true,
                    'message' => 'Login Successful!',
                    'result' => $data
                ];
                return response($response, 200)->withCookie($cookie);
            } elseif ($user->role == 2 || $user->role == 3) {
                $data = [
                    'token' => $token,
                    'url' => "https://dcp.toothpickdentalstaff.com",
                ];
                $response = [
                    'success' => true,
                    'message' => 'Login Successful!',
                    'result' => $data
                ];
                return response($response, 200)->withCookie($cookie);
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Unauthorized!',
                    'result' => null
                ];
                return response($response, 401);
            }
        }else{
            $response = [
                'success' => false,
                'message' => 'Wrong credentials!',
                'result' => null
            ];
            return response($response, 401);
        }
    }

    public function fetchToken()
    {
        return json_encode(session('token'));
    }

    public function emailVerification(Request $request)
    {
        if ($request->email) {
            if (User::where('email', $request->email)->whereNotNull('email_verified_at')->exists()) {
                return response('Verified');
            }
            $token = substr(uniqid(), 7, 11);
            $user = User::where('email', $request->email)->orderBy('id', 'DESC')->first();
            $record = new Token();
            $data = [
                'user_id' => $user->id,
                'token' => $token,
            ];
            $record->where('user_id', $user->id)->delete();
            if ($record->create($data)) {
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
        } else {
            $response = [
                'success' => false,
                'message' => 'Something went wrong',
                'result' => null
            ];
            return response($response, 400);
        }
    }

    public function emailVerify(Request $request)
    {
        $user = User::where('email', $request->email)->orderBy('id', 'DESC')->first();
        $token = $request->token;

        if (Token::where('user_id', $user->id)->where('token', $token)
            ->where('created_at', '>=', Carbon::now()->subMinutes(20)->toDateTimeString())->exists()) {
            $data = [
                'email_verified_at' => Carbon::now()->toDateTimeString()
            ];
            $user->update($data);
            $response = [
                'success' => true,
                'message' => 'Verified',
                'result' => null
            ];
            return response($response, 200);
        } else {
            $response = [
                'success' => false,
                'message' => 'Token Expired',
                'result' => null
            ];
            return response($response, 401);
        }
    }

    public function logoutUser()
    {
        $cookie = \Cookie::forget('jwt');
        return response('Logged Out', 200)->withCookie($cookie);
    }
}
