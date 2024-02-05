<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Traits\AuthTrait;
use Illuminate\Support\Facades\Session;
use App\Providers\RouteServiceProvider;


class LoginController extends Controller
{

    use AuthTrait;
    use AuthenticatesUsers;
    public function log($type){
        if($type !="admin" && $type!="client") {
            return view('errors.404');
        }
        else {
            return view('auth.login', compact('type'));
        }
    }
    public function logs($type='admin'){

        return view('auth.login',compact('type'));
    }

    public function login(Request $request){
        if (Auth::guard($this->chekGuard($request))->attempt(['email' => $request->email, 'password' => $request->password])) {
            return $this->redirect($request);
        }
        else{
            return redirect()->back()->with('message', 'E-mail Or Password is Wrong');
        }

    }

    public function logout(Request $request,$type)
    {
           Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Auth::guard($type)->logout();
        return redirect('/');
    }

}
