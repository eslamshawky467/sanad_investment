<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if (Request::is(app()->getLocale() . '/dashboard')) {
                return route('login');
            }
            elseif(Request::is(app()->getLocale() . '/user')) {
                return route('login');
            }
            else {
                return route('login');
            }
        }
    }
}
