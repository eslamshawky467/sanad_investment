<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Payment;
use App\Models\Account;
use App\Models\Account_admin;
use App\Models\Client;
use App\Models\File;
use App\Models\Investment;
use App\Models\Property;
use App\Models\Transform;
use App\Models\UserTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class Account_adminController extends Controller
{


    public function index()
    {
        try{
        $admin=Account_admin::all();
        return view('admin.account_admin.index', compact('admin'));
        }catch(\Exception $e){

		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
    }
    public function get_trans(){
        try{
        $acc=Account::where('id',0)->first();
        $balance=$acc->on_hold_balance;
        return view('admin.account_admin.transform',compact('balance'));
       } catch(\Exception $e){

		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
    }
public function transform(Request $request)
{
    DB::beginTransaction();
    try {
    $acc = Account::where('id', 0)->first();
    $balance = $acc->on_hold_balance;
    $account = Account_admin::where('id', 0)->first();
    $balan = $account->balance;
    $trans = Transform::create(array_merge(
        ['sender_type' => 'App\Models\Account'],
        ['sender_id' => 0],
        ['reciever_id' => 0],
        ['reciever_type' => 'App\Models\Account_admin'],
        ['balance' => $request->balance],
    ));
    if ($balance - $request->balance < 0) {
         DB::commit();
        session()->flash('Add', trans('no'));
    } else {
        $updated_on = Account_admin::where('id', 0)
            ->update(['balance' => $balan + $request->balance,
            
            ]);
        $updated_in = Account::where('id', 0)
            ->update(['on_hold_balance' => $balance - $request->balance,
            ]);}
             DB::commit();
        session()->flash('Add', trans('admin.addmsg'));
        return redirect()->back();
       }catch(\Exception $e){
		DB::rollback();
		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
}    
    

    public function create()
    {
        
        return view('admin.account_admin.create');
    }


    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
        $account = Account_admin::where('admin_id', $request->admin_id)->first();
        $balance = $account->balance;
        $balanced=$balance+$request->balance;
        $updated_on = Account_admin::where('admin_id',$request->admin_id)
            ->update(['balance' => $balanced
            ]);
             DB::commit();
        return redirect()->route('accounts_admin.index');
        }catch(\Exception $e){
		DB::rollback();
		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
    }
    public function make_invest(Request $request){
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'units' => 'required'
            ], [
                'units' => 'admin.requireunit',
            ]);

            if ($validator->fails()) {
                return response()->json(['message'=>$validator->errors()->first(),'status'=> 422]);
            }
            $properties = Property::where('id', $request->propperity_id)->first();
            $cost = $properties->unit_price;
            $min = $properties->min_investement;
            $max = $properties->remain_units;
            $created_at= $properties->last_investement_date;
            $benfits=$properties->penefits_from_investement;
            $per=$properties->investement_percentage;
            $un=$properties->units;
            $date=Carbon::now();
            $dat= $date->lte($created_at);
            $accadmin = Account_admin::where('id', 0)->first();
            $balance=$accadmin->balance;
            $acc = Account::where('id', 0)->first();
            $bein=$acc->on_hold_balance;
            if ($dat == true) {
                    if ($max >= $request->units && $request->units >= $min) {
                        if ($balance >= $cost * $request->units) {
                            if (Investment::where('propperity_id', $request->propperity_id)->where('sender_id', 1)->where('type', 'invest')->where('status', 'active')->exists()) {
                                $prop = Investment::where('propperity_id', $request->propperity_id)->where('sender_id', 1)->where('type', 'invest')->first();
                                $units = $prop->units;
                                $cosun = $prop->cost;
                                $total = $balance - ($cost * $request->units);
                                $upd = Account_admin::where('id', 0)
                                    ->update(['balance' => $total
                                    ]);
                                $upd = Account::where('id', 0)
                                    ->update(['on_hold_balance' => $bein+ $cost*$request->units
                                    ]);

                                $update_uni = Investment::where('propperity_id', $request->propperity_id)->where('sender_id', 1)->where('type', 'invest')
                                    ->update(['units' => $units + $request->units,
                                        'cost' => $cosun + $request->units * $cost
                                    ]);
                                if (Account::where('user_type', 'App\Models\Property')->where('user_id', $request->propperity_id)->exists()) {
                                    $system = Account::where('user_id', $request->propperity_id)->where('user_type', 'App\Models\Property')->first();
                                    $propes = $system->balance;
                                    $T = $propes + $request->units * $cost;
                                    $updatesystem = Account::where('user_id', $request->propperity_id)->where('user_type', 'App\Models\Property')
                                        ->update(['balance' => $T]);
                                    $units = $max - $request->units;
                                    $updateunits = Property::where('id', $request->propperity_id)
                                        ->update(['remain_units' => $units
                                            ,   'investement_percentage'=>$per+$request->units/$un*100,
                                        ]);
                                    $update_transfer = Investment::where('sender_id', $request->sender_id)->where('id', $request->id)->update(['is_transfered' => 'true'
                                        ,    'benfits'=>$benfits+$request->units*$benfits,
                                    ]);
                                    if ($units == 0) {
                                        $updateunits = Property::where('id', $request->propperity_id)
                                            ->update(['status' => "invested"]);
                                    }
                                } else{
                                $acc = Account::create([
                                    'balance' => $request->units*$cost,
                                    'status' => 'approved',
                                    'user_id' => $request->propperity_id,
                                    'user_type' => 'App\Models\Property',
                                ]);
                            $units = $max - $request->units;
                            $updateunits = Property::where('id', $request->propperity_id)
                                ->update(['remain_units' => $units
                             ,   'investement_percentage'=>$per+$request->units/$un*100,
                                ]);
                            $update_transfer = Investment::where('sender_id', $request->sender_id)->where('id', $request->id)->update(['is_transfered' => 'true'
                            ,    'benfits'=>$benfits+$request->units*$benfits,
                            ]);
                            if ($units == 0) {
                                $updateunits = Property::where('id', $request->propperity_id)
                                    ->update(['status' => "invested"]);
                            }}
                                DB::commit();
                                session()->flash('Add', trans('admin.addmsg'));
                                return redirect()->back();
                            } elseif (Investment::where('propperity_id', $request->propperity_id)->where('sender_id', 1)->where('type', 'invest')->where('status', 'onhold')->exists()) {
                                session()->flash('delete', trans('admin.wait to accept first request'));
                                return redirect()->back();
                            } else {
                                $investment = Investment::create(array_merge(
                                    $validator->validated(),
                                    ['sender_id' => 0],
                                    ['reciever_id' => 0],
                                    ['reciever_type' => 'App\Models\Account'],
                                    ['sender_type' => 'App\Models\Account_admin'],
                                    ['status' => 'active'],
                                    ['cost' => $cost * $request->units],
                                    ['is_transfered' => 'true'],
                                    ['type' => 'invest'],
                                    ['propperity_id'=>$request->propperity_id]
                                ));
                                $total = $balance - ($cost * $request->units);
                                $upd = Account_admin::where('id', 0)
                                    ->update(['balance' => $total
                                    ]);
                                $upd = Account::where('id', 0)
                                    ->update(['on_hold_balance' => $bein + $cost* $request->units
                                    ]);
                                if (Account::where('user_type', 'App\Models\Property')->where('user_id', $request->propperity_id)->exists()) {
                                    $system = Account::where('user_id', $request->propperity_id)->where('user_type', 'App\Models\Property')->first();
                                    $propes = $system->balance;
                                    $T = $propes + $request->units * $cost;
                                    $updatesystem = Account::where('user_id', $request->propperity_id)
                                        ->update(['balance' => $T]);
                                    $units = $max - $request->units;
                                    $updateunits = Property::where('id', $request->propperity_id)
                                        ->update(['remain_units' => $units,
                                          'investement_percentage'=>$per+$request->units/$un*100,
                                        ]);
                                    $update_transfer = Investment::where('sender_id', $request->sender_id)->where('propperity_id', $request->propperity_id)->where('type', 'invest')->where('id', $request->id)->update(['is_transfered' => 'true',
                                    'benfits'=>$benfits+$request->units*$benfits,
                                    ]);
                                    if ($units == 0) {
                                        $updateunits = Property::where('id', $request->propperity_id)
                                            ->update(['status' => "invested"]);
                                    }
                                } else{
                                    $acc = Account::create([
                                        'balance' => $request->units*$cost,
                                        'status' => 'approved',
                                        'user_id' => $request->propperity_id,
                                        'user_type' => 'App\Models\Property',
                                    ]);
                                    $units = $max - $request->units;
                                    $updateunits = Property::where('id', $request->propperity_id)
                                        ->update(['remain_units' => $units,
                                            'investement_percentage'=>$per+$request->units/$un*100,
                                        ]);
                                    $update_transfer = Investment::where('sender_id', $request->sender_id)->where('propperity_id', $request->propperity_id)->where('type', 'invest')->where('id', $request->id)->update(['is_transfered' => 'true',
                                        'benfits'=>$benfits+$request->units*$benfits,
                                    ]);
                                    if ($units == 0) {
                                        $updateunits = Property::where('id', $request->propperity_id)
                                            ->update(['status' => "invested"]);
                                    }}
                                DB::commit();
                                session()->flash('Add', trans('admin.addmsg'));
                                return redirect()->back();

                            }
                        } else {
                            session()->flash('delete', trans('admin.balance'));
                            return redirect()->back();
                        }
                    } else {
                        session()->flash('delete', trans('admin.unauthorized'));
                        return redirect()->back();
                    }
                } else {
                session()->flash('delete', trans('admin.time_to'));
                return redirect()->back();
                }

    }
        catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editaccount_admin($id)
    {
        $admin=Account_admin::findorfail($id);
        return view('admin.account_admin.edit',compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        try{
        $account = Account_admin::where('admin_id', $request->admin_id)->first();
        $balance = $account->balance;
        $balanced=$balance-$request->balance;
        $updated_on = Account_admin::where('admin_id',$request->admin_id)
            ->update(['balance' => $balanced
            ]);
             DB::commit();
        return redirect()->route('accounts_admin.index');
        }catch(\Exception $e){
		DB::rollback();
		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function withd($id){
        try{
        $admin=UserTransaction::findorfail($id);
        $accounts=Account::where('user_type','App\Models\Client')->get();
        $am=UserTransaction::where('id',$id)->first();
        $amount=$am->amount;
        return view('admin.account_admin.withd', compact('admin','amount','accounts'));}
        catch(\Exception $e){

		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
    }
    public function withdraws(Request $request){
             DB::beginTransaction();
        try{
        $account = Account_admin::where('id',0 )->first();
        $balance = $account->balance;
        $acca = Account::where('id', 0)->first();
        $bal = $acca->balance;
        $accounts = Account::where('id',$request->reciever_id )->first();
        $balanced = $accounts->balance;
        $process=UserTransaction::where('id',$request->process)->first();
        $pro=$process->amount;
        $updated_on = Account_admin::where('id',0)
            ->update(['balance' => $balance+$request->balance
            ]);
        $updated_in = Account::where('id',$request->reciever_id)
            ->update(['balance' => $balanced-$request->balance
            ]);
               $updated_at=Account::where('id',0)
                ->update(['balance' => $bal-$request->balance
                ]);
        $updated_for = UserTransaction::where('id',$request->process)
            ->update(['amount' =>$pro-$request->balance
            ]);
        Mail::to($request->email)->send(new Payment($balanced,$request->amount));
         DB::commit();
        return redirect()->route('payment.index');
        }catch(\Exception $e){
		DB::rollback();
		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}

    }
}
