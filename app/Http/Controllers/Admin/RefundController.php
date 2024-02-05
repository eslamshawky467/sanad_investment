<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\UserTransaction;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    public function index(){
        $transactions=UserTransaction::sortable()->where('type','refund')->where('reciever_type','App\Models\Account')->paginate(25);
        return view('admin.refund.index',compact('transactions'));
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
                                    <th >'.trans('admin.sender').'</th>
                                    <th >'.trans('admin.sender_id').'</th>
                                         <th >'.trans('admin.type').'</th>


                                                     <th >'.trans('admin.created_at').'</th>

                                  
                                </tr>';
        $transactions = UserTransaction::where('sender_id', 'Like', '%' . $request->search . '%')->where('type','refund')->get();
        foreach ($transactions as $t) {
            $output .= '<tr id="sid '.$t->id.'}}">

<td>' . $t->amount . '</td>
<td>' . $t->sender->client->name .'</td>
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
        session()->flash('delete',trans('admin.deletemsg'));
        return redirect()->route('withdraw.index');
    }
}
