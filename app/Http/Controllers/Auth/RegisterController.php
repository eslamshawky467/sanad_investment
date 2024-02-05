<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Traits\AuthTrait;
use App\Models\Client;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
/*
|--------------------------------------------------------------------------
| Register Controller
|--------------------------------------------------------------------------
|
| This controller handles the registration of new users as well as their
| validation and creation. By default this controller uses a trait to
| provide this functionality without requiring any additional code.
|
*/

use AuthTrait;
/**
* Where to redirect users after registration.
*
* @var string
*/
protected $redirectTo = RouteServiceProvider::HOME;

/**
* Create a new controller instance.
*
* @return void
*/
public function __construct()
{
$this->middleware('guest')->except('logout');
}

/**
* Get a validator for an incoming registration request.
*
* @param  array  $data
* @return \Illuminate\Contracts\Validation\Validator
*/
public function reg($type){
if($type!="client") {
return dd($type);
}
else {
return view('auth.register', compact('type'));
}
}
public function regs($type="client"){

return view('auth.register',compact('type'));
}
protected function signup(Request $request)
{
$this->validate($request,[
'name' => ['required', 'string', 'max:255'],
'email' => ['required', 'string', 'email', 'max:255', 'unique:clients'],
'password' => ['required', 'string', 'min:8', 'confirmed'],
],[
'name.required' =>'يرجي ادخال الاسم ',
'email.unique' =>'البريد الالكتروني مسجل مسبقا ',
'password.required'=>'برجاء ادخال كلمة السر  ',
'password.confirmed'=>'  الرقم السري غير متطابق',
]);
Client::create([
'name' => $request->name,
'email' => $request->email,
'password' => Hash::make($request->password),
]);
if(Auth::guard($this->chekGuard($request))->attempt(['email' => $request->email, 'password' => $request->password])){
return $this->redirect($request);
}
else{
dd('error');
}
}
}
