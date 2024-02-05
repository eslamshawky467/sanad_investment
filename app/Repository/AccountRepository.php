<?php
namespace App\Repository;
use App\Http\Requests\UserRequest;
use App\Http\Traits\ProperityTrait;
use App\Models\Client;
use App\Models\User;
use App\Mail\SendUserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Account;
use App\Models\File;
use App\Repository\AccountRepositoryInterface;
use Illuminate\Support\Facades\DB;
class AccountRepository implements AccountRepositoryInterface
{

    use ProperityTrait;
    public function index()
    
    {
        try{
        $accounts = Account::sortable()->where('user_type','App\Models\Client')->paginate(25);
        return view('admin.accounts.index', compact('accounts'));
        }catch(\Exception $e){

		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
    }

    public function create()
    {
        try{
        $users=Client::all();
        return view('admin.accounts.create',compact('users'));
        }catch(\Exception $e){

		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
    }

    public function store($request)
    {
        try{
              DB::beginTransaction();
    if (Account::where('user_type', 'App\Models\Client')->where('user_id', $request->user_id)->where('status','!=','canceled')->exists()){
          session()->flash('delete', trans('admin.Account_Exist'));
          return redirect()->back();
    }
    else
       $acc= Account::create([
            'status' =>'approved',
            'user_type'=>'App\Models\Client',
            'balance'=>$request->balance,
            'user_id'=>$request->user_id,
        ]);
        foreach($request->file('image') as $index=> $image)
        {
            $name= $this->saveImage($image,$index,'Accounts',$request->user_id);
            // insert in image_table
            $images= new File();
            $images->file_name=$name;
            $images->Fileable_id= $acc->id;
            $images->Fileable_type = 'App\Models\Account';
            $images->type=$this->FileType($image->getClientOriginalExtension());
            $images->save();
        }
        DB::commit();
         session()->flash('Add', trans('admin.addmsg'));
        return redirect()->route('accounts.index');
     }   catch(\Exception $e){
		DB::rollback();
		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
        
    }

    public function editaccount($id)
    {
        try{
        $accounts=Account::findorfail($id);
        $users=Client::all();
        return view('admin.accounts.edit',compact('accounts','users'));
       } catch(\Exception $e){

		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
    }

    public function update($request)
    {
        try{
              DB::beginTransaction();
        $accounts = Account::findOrFail($request->id);
       $acc= $accounts->update([
            'status' =>$request->status,
            'balance'=>$request->balance,
        ]);
        DB::commit();
        session()->flash('edit', trans('admin.editmsg'));
        return redirect()->route('accounts.index');
        }catch(\Exception $e){
		DB::rollback();
		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
    }

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $accounts = Account::FindOrFail($recordId);
            $this->delete($accounts);

        }
        session()->flash('delete',trans('admin.deletemsg'));
        return redirect()->back();
    }

    private function delete(Account $account)
    {
        $account->delete();

    }

    public function search($request)
    {
        $output = "";
        $output .= '<tr>
                                    <th>' . trans('admin.select') . '</th>
                                    <th >' . trans('admin.name') . '</th>
                                    <th >' . trans('admin.account_id') . '</th>
                                       <th >' . trans('admin.status') . '</th>
                                    <th >' . trans('admin.bank_balance') . '</th>
                                    <th >' . trans('admin.edit') . '</th>
                                </tr>';
        $accounts = Account::where('id', 'Like', '%' . $request->search . '%')->get();
        foreach ($accounts as $account) {
            $output .= '<tr id="sid ' . $account->id . '}}">
<td> ' . '<input type="checkbox" name="ids[ ' . $account->id . ' ]" class="checkbox" value="' . $account->id . '"/> ' . '</td>
<td>' . $account->client->name . '</td>
<td>' . $account->id . '</td>
<td>' . $account->status . '</td>
<td>' . $account->balance . '</td>
   <td>' . ' <a href="/editaccount/' . $account->id . '"  class="btn btn-primary btn-sm">' . trans('admin.edit') . '</a>' . '</td>
</tr>';
        }
        return response($output);
    }

    public function deleteaccount($id)
    {
        $accounts = Account::find($id);
        $accounts->delete();
        session()->flash('delete',trans('admin.deletemsg'));
        return redirect()->route('accounts.index');
    }
    public function approved($id){
        $accounts=Account::findorfail($id);
        $accounts->status='approved';
        $accounts->save();

        return redirect()->back();
    }
    public function canceled($id){
        $accounts=Account::findorfail($id);
        $accounts->status='canceled';
        $accounts->save();

        return redirect()->back();
    }

    public function show_details($id){
        try{
        $accounts=Account::with('file')->findorfail($id);
        // return $accounts->file;
        return view('admin.accounts.show',compact('accounts'));
      }  catch(\Exception $e){

		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
    }
    public function Download($file){
        $this->downloadFile($file);
        session()->flash('Add', trans('file downloaded successfully'));
        return redirect()->back();

    }
public function deletefile($id){
    $accounts = File::find($id);
    $accounts->delete();
    session()->flash('delete',trans('admin.deletemsg'));
    return redirect()->back();
}
}
