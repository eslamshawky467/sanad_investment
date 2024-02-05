<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct() {
        $this->middleware('auth:admin-api', ['except' => ['login']]);
    }
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            ],[
                'email.required' =>'E-mail Required ',
                'email.email' =>'Please Enter  Email',
                'password.required' =>' Password Required ',
                'password.min'=>'This password is Very Short',
            ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (!$token = auth()->guard('admin-api')->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('admin-api')->factory()->getTTL() * 60,
            'admin' => auth('admin-api')->user(),
            'status'=>201,
        ]);
    }
    public function logout()
    {
        auth('admin-api')->logout();

        return response()->json(['message' => 'Successfully logged out'],201);}

        public function refresh()
    {
        return $this->respondWithToken(auth('admin-api')->refresh());
    }
    public function me()
    {
        return response()->json(auth('admin-api')->user());
    }

}
