<?php

namespace App\Http\Controllers\Api;

use App\Core_modules\User\Model\User;
use App\Http\Controllers\Controller;
use App\Modules\Staff\Model\Staff;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    public function register(){
        $staff = Staff::select('id', 'type')->get();
        return json_encode($staff);
    }

    public function registerUser(Request $request){
        if($request->role == 1){
            return response('Practice');
        }elseif ($request->role == 2){
            return response('DCP');
        }
    }

    public function emailCheck(Request $request){
        if(User::where('email', '=', $request->email)->exists()) {
            return response(false);
        }else{
            return response(true);
        }
    }
}
