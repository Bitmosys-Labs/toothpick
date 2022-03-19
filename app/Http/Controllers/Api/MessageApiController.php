<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageApiController extends Controller
{
    public function message(Request $request){
        $message = new \App\Modules\Message\Model\Message();
        $data = [
            'full_name' => $request->full_name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ];
        if($message->create($data)){
            $response = [
                'success' => true,
                'message' => 'Message successfully recorded!',
                'result' => null
            ];
            return response($response, 201);
        }else{
            $response = [
                'success' => false,
                'message' => 'Something went wrong',
                'result' => null
            ];
            return response($response, 401);
        }
        return json_encode($data);
    }
}
