<?php
namespace App\Repository;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Account_admin;
use App\Models\Account;
use App\Models\Property;
use App\Models\Investment;
use Barryvdh\DomPDF\Facade\Pdf;
class AdminRepository implements AdminRepositoryInterface{
    public function index(){
        $admins=User::sortable()->paginate(25);
        return view('admin.admins.index',compact('admins'));
    }
    public function create(){
        return view('admin.admins.create');
    }
    public function store($request)
    {
        try{
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        session()->flash('Add', trans('admin.addmsg'));
        return redirect()->route('admins.index');
        }
        catch(\Exception $e){
		
		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
    }

    public function editsearch($id)
    {
        $admins = User::findorfail($id);
        return view('admin.admins.edit', compact('admins'));

    }
    public function update($request)
    {
        
        $admins = User::findOrFail($request->id);
        if (!empty($request->password)){
            $validatedData = $request->validate([
                'name' => 'required|max:18|string',
                'email' => 'required|max:255|unique:users,email,'.$request->id,
                'password' => 'required|max:25|min:8|confirmed',
            ], [
                'email.email' => trans('admin.emailemsg'),
                'email.required' =>trans('admin.requiremail') ,
                'email.unique' => trans('admin.uniqueemail'),
                'password.required' => trans('admin.requirepass'),
                'name.required' => trans('admin.requirename'),
                'password.min' => trans('admin.passwordmin'),
                'password.max' => trans('admin.passwordmax'),
                'name.max' => trans('admin.namemax'),
                'password.confirmed' => trans('admin.passwordconfirm')
            ]);
            
            $admins->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } else {
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|max:255|unique:users,email,' . $request->id,
            ], [
                'email.email' => 'admin.emailmsg',
                'email.required' => 'admin.requiremail',
                'email.unique' => 'admin.uniqueemail',
                'name.required' => 'admin.rquirename',
                'name.max' => 'admin.namemax',
            ]);
            $admins->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }
        session()->flash('edit', trans('admin.editmsg'));
        return redirect()->route('admins.index');



    }
    




    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $admins = User::FindOrFail($recordId);
            $this->delete($admins);
        }
        session()->flash('delete',trans('admin.deletemsg'));
        return redirect()->back();
    }

    private function delete(User $user)
    {
        $user->delete();

    }

    public function search($request)
    {
        $output = "";
        $output .='<tr>
                                    <th>'.trans('admin.select').'</th>
                                    <th >'.trans('admin.name').'</th>
                                    <th >'.trans('admin.email').'</th>

                                    <th>'.trans('admin.edit').'</th>
                                    <th >'.trans('admin.delete').'</th>
                                </tr>';
        $admins = User::where('name', 'Like', '%' . $request->search . '%')->get();
        foreach ($admins as $admin) {
            $output .= '<tr id="sid '.$admin->id.'}}">
<td> ' . '<input type="checkbox" name="ids[ '.$admin->id.' ]" class="checkbox" value="'.$admin->id.'"/> ' . '</td>
<td>' . $admin->name . '</td>
<td>' . $admin->email . '</td>
 <td>
 ' . ' <a href="/editadmin/'.$admin->id . '" class="btn btn-success btn-sm">'.trans('admin.edit').'</a>' . '</td>
   <td>' . ' <a href="/deletesearch/' . $admin->id . '"  class="btn btn-danger btn-sm">'.trans('admin.delete').'</a>' . '</td>
</tr>';
        }
        return response($output);
    }

    public function deletesearch($id)
    {
        $admins = User::find($id);
        $admins->delete();
        session()->flash('delete',trans('admin.deletemsg'));
        return redirect()->route('admins.index');
    }
    public function profile(){
        $admins=User::findorfail(auth()->user()->id);
        return view('admin.profile.profile',compact('admins'));
    }
   public function overview(){
        $admins=Account_admin::where('id',0)->first();
        $money=$admins->balance;
        $admin=Account::where('id',0)->first();
         $onhold=$admin->on_hold_balance;
        $balanced=$admin->balance;
           $remain=Property::sum('remain_units');
             $total=Property::sum('total_units');
             $inv=Investment::where('status','active')->where('is_transfered','true')->where('type','invest')->sum('units');
        return view('admin.welcome',compact('money','onhold','balanced','remain','total','inv'));
    }
    public function createPDF(){
        try{
        $admins = Account_admin::where('id', 0)->first();
        $money = $admins->balance;
        $admin = Account::where('id', 0)->first();
        $onhold = $admin->on_hold_balance;
        $balanced = $admin->balance;
        $remain=Property::sum('remain_units');
             $total=Property::sum('total_units');
             $inv=Investment::where('status','active')->where('is_transfered','true')->where('type','invest')->sum('units');
        $data = [
            'money'=> $money,
            'onhold'=>$onhold,
            'balanced'=>$balanced,
            'remain'=>$remain,
            'total'=>$total,
            'inv'=>$inv,
        ];
        $pdf = PDF::loadView('admin.pdf_view', $data);
        return $pdf->download('pdf_file.pdf');
        }catch(\Exception $e){
		
		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
}
}
