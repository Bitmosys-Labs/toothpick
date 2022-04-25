<?php

namespace App\Http\Controllers\Api;

use App\Core_modules\User\Model\User;
use App\Http\Controllers\Controller;
use App\Modules\Compliance\Model\Compliance;
use App\Modules\Dcp\Model\Dcp;
use App\Modules\Experience\Model\Experience;
use App\Modules\Identity\Model\Identity;
use App\Modules\Immunization\Model\Immunization;
use Illuminate\Http\Request;

class DcpController extends Controller
{
    public function profile(){
        if (auth()->check()){
            $dcp = Dcp::where('user_id', auth()->user()->id)->first();
            $data = [
                'experience' => Experience::where('staff_id', $dcp->staff_id)->get(),
                'user_experience' => Experience::whereHas('users', function ($q){
                    $q->where('users.id', auth()->user()->id);
                })->get(),
                'immunization' => Immunization::where('staff_id', $dcp->staff_id)->get(),
                'user_immunization' => Immunization::whereHas('users', function ($q){
                    $q->where('users.id', auth()->user()->id);
                })->with('documents')->get(),
                'compliance' => Compliance::where('staff_id', $dcp->staff_id)->get(),
                'user_compliance' => Compliance::whereHas('users', function ($q){
                    $q->where('users.id', auth()->user()->id);
                })->with('documents')->get(),
                'identity' => Identity::where('staff_id', $dcp->staff_id)->get(),
                'user_identity' => Identity::whereHas('users', function ($q){
                    $q->where('users.id', auth()->user()->id);
                })->with('documents')->get(),
            ];
            return response($data);
        }else{
            return response('unauthorized', 401);
        }
    }
}
