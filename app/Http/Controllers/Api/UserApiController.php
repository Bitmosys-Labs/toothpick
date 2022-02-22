<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Staff\Model\Staff;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    public function register(){
        $staff = Staff::all();
        return json_encode($staff);
    }

    public function registerUser(Request $request){
        $data = $request->all();
        return json_encode($data);
    }
}
