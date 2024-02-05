<?php
namespace App\Repository;
use App\Http\Requests\UserRequest;
use App\Http\Traits\ProperityTrait;
use App\Mail\Payment;
use App\Models\Account_admin;
use App\Models\Client;
use App\Models\User;
use App\Mail\SendUserDetails;
use App\Models\UserTransaction;
use App\Repository\AccountRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Account;
use App\Models\File;
use Illuminate\Support\Facades\DB;
class PaymentRepository implements PaymentRepositoryInterface
{
    use ProperityTrait;
    public function index()
    {
        try{
        $payments=UserTransaction::sortable()->where('type','payment')->paginate(25);
        return view('admin.payment.index', compact('payments'));}
        catch(\Exception $e){
		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
    }

    public function create()
    {
        try{
        $accounts=Account::where('user_type','App\Models\Client')->get();
        return view('admin.payment.create',compact('accounts'));
         } catch(\Exception $e){
		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
    }

    public function store($request)
    {
        try{
              DB::beginTransaction();
        $accadmin = Account_admin::where('id', 0)->where('admin_type', 'App\Models\User')->first();
        $balance = $accadmin->balance;
        $id = $accadmin->id;
        $acca = Account::where('id', 0)->first();
        $bal = $acca->balance;
        $accuser = Account::where('user_id', $request->reciever_id)->where('user_type', 'App\Models\Client')->first();
        $balan = $accuser->balance;
        $ids=$accuser->id;
        if ($balance - $request->amount >= 0) {
            $balanced = $balance - $request->amount;
            $balancing = $balan + $request->amount;
            $balanc=$bal+$request->amount;
        $acc = UserTransaction::create([
            'amount' => $request->amount,
            'sender_id' => $id,
            'sender_type' => 'App\Models\Account_admin',
            'reciever_id' => $ids,
            'reciever_type' => 'App\Models\Account',
            'type' => 'payment',
        ]);
            $updated_on = Account_admin::where('id',0)
                ->update(['balance' => $balanced
                ]);
            $updated=Account::where('id',$ids)->where('user_type', 'App\Models\Client')
                ->update(['balance' => $balancing
                ]);
                
                 $updated_at=Account::where('id',0)
                ->update(['balance' => $balanc
                ]);
                
            Mail::to($request->email)->send(new Payment($balancing,$request->amount));
            DB::commit();
            session()->flash('Add', trans('Successfully Added'));
            return redirect()->route('payment.index');
    }
        else{
            session()->flash('delete', trans('Balance Not Enough'));
            return redirect()->back();
        }
        }catch(\Exception $e){
		DB::rollback();
		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
    }

}
