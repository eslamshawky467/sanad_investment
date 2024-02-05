<?php
namespace App\Repository;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Models\Country;
use App\Models\User;
use App\Mail\SendUserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
class UserRepository implements UserRepositoryInterface{
    public function index(){
        $users=Client::sortable()->paginate(25);
        return view('admin.users.index',compact('users'));
    }
    public function create(){
        $countries=Country::all();
        return view('admin.users.create',compact('countries'));
    }
    public function store($request)
    {
         try{
              DB::beginTransaction();
        Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status'=>$request->status,
            'phone_number'=>$request->phone_number,
            'identity_card'=>$request->identity_card,
            'country_id'=>$request->country_id,
        ]);
        Mail::to($request->email)->send(new SendUserDetails($request->email,$request->password));
        DB::commit();
        session()->flash('Add', trans('admin.addmsg'));
        return redirect()->route('users.index');
     }   	catch(\Exception $e){
		DB::rollback();
		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
    }

    public function edituser($id)
    {
        $users = Client::findorfail($id);
        $countries=Country::all();
        return view('admin.users.edit', compact('users','countries'));

    }
    public function update($request)
    {
        
        $users = Client::findOrFail($request->id);
        if (!empty($request->password)){
            $validatedData = $request->validate([
                'name' => 'required|max:255|string',
                'email' => 'required|max:255|unique:clients,email,'.$request->id,
                'password' => 'required|max:25|min:8|',
                'phone_number'=>'required',
                'identity_card'=>'required',
                'country_id'=>'required',
            ], [
                'email.email' => trans('admin.emailemsg'),
                'email.required' =>trans('admin.requiremail') ,
                'email.unique' => trans('admin.uniqueemail'),
                'password.required' => trans('admin.requirepass'),
                'name.required' => trans('admin.requirename'),
                'password.min' => trans('admin.passwordmin'),
                'password.max' => trans('admin.passwordmax'),
                'name.max' => trans('admin.namemax'),
            
                'phone_number.required'=> trans('admin.phone_number'),
                'country_id.required'=> trans('admin.country_id'),
                'identity_card.required'=> trans('admin.identity_card')
            ]);
            $users->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number'=>$request->phone_number,
                'status'=>$request->status,
                'identity_card'=>$request->identity_card,
                'country_id'=>$request->country_id,
            ]);
        } else {
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|max:255|unique:clients,email,' . $request->id,
                'phone_number'=>'required',
                'country_id.required'=> trans('admin.country_id'),
                'identity_card.required'=> trans('admin.identity_card')
            ], [
                'email.email' => 'admin.emailmsg',
                'email.required' => 'admin.requiremail',
                'email.unique' => 'admin.uniqueemail',
                'name.required' => 'admin.rquirename',
                'name.max' => 'admin.namemax',
                'phone_number.required'=>'admin.requirephone'
            ]);
            $users->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number'=>$request->phone_number,
                'status'=>$request->status,
                'country_id'=>$request->country_id,
                'identity_card'=>$request->identity_card,
            ]);
        }
          DB::commit();
        session()->flash('edit', trans('admin.editmsg'));
        return redirect()->route('users.index');
    
    }

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {
        $update = Client::where('id', $recordId)->update(['status' =>'inactive']);
        }
        session()->flash('delete',trans('admin.blockmsg'));
        return redirect()->back();
    }

    private function delete(Client $user)
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
                                     <th >'.trans('admin.phone_number').'</th>


                                     <th >'.trans('admin.identity_card').'</th>

                                    <th>'.trans('admin.edit').'</th>
                                    <th >'.trans('admin.delete').'</th>
                                </tr>';
        $users = Client::where('name', 'Like', '%' . $request->search . '%')->orwhere('phone_number', 'Like', '%' . $request->search . '%')->get();
        foreach ($users as $user) {
            $output .= '<tr id="sid '.$user->id.'}}">
<td> ' . '<input type="checkbox" name="ids[ '.$user->id.' ]" class="checkbox" value="'.$user->id.'"/> ' . '</td>
<td>' . $user->name . '</td>
<td>' . $user->email . '</td>
<td>' . $user->phone_number . '</td>
<td>' . $user->identity_card . '</td>

 <td>
 ' . ' <a href="/edituser/'.$user->id . '" class="btn btn-success btn-sm">'.trans('admin.edit').'</a>' . '</td>
   <td>' . ' <a href="/deleteuser/' . $user->id . '"  class="btn btn-danger btn-sm">'.trans('admin.delete').'</a>' . '</td>
</tr>';
        }
        return response($output);
    }

    public function deleteuser($id)
    {
        $update = Client::where('id', $id)->update(['status' =>'inactive']);
        session()->flash('delete',trans('admin.blockmsg'));
        return redirect()->route('users.index');
    }
}
