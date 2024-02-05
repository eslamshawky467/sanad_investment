<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\SendCodeResetPassword;
use App\Models\ResetCodePassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\Client;

class ForgotPasswordController extends Controller
{
    public function forget(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
 if ($validator->fails()) {
            return response()->json([
                'errors'=>$validator->errors()
            ],422);
        }
        if( Client::where('email', $request->email)->exists()){
            $data['email']=$request->email;
            ResetCodePassword::where('email', $request->email)->delete();
            $data['code'] = mt_rand(100000, 999999);
            $codeData = ResetCodePassword::create($data);

            // Send email to user
            Mail::to($request->email)->send(new SendCodeResetPassword($codeData->code));

            return response(['message' => trans('passwords.sent')], 201);

        }
        else{
            return response(['message' =>trans('passwords.fail')], 401);
        }
        
    }
    
}
