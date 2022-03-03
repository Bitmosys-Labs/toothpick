<?php

namespace App\Http\Controllers\Api;

use App\Core_modules\User\Model\User;
use App\Http\Controllers\Controller;
use App\Modules\Dcp\Model\Dcp;
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
        // if(User::where('email', '=', $request->email)->whereNotNull('email_verified_at')->exists()) {
        //     return response('Email already exists!');
        // }
        // $user = new User();
        // if($request->role == 1){
        //     $request->validate([
        //         'full_name' => 'required',
        //         'email' => 'required',
        //         'contact' => 'required',
        //         'password' => 'required|min:6',
        //         'confirm_password' => 'required|min:6|same:password',
        //         'role' => 'required',
        //     ]);
        //     $data = [
        //         'name' => $request->fullname,
        //         'email' => $request->email,
        //         'contact' => $request->contact,
        //         'password' => Hash::make($request->password),
        //         'role' => $request->role,
        //     ];
        //     $newUser = $user->save($data);
        //     return response('Success');
        // }elseif ($request->role == 2){
        //     $request->validate([
        //         'full_name' => 'required',
        //         'email' => 'required',
        //         'contact' => 'required',
        //         'password' => 'required|min:6',
        //         'confirm_password' => 'required|min:6|same:password',
        //         'role' => 'required',
        //         'staff_id' => 'required',
        //     ]);
        //     $data = [
        //         'name' => $request->fullname,
        //         'email' => $request->email,
        //         'contact' => $request->contact,
        //         'password' => Hash::make($request->password),
        //         'role' => $request->role,
        //     ];
        //     $newUser = $user->save($data);
        //     $dcp = new Dcp();
        //     $dcp_data = [
        //         'user_id' => $newUser->id,
        //         'staff_id' => $request->staff_id,
        //     ];
        //     try{
        //         $dcp->save($dcp_data);
        //         return response('Success');
        //     }
        //     catch (\Exception $e){
        //         $user->where('id', $newUser->id)->delete();
        //     }
        // }

        if($request->all()){
            return response('Success');
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
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response('Credentials Mismatch!', 404);
        }
        $token = $user->createToken('my-app-token')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token,
        ];
        return response($response, 200);
    }
}
