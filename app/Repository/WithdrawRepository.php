<?php
namespace App\Repository;
use App\Mail\SendUserDetails;
use App\Models\Account;
use App\Models\Client;
use App\Models\User;
use App\Models\UserTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
class WithdrawRepository implements WithdrawRepositoryInterface {

    public function index(){
        try{
        $transactions=UserTransaction::sortable()->where('type','withdraw')->where('reciever_type','App\Models\Account')->paginate(25);
        return view('admin.Withdraw.index',compact('transactions'));
        }
        catch(\Exception $e){
	
		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
    }
    public function create(){
        $accounts=Account::where('user_type','App\Models\Client')->where('status','approved')->get();
        return view('admin.Withdraw.create',compact('accounts'));
    }
    public function store($request)
    {
        DB::beginTransaction();
        try{
        $account=Account::where('id',$request->reciever_id)->first();
        $balance=$account->balance;
        $accou=Account::where('id',0)->first();
        $balancing=$accou->balance;
        UserTransaction::create([
            'type' => 'withdraw',
            'amount'=>$request->amount,
            'reciever_id'=>$request->reciever_id,
            'reciever_type'=>'App\Models\Account',
        ]);
        $final=$balance-$request->amount;
        $final2=$balancing-$request->amount;
         $account=Account::where('id',$request->reciever_id)->update([
             'balance'=>$final
             ]);
                     $acco=Account::where('id',0)->update([
             'balance'=>$final2
             ]);
             DB::commit();
        session()->flash('Add', trans('admin.addmsg'));
        return redirect()->route('withdraw.index');
     }   catch(\Exception $e){
		DB::rollback();
		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
    }


    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {
            $transactions = UserTransaction::FindOrFail($recordId);
            $this->delete($transactions);
        }
        session()->flash('delete',trans('admin.deletemsg'));
        return redirect()->back();
    }
    private function delete(UserTransaction $transaction)
    {
        $transaction->delete();

    }

    public function search($request)
    {

        $output = "";
        $output .='<tr>
                                   
                                    <th >'.trans('admin.amount').'</th>
                                    <th >'.trans('admin.reciever').'</th>
                                    <th >'.trans('admin.reciever_id').'</th>
                                         <th >'.trans('admin.type').'</th>


                                                     <th >'.trans('admin.created_at').'</th>

                                   
                                </tr>';
        $transactions = UserTransaction::where('reciever_id', 'Like', '%' . $request->search . '%')->where('type','withdraw')->get();
        foreach ($transactions as $t) {
            $output .= '<tr id="sid '.$t->id.'}}">

<td>' . $t->amount . '</td>
<td>' . $t->reciever->client->name .'</td>
<td>' . $t->reciever_id . '</td>
<td>' . $t->type . '</td>
<td>' . $t->created_at . '</td>
 
</tr>';
        }
        return response($output);
    }
    public function deletetransaction($id)
    {
        $transactions = UserTransaction::find($id);
        $transactions->delete();
        session()->flash('delete',trans('admin.deletemsg'));
        return redirect()->route('withdraw.index');
    }
}
