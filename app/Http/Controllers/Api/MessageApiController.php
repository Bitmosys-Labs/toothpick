<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageApiController extends Controller
{
    public function message(Request $request){
        $data = $request->all();

        return json_encode($data);
    }
}
