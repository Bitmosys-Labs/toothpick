<?php

namespace App\Http\Controllers\Api;

use App\Core_modules\User\Model\User;
use App\Http\Controllers\Controller;
use App\Modules\Dcp\Model\Dcp;
use App\Modules\Practice\Model\Practice;
use App\Modules\Staff\Model\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserApiController extends Controller
{
    public function register(){
        $staff = Staff::select('id', 'type')->get();
        return json_encode($staff);
    }

    public function registerUser(Request $request){
         if(User::where('email', '=', $request->email)->whereNotNull('email_verified_at')->exists()) {
             return response('Email already exists!');
         }
         $user = new User();
         if($request->role == 1){
             $data = [
                 'name' => $request->name,
                 'email' => $request->email,
                 'contact' => $request->contact,
                 'password' => Hash::make($request->password),
                 'role' => 1,
                 'status' => 1,
             ];
             $newUser = $user->create($data);
             $practice = new Practice();
             $practice_data = [
                 'user_id' => $newUser->id,
             ];

             try{
                 $practice->save($practice_data);
                 return response('Success');
             }
             catch (\Exception $e){
                 $user->where('id', $newUser->id)->delete();
                 return response('Registration Failed!', 404);
             }
         }elseif ($request->role == 2){
             $data = [
                 'name' => $request->fullname,
                 'email' => $request->email,
                 'contact' => $request->contact,
                 'password' => Hash::make($request->password),
                 'role' => 2,
                 'status' => 1,
             ];
             $newUser = $user->create($data);
             $dcp = new Dcp();
             $dcp_data = [
                 'user_id' => $newUser->id,
                 'staff_id' => $request->staff_id,
             ];
             try{
                 $dcp->save($dcp_data);
                 return response('Success');
             }
             catch (\Exception $e){
                 $user->where('id', $newUser->id)->delete();
                 return response('Registration Failed!', 404);
             }
         }
    }

    public function emailCheck(Request $request){
        if(User::where('email', '=', $request->email)->whereNotNull('email_verified_at')->exists()) {
            return json_encode(false);
        }else{
            return json_encode(true);
        }
    }

    public function userLogin(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if($user->email_verified_at != null){
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response('Credentials Mismatch!', 404);
            }
        }else{
            return response('Email Not Verified!', 404);
        }
        $token = $user->createToken('my-app-token')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token,
        ];
        return response($response, 200);
    }
}
