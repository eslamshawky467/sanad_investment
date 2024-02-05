<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Investment;
use Illuminate\Http\Request;

class SellController extends Controller
{
    public function index(){

        $investments = Investment::sortable()->where('type','sell')->orWhere('type','sold')->paginate(25);
        return view('admin.investments.sell', compact('investments'));
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

<td>' . $account->invest->title . '</td>
<td>' . $account->sender_id . '</td>
<td>' . $account->invest->unit_price . '</td>
<td>' . $account->units . '</td>
<td>' . $account->cost . '</td>

   <td>' . ' <a href="/show_sell/' . $account->id . '"  class="btn btn-danger btn-sm">' . trans('admin.active_invest') . '</a>' . '</td>
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
        $investments=Investment::findorfail($id);
        return view('admin.investments.show',compact('investments'));
    }

    public function prop(){
        $investments = Account::sortable()->where('user_type','App\Models\Property')->paginate(25);
        return view('admin.accounts.property', compact('investments'));
    }

}
