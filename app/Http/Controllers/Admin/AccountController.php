<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\File;
use App\Models\Investment;
use App\Models\Property;
use App\Models\UserTransaction;
use App\Repository\AccountRepositoryInterface;
use App\Repository\AdminRepositoryInterface;
use http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    protected $Account;

    public function __construct(AccountRepositoryInterface $Account)
    {
        $this->Account = $Account;
    }

    public function index()
    {

        return $this->Account->index();

    }


    public function create()
    {
        return $this->Account->create();
    }


    public function store(Request $request)
    {
        return $this->Account->store($request);
    }


    public function show_details($id)
    {
        return $this->Account->show_details($id);
    }


    public function editaccount($id)
    {

        return $this->Account->editaccount($id);
    }

    public function deleteaccount($id)
    {

        return $this->Account->deleteaccount($id);
    }


    public function update(Request $request)
    {
        return $this->Account->update($request);
    }

    public function bulkDelete(){
        return $this->Account->bulkDelete();
    }
    public function search(Request $request){
        return $this->Account->search($request);
    }

    public function approved($id){
        return $this->Account->approved($id);
        }
        public function canceled($id){

            return $this->Account->canceled($id);

        }

    public function dFile(Request $request){

        return $this->Account->Download($request->file);

    }
public function show_active($id)
    {
        $accounts = Investment::findorfail($id);
        return view('admin.accounts.active', compact('accounts'));
    }


    public function active(Request $request)
    {
       try{
              DB::beginTransaction();

             $transactions = Investment::findOrFail($request->id);
        $transactions->update([
            'status' => $request->status,
             ]);
            $account = Account::where('id', $request->sender_id)->where('user_type', 'App\Models\Client')->first();
            $on_hold_balance = $account->on_hold_balance;
            $invest = Investment::where('sender_id', $request->sender_id)->where('propperity_id', $request->propperity_id)->where('type', 'invest')->where('id', $request->id)->first();
            $status = $invest->status;
            $cost = $invest->cost;
            $n = $invest->units;
            $is_transfered = $invest->is_transfered;
            $type = $invest->type;
            $ben=$invest->benfits;
            $prop_id = $invest->propperity_id;
            $properties = Property::where('id', $prop_id)->first();
            $max = $properties->remain_units;
            $benfits=$properties->penefits_from_investement;
             $per=$properties->investement_percentage;
            $un=$properties->units;
            if ( $request->status=='active') {
                if ($is_transfered == 'false') {
                    if ($type == 'invest') {
                        if ($max - $n >= 0) {
                            if (Account::where('user_type', 'App\Models\Property')->where('user_id', $prop_id)->exists()) {
                                $system = Account::where('user_id', $prop_id)->where('user_type', 'App\Models\Property')->first();
                                $prop = $system->balance;
                                $T = $prop + $cost;
                                $updatesystem = Account::where('user_id', $prop_id)->where('user_type', 'App\Models\Property')
                                    ->update(['balance' => $T]);
                                $units = $max - $n;
                                $updateunits = Property::where('id', $prop_id)
                                    ->update(['remain_units' => $units,
                                    'investement_percentage'=>$per+$n/$un*100,
                                    ]);
                                $update_transfer = Investment::where('sender_id', $request->sender_id)->where('propperity_id', $prop_id)->where('type', 'invest')->where('id', $request->id)->update(['is_transfered' => 'true',
                                'benfits'=>$ben+$n*$benfits,
                                ]);
                                if ($units == 0) {
                                    $updateunits = Property::where('id', $prop_id)
                                        ->update(['status' => "invested"]);
                                }
                            
                                DB::commit();
                                 session()->flash('Add', trans('admin.addmsg'));
                                 return redirect()->back();
                            } else
                                $acc = Account::create([
                                    'balance' => $cost,
                                    'status' => 'approved',
                                    'user_id' => $prop_id,
                                    'user_type' => 'App\Models\Property',
                                ]);
                            $units = $max - $n;
                            $updateunits = Property::where('id', $prop_id)
                                ->update(['remain_units' => $units,
                                    'investement_percentage'=>$per+$n/$un*100,
                                ]);
                            $update_transfer = Investment::where('sender_id', $request->sender_id)->where('id', $request->id)->update(['is_transfered' => 'true',
                                'benfits'=>$ben+$n*$benfits,
                                ]);
                            if ($units == 0) {
                                $updateunits = Property::where('id', $prop_id)
                                    ->update(['status' => "invested"]);
                            }
                            DB::commit();
                             session()->flash('Add', trans('admin.addmsg'));
                            return redirect()->back();
                        } else {
                             session()->flash('delete', trans('admin.unauthorized'));
                         return redirect()->back();
                        }
                    }

                } else {
                     session()->flash('delete', trans('admin.ready'));
                     return redirect()->back();
                }
            } else {
            $transactions->update([
            'status' => $request->status,
             ]);
                 session()->flash('Add', trans('admin.addmsg'));
                 return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function show_sell($id)
    {
        $accounts = Investment::findorfail($id);
        return view('admin.accounts.show_sell', compact('accounts'));
    }
     public function sell_unit(Request $request)
    {
        try{
              DB::beginTransaction();
            $transactions = Investment::findOrFail($request->id);
        $transactions->update([
            'status' => $request->status,
             ]);
            $account = Account::where('id', $request->sender_id)->where('user_type', 'App\Models\Client')->first();
            $amount = $account->balance;
            $amo = $account->on_hold_balance;
            $propin = Account::where('user_id', $request->propperity_id)->where('user_type', 'App\Models\Property')->first();
            $balan = $propin->balance;
            $invest = Investment::where('sender_id', $request->sender_id)->where('propperity_id', $request->propperity_id)->where('type', 'sell')->where('is_transfered','false')->first();
            $is_transfered = $invest->is_transfered;
            $type = $invest->type;
            $cost = $invest->cost;
            $units = $invest->units;
            $prop_id = $invest->propperity_id;
            $invested = Investment::where('sender_id', $request->sender_id)->where('propperity_id', $request->propperity_id)->where('type', 'invest')->where('is_transfered','true')->first();
            $unts = $invested->units;
            $ben=$invested->benfits;
            $co=$invested->cost;
            $accadmin = Account::where('id', 0)->first();
            $balance = $accadmin->on_hold_balance;
            $balanced = $accadmin->balance;
            $properties = Property::where('id', $request->propperity_id)->first();
            $max = $properties->remain_units;
            $benfits=$properties->penefits_from_investement;
            $per=$properties->investement_percentage;
            $un=$properties->units;
                if ($is_transfered == 'false') {
                     if ($request->status=='active') {
                    if ($type == 'sell') {
                        if($unts >= $units){
                        $trans = UserTransaction::create(array_merge(
                            ['sender_id' => $request->id],
                            ['reciever_id' => 0],
                            ['reciever_type' => 'App\Models\Account'],
                            ['sender_type' => 'App\Models\Account'],
                            ['type' => 'sell'],
                            ['amount'=>$cost]
                        ));
                        $all = $cost + $amount;
                        $total = $balance-$cost;
                        $uni=$balan-$cost;
                        $balancing=$cost+$balanced;
                        $new=$max+$units;
                        $un=$unts-$units;
                        $am=$amo-$cost;
                        $v=$co-$cost;
                        $updated_k = Account::where('id', $request->sender_id)
                            ->update(['balance' => $all
                            ]);
                        $updated_n = Account::where('id', 0)
                            ->update(['balance' => $balancing
                            ]);
                        $updated_on = Account::where('id', $request->sender_id)
                            ->update(['on_hold_balance' => $am
                            ]);
                        $update = Account::where('id', 0)
                            ->update(['on_hold_balance' => $total]);
                        $update1=Account::where('user_id', $request->propperity_id)->where('user_type', 'App\Models\Property')->update(['balance'=>$uni
                        ]);
                        $update2=Property::where('id',$request->propperity_id)->update(['remain_units'=>$new,
                            'investement_percentage'=>$per-$units/$un*100,
                        ]);
                        $update_inv = Investment::where('propperity_id', $request->propperity_id)->where('sender_id', $request->sender_id)->where('id',$request->id)->where('type', 'sell')->update(['status' => 'sold',
                            'is_transfered' => 'true',
                            'benfits'=>abs($ben-$unts*$benfits),
                        ]);
                        $update_info = Investment::where('propperity_id', $request->propperity_id)->where('sender_id', $request->sender_id)->where('type', 'invest')->where('is_transfered','true')->update([
                            'units' => $un,
                            'cost'=>$v,
                        ]);
                        DB::commit();
                         session()->flash('Add', trans('admin.addmsg'));
                      return redirect()->back();
                    }else{
                         session()->flash('delete', trans('admin.unauthorized'));
                       return redirect()->back();
                    }

                }    else {
                     session()->flash('delete', trans('Not Type Sell'));
                      return redirect()->back();
                    }
                }else {
                      $transactions->update([
            'status' => $request->status,
             ]);
                     session()->flash('Add', trans('admin.addmsg'));
                return redirect()->back();
            }
            }else {
                session()->flash('delete', trans('admin.readys'));
                     return redirect()->back();
                }

        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function deletefile($id){
        $accounts = File::find($id);
        $accounts->delete();
        session()->flash('delete',trans('admin.deletemsg'));
        return redirect()->back();
    }
}
