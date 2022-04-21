<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Dcp\Model\Dcp;
use App\Modules\Kin\Model\Kin;
use App\Modules\Practice\Model\Practice;
use Illuminate\Http\Request;

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
                    'status' => 1,
                ];
                if ($practice->where('user_id', auth()->user()->id)->update($data)) {
                    $response = [
                        'success' => true,
                        'message' => 'Data successfully registered',
                        'result' => null
                    ];
                    return response($response, 201);
                }
            } elseif (auth()->user()->role == 2) {
                $dcp = new Dcp();
                $kin = new Kin();
                $data = [
                    'postcode' => $request->postCode,
                    'address' => $request->address,
                    'gdc_no' => $request->gdc,
                    'travel' => $request->travel,
                    'status' => 1,
                ];
                $save_dcp = $dcp->where('user_id', auth()->user()->id)->first();
                if ($save_dcp->update($data)) {
                    $kin_data = [
                        'name' => $request->emergencyContact,
                        'contact' => $request->homeContact,
                        'home_contact' => $request->homeContact,
                        'relation' => $request->relation,
                        'address' => $request->addressEmergency,
                        'dcp_id' => $save_dcp->id,
                    ];
                    $kin->create($kin_data);
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

    public function me(){
        if(auth()->check()){
            return response(auth()->user());
        }
        else{
            return response('Unauthorized', 401);
        }
    }
}
