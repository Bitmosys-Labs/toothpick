<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Dcp\Model\Dcp;
use App\Modules\Kin\Model\Kin;
use App\Modules\Practice\Model\Practice;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                    'gdc_no' => $request->gdc,
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

    public function me(Request $request){
            $data = User::where('id', auth()->user()->id)
                ->select('id','name', 'email', 'status', 'role')
                ->first();
            return $data;
    }
}
