<?php

namespace App\Http\Traits;
use App\Providers\RouteServiceProvider;

trait AuthTrait
{
    public function chekGuard($request)
    {
        if ($request->type == 'client') {
            $guardName = 'client';
        }
        elseif ($request->type == 'admin'){
            $guardName = 'web';
        }
        else{
        return dd("error");
        }
        return $guardName;
    }

    public function redirect($request)
    {
        if ($request->type == 'client') {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        else {
            return redirect()->intended(RouteServiceProvider::ADMIN);
        }
    }

}
