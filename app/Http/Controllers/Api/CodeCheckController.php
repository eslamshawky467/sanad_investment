<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ResetCodePassword;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
class CodeCheckController extends Controller
{
    public function code(Request $request)
    {$validator = Validator::make($request->all(), [
            'code' => 'required|string|',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message'=>'Validations fails',
                'errors'=>$validator->errors()
            ],422);
        }

        // find the code
        if(ResetCodePassword::where('code', $request->code)->exists()){
         $passwordReset = ResetCodePassword::firstWhere('code', $request->code);
            // check if it does not expired: the time is one hour
            $updated_at = $passwordReset->created_at;
            $date = Carbon::now();
            $result = $date->gte($updated_at->addMinutes(60));

            if ($result == true) {
                return response(['message' => trans('passwords.code_is_expire')], 422);
            } else {

        // find user's email
        $user = Client::firstWhere('email', $passwordReset->email);

        // update user password
        $user->update([
            'password'=> Hash::make($request->password)]);

        // delete current code
        $passwordReset->delete();

        return response(['message' =>'password has been successfully reset'], 201);
        }
        }
        else{
            return response(['message' => trans(' passwords.failed ')], 401);
        }
    }
    }

    
    

