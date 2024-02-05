<?php
namespace App\Repository;
use App\Http\Requests\UserRequest;
use App\Models\Account;
use App\Models\Investment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class InvestmentRepository implements InvestmentRepositoryInterface
{
    public function index(){
try{
        $investments = Investment::sortable()->where('type','invest')->paginate(25);
        return view('admin.investments.index', compact('investments'));
}catch(\Exception $e){

		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
    }

    public function editinvestment($id){


    }

    public function update($request){


    }

    public function bulkDelete(){

    }

    public function search($request){
        $output = "";
        $output .= '<tr>

                                    <th >' . trans('admin.name') . '</th>
                                    <th >' . trans('admin.sender_id') . '</th>
                                    <th >' . trans('admin.units') . '</th>

                              <th >' . trans('admin.invested_units') . '</th>
                                    <th>' . trans('admin.invested_cost') . '</th>
                                    <th >' . trans('admin.show_details') . '</th>
                                    <th >' . trans('admin.active') . '</th>
                                </tr>';
        $accounts = Investment::where('sender_id', 'Like', '%' . $request->search . '%')->get();
        foreach ($accounts as $account) {
            $output .= '<tr id="sid ' . $account->id . '}}">
<td> ' . '<input type="checkbox" name="ids[ ' . $account->id . ' ]" class="checkbox" value="' . $account->id . '"/> ' . '</td>
<td>' . $account->invest->title . '</td>
<td>' . $account->sender_id . '</td>
<td>' . $account->invest->unit_price . '</td>
<td>' . $account->units . '</td>
<td>' . $account->cost . '</td>
 <td>
 ' . ' <a href="/show_investments/' . $account->id . '" class="btn btn-primary btn-sm">' . trans('admin.show_details') . '</a>' . '</td>
   <td>' . ' <a href="/show_active/' . $account->id . '"  class="btn btn-danger btn-sm">' . trans('admin.active_invest') . '</a>' . '</td>
</tr>';
        }
        return response($output);
    }

    public function deleteinvestment($id){

    }

    public function approved($id){

    }

    public function canceled($id){

    }

    public function  show_investments($id){
        try{
        $investments=Investment::findorfail($id);
        return view('admin.investments.show',compact('investments'));
        }catch(\Exception $e){

		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
    }
}
