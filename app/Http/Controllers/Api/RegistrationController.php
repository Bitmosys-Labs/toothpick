<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function refreshLogin()
    {
        return auth()->refresh();
    }

    public function userDetails(Request $request){
//        return json_encode(auth()->user());
        return response(auth()->user());
//        if(auth()->user()->role == 1){
//            $practice = new Practice();
//            $data = [
//                'owners_name' => $request->owners_name,
//                'postcode' => $request->postcode,
//                'address' => $request->address,
//                'emergency_contact' => $request->emergency_contact,
//                'gdc_no' => $request->gdc_no,
//                'contact' => $request->contact,
//            ];
//            if($practice->where('user_id', auth()->user()->id)->update($data)){
//                $response = [
//                    'success' => true,
//                    'message' => 'Data successfully registered',
//                    'result' => null
//                ];
//                return response($response, 201);
//            }
//        }
//        elseif (auth()->user()->role == 2){
//            $dcp = new Dcp();
//            $data = [
//                'owners_name' => $request->owners_name,
//                'postcode' => $request->postcode,
//                'address' => $request->address,
//                'emergency_contact' => $request->emergency_contact,
//                'relation_to_emergency_contact' => $request->emergency_contact,
//                'gdc_no' => $request->gdc_no,
//                'travel' => $request->travel,
//            ];
//            if($dcp->where('user_id', auth()->user()->id)->update($data)){
//                $response = [
//                    'success' => true,
//                    'message' => 'Data successfully registered',
//                    'result' => null
//                ];
//                return response($response, 201);
//            }
//        }
    }
}
