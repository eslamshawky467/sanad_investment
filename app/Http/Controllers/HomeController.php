<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Account_admin;
use App\Models\Account;
use App\Models\Property;
use App\Models\Investment;

class HomeController extends Controller
{
    public function index($type='admin')
    {
        return view('auth.login',compact('type'));
    }
    public function home()
    {
        return view('home');
    }
    public function dashboard()
    {
        try{
        $admins=Account_admin::where('id',0)->first();
        $money=$admins->balance;
        $admin=Account::where('id',0)->first();
         $onhold=$admin->on_hold_balance;
        $balanced=$admin->balance;
           $remain=Property::sum('remain_units');
             $total=Property::sum('total_units');
             $inv=Investment::where('status','active')->where('is_transfered','true')->where('type','invest')->sum('units');
        return view('admin.welcome',compact('money','onhold','balanced','remain','total','inv'));
    

        }catch(\Exception $e){

		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
}
}