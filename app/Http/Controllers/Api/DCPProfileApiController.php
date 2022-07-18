<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Core_modules\User\Model\User;
use App\Modules\Dcp\Model\Dcp;
use App\Modules\Kin\Model\Kin;
use App\Modules\Staff\Model\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DCPProfileApiController extends Controller
{
    public function profile(){
        $user = User::where('id', auth()->user()->id)->with('dcp.kin')->first();
        $staff = Staff::all();
        $response = [
            'success' => true,
            'message' => 'User Profile!',
            'result' => $user,
            'staff' => $staff
        ];
        return response($response, 200);
    }

    public function passwordUpdate(Request $request){
        $user = User::where('id', auth()->user()->id)->first();
        if (!$user || !Hash::check($request->old_password, $user->password)) {
            $response = [
                'success' => false,
                'message' => 'Incorrect Password',
                'result' => null
            ];
            return response($response,401);
        }else{
            $data = [
                'password' => Hash::make($request->password)
            ];
            $user->update($data);
            $response = [
                'success' => true,
                'message' => 'Password Updated Successfully',
                'result' => null
            ];
            return response($response, 201);
        }
    }

    public function updateProfile(Request $request){
        $user = User::where('id', auth()->user()->id)->first();
        $dcp = Dcp::where('user_id', auth()->user()->id)->first();
        $user_data = [
//          'name' => $request->name,
            'contact' => $request->contact,
        ];
        $dcp_data = [
//            'staff_id' => $request->staff_id,
//            'gdc_no' => $request->gdc_no,
            'postcode' => $request->postcode,
            'address' => $request->address,
        ];
        $user->update($user_data);
        $dcp->update($dcp_data);
        $dcp->staff()->sync($request->staff_id);
        $response = [
            'success' => true,
            'message' => 'Profile Updated Successfully',
            'result' => null
        ];
        return response($response, 201);
    }

    public function updateKin(Request $request){
        $dcp = Dcp::where('user_id', auth()->user()->id)->first();
        $kin = Kin::where('dcp_id', $dcp->id)->first();
        $kin_data = [
          'name' => $request->name,
            'contact' => $request->contact,
            'home_contact' => $request->home_contact,
            'relation' => $request->relation,
            'address' => $request->address
        ];
        $kin->update($kin_data);
        $response = [
            'success' => true,
            'message' => 'Kin Record Updated Successfully',
            'result' => null
        ];
        return response($response, 201);
    }
}
