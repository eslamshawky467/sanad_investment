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
class UserTransactionRepository implements UserTransactionRepositoryInterface
{

    public function index()
    {
        try{
        $transactions = UserTransaction::sortable()->where('type', 'balance')->where('sender_type', 'App\Models\Account')->paginate(25);
        return view('admin.Transaction.index', compact('transactions'));
        }catch(\Exception $e){
		
		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
    }

    public function create()
    {
        try{
        $accounts = Account::where('user_type', 'App\Models\Client')->where('status','approved')->get();
        return view('admin.Transaction.create', compact('accounts'));}
    catch(\Exception $e){
		
		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
    }

    public function store($request)
    {
      try{
              DB::beginTransaction();
        $account = Account::where('id', $request->sender_id)->first();
        $balance = $account->balance;
         $accou=Account::where('id',0)->first();
        $balancing=$accou->balance;
        UserTransaction::create([
            'type' => 'balance',
            'amount' => $request->amount,
            'sender_id' => $request->sender_id,
            'sender_type' => 'App\Models\Account',
        ]);
        $final = $balance + $request->amount;
         $final2=$balancing+$request->amount;
    $acc = Account::where('id', $request->sender_id)->update([
        'balance'=>$final
        ]);
             $acco=Account::where('id',0)->update([
             'balance'=>$final2
             ]);
             DB::commit();
        session()->flash('Add', trans('admin.addmsg'));
        return redirect()->route('transactions.index');
        }catch(\Exception $e){
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
        session()->flash('delete', trans('admin.deletemsg'));
        return redirect()->back();
    }

    private function delete(UserTransaction $transaction)
    {
        $transaction->delete();

    }

    public function search($request)
    {

        $output = "";
        $output .= '<tr>
                                   
                                    <th >' . trans('admin.amount') . '</th>
                                    <th >' . trans('admin.sender') . '</th>
                                    <th >' . trans('admin.sender_id') . '</th>
                                         <th >' . trans('admin.type') . '</th>


                                                     <th >' . trans('admin.created_at') . '</th>

                                   
                                </tr>';
        $transactions = UserTransaction::where('sender_id', 'Like', '%' . $request->search . '%')->where('type', 'balance')->get();
        foreach ($transactions as $t) {
            $output .= '<tr id="sid ' . $t->id . '}}">

<td>' . $t->amount . '</td>
<td>' . $t->sender->client->name . '</td>
<td>' . $t->sender_id . '</td>
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
        session()->flash('delete', trans('admin.deletemsg'));
        return redirect()->route('transactions.index');
    }
}
