<?php
namespace App\Http\Controllers\Api;
use App\Http\Resources\ImageResource;
use App\Models\Category;
use App\Models\CatProp;
use App\Models\Image;
use App\Models\Investment;
use App\Models\Person;
use App\Models\Property;
use App\Models\PushNotification;
use App\Models\User;
use App\Models\UserTransaction;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\File;
use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Traits\ProperityTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AccountController extends Controller
{
    use ProperityTrait;


    public function payment(){
        $account = Account::where('user_type', 'App\Models\Client')->where('user_id', auth('client-api')->user()->id)->first();
        $id = $account->id;
        $payments=UserTransaction::where('sender_type', 'App\Models\Account_admin')->where('reciever_id',$id)->where('type','payment')->sum('amount');
        $all=$payment=UserTransaction::where('sender_type', 'App\Models\Account_admin')->where('reciever_id',$id)->where('type','payment')->get(['amount']);
        {
            return response()->json([
                'message' => 'True',
                'payment'=>$payments,
                'all_Benfits'=>$all,
                
            ], 201);
        }
    }
    
    
    
    public function benfits()

{
    $account = Account::where('user_type', 'App\Models\Client')->where('user_id', auth('client-api')->user()->id)->first();
    $id = $account->id;
    $inv=Investment::where('sender_id', $id)->where('type', 'invest')->where('is_transfered', 'true')->where('status', 'active')->sum('benfits');
    $all=UserTransaction::where('reciever_id', $id)->where('type', 'payment')->where('sender_type', 'App\Models\Account_admin')->sum('amount');
    if($inv-$all<=0){
        return response()->json([
            'message' => 'true',
             'benfit'=>0
        ], 201);
    }else{

        return response()->json([
            'message' => 'true',
            'benfit'=>$inv-$all,
        ], 201);
    }

}
    
    

    public function banner(){
    $banners=Image::all();
        {
            return response()->json([
                'message' => 'True',
                'Image'=>$banners
            ], 201);
        }
    }

    public function has_account()
    {
        $account = Account::where('user_type', 'App\Models\Client')->where('user_id', auth('client-api')->user()->id)->first();
        $status = $account->status;
        if (Account::where('user_type', 'App\Models\Client')->where('user_id', auth('client-api')->user()->id)->exists())
            if ($status == 'pending') {
                return response()->json([
                    'message' => 'pending',
                    'status' => 'يتم مراجعة طلبك حاليا',
                ], 201);
            } elseif ($status == 'approved') {
                return response()->json([
                    'message' => 'True',
                    'balance' => $account->balance,
                    'status' => 'تم تفعيل حسابك بنجاح',
                    'invested_cost' => $account->on_hold_balance,
                    'number_account'=>$account->id,
                ], 201);
            } else {
                return response()->json([
                    'message' => 'تم رفض تفعيل حسابك برجاء المحاولة مرة اخري ',
                ], 201);
            }
    }

    public function balance()
    {
        if (Account::where('user_type', 'App\Models\Client')->where('user_id', auth('client-api')->user()->id)->where('status', 'approved')->exists()) {
            $account = Account::where('user_id', auth('client-api')->user()->id)->where('user_type', 'App\Models\Client')->first();
            $amount = $account->balance;
            return response()->json([
                'message' => 'True',
                'balance' => $amount,
            ], 201);
        }
    }

    public function withdraw_balance()
    {
        if (Account::where('user_type', 'App\Models\Client')->where('user_id', auth('client-api')->user()->id)->where('status', 'approved')->exists()) {
            $account = Account::where('user_id', auth('client-api')->user()->id)->where('user_type', 'App\Models\Client')->where('status', 'approved')->first();
            $id = $account->id;
            $trans = UserTransaction::where('reciever_id', $id)->where('type', 'withdraw');
            $withdraw = $trans->sum('amount');
            return response()->json([
                'message' => 'True',
                'withdraw' => $withdraw,
            ], 201);
        }
    }

    public function all_transaction()
    {
        if (Account::where('user_type', 'App\Models\Client')->where('user_id', auth('client-api')->user()->id)->where('status', 'approved')->exists()) {
            $account = Account::where('user_id', auth('client-api')->user()->id)->where('user_type', 'App\Models\Client')->where('status', 'approved')->first();
            $id = $account->id;
            $trans = UserTransaction::where('reciever_id', $id)->orwhere('sender_id', $id)->get(['amount', 'type', 'created_at']);
            return response()->json([
                'message' => 'True',
                'trans' => $trans,
            ], 201
            );
        }
    }


    public function properties()
    {
        $account = Account::where('user_id', auth('client-api')->user()->id)->where('user_type', 'App\Models\Client')->where('status', 'approved')->first();
        $id = $account->id;
        $investment = Investment::where('sender_id', $id)->where('type', 'invest')->get(['status', 'propperity_id']);
        return response()->json([
            'message' => 'True',
            'props' => $investment,
        ], 201);
    }

    public function units(Request $request)
    {
        $account = Account::where('user_id', auth('client-api')->user()->id)->where('user_type', 'App\Models\Client')->where('status', 'approved')->first();
        $id = $account->id;
        $units = Investment::where('sender_id', $id)->where('type', 'invest')->where('propperity_id', $request->propperity_id)->where('is_transfered', 'true')->where('status', 'active')->sum('units');
        $cost = Investment::where('sender_id', $id)->where('type', 'invest')->where('propperity_id', $request->propperity_id)->where('is_transfered', 'true')->where('status', 'active')->sum('cost');
       if(Investment::where('sender_id', $id)->where('type', 'invest')->where('propperity_id', $request->propperity_id)->where('is_transfered', 'false')->where('status', 'onhold')->exists()){
     $units = Investment::where('sender_id', $id)->where('type', 'invest')->where('propperity_id', $request->propperity_id)->where('is_transfered', 'false')->where('status', 'onhold')->sum('units');
        $cost = Investment::where('sender_id', $id)->where('type', 'invest')->where('propperity_id', $request->propperity_id)->where('is_transfered', 'false')->where('status', 'onhold')->sum('cost');
        $details = Property::with(['file' =>
            function ($query) {
                $query->properityFile();
            }])->where('id', $request->propperity_id)->get();
        $unit = $units;
        $costed = $cost;
        $status = "تحت الانتظار ";
        return response()->json([
            'message' => 'True',
            'data'=>$details,
            'units' => $units,
            'cost of your investment' => $cost,
            'status' => $status,

        ], 201);
       }
       else{
       $details = Property::with(['file' =>
            function ($query) {
                $query->properityFile();
            }])->where('id', $request->propperity_id)->get();
        $unit = $units;
        $costed = $cost;
        $status = "نشط الان ";
        return response()->json([
            'message' => 'True',
            'data'=>$details,
            'units' => $units,
            'cost of your investment' => $cost,
            'status' => $status,

        ], 201);
}
    }
    public function make_account(Request $request){
      
       
        $validator = Validator::make($request->all(), [
            'file'=>'required',
            'balance'=>'numeric|min:0',
        ],[
            'file.required' =>trans('admin.requirefile'),
            'balance.numeric' => trans('admin.numeric'),
            'balance.min' =>trans('admin.balancemin'),
        ]);
        if ($validator->fails()) {
            return response()->json(['message'=>$validator->errors()->first(),'status'=> 422]);
        }
         try{
              DB::beginTransaction();
        if (Account::where('user_id', auth('client-api')->user()->id)->where('user_type', 'App\Models\Client')->where('status','!=','canceled')->exists()) {
            return response()->json([
                'message' =>trans('admin.exist'),
            ], 401);
        }
        else{
            $acc= Account::create([
                'balance'=>0,
                'status'=>'pending',
                'user_id'=>auth('client-api')->user()->id,
                'user_type'=>'App\Models\Client',
            ]);
            foreach($request->file('file') as $index=> $file)
            {
                $type= $this->FileType($file->getClientOriginalExtension());
                $name= $this->saveImage($file,$index,'Accounts',auth('client-api')->user()->id);
                // insert in image_table
                $files= new File();   //files
                $files->file_name=$name;
                $files->Fileable_id= $acc->id;
                $files->Fileable_type ='App\Models\Account';
                $files->type=$type;
                $files->save();
            }
              DB::commit();
            return response()->json([
                'message' => trans('admin.success1'),
            ], 201);
        }
        }catch(\Exception $e){
		DB::rollback();
		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
            
        }
    public function make_transaction(Request $request){
       
        $validator = Validator::make($request->all(), [
            'amount'=> 'required',
        ],[
            'amount.required' =>trans('admin.requireamount'),
        ]);
        if ($validator->fails()) {
            return response()->json(['message'=>$validator->errors()->first(),'status'=> 422]);
        }
         try{
              DB::beginTransaction();
         if (Account::where('user_id',auth('client-api')->user()->id)->where('status','approved')->exists()){
        $account=Account::where('user_id',auth('client-api')->user()->id)->where('user_type','App\Models\Client')->first();
        $status = $account->status;
        $amount = $account->balance;
        $id = $account->id;
        $system = Account::where('id', 0)->first();
        $sys = $system->balance;
        if( $status=="approved") {
            $transaction = UserTransaction::create(array_merge(
                $validator->validated(),
                ['sender_id' => $id],
                ['reciever_id' => null],
                ['reciever_type' => null],
                ['sender_type' =>'App\Models\Account' ],
                ['type' =>'balance']
            ));
            $total=$request->amount+$amount;
            $syst=$request->amount+$sys;
            $updated=Account::where('id', $id)
                ->update(['balance' => $total]);
            $update_system=Account::where('id', 0)
                ->update(['balance' => $syst]);
                DB::commit();
            return response()->json([
                'message' => trans('admin.sucess2')
            ], 201);}
        else{
            return response()->json(['error' => trans('admin.approvement')], 401);
    }}else{
        return response()->json(['message' => trans('admin.foundaccount')], 401);
    }
    }
    catch(\Exception $e){
		DB::rollback();
		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
}
    public function make_invest(Request $request)
    {
        
            $validator = Validator::make($request->all(), [
                'propperity_id' => 'required',
                'units' => 'required'
            ], [
                'propperity_id' =>trans('admin.requireproperity'),
                'units' => trans('admin.requireunit'),
            ]);

            if ($validator->fails()) {
                return response()->json(['message'=>$validator->errors()->first(),'status'=> 422]);
            }
             try{
              DB::beginTransaction();
            if (Account::where('user_id',auth('client-api')->user()->id)->where('status','approved')->exists()){
            $account = Account::where('user_id', auth('client-api')->user()->id)->where('user_type','App\Models\Client')->first();
            $status = $account->status;
            $id = $account->id;
            $amount = $account->balance;
            $on_hold_balance=$account->on_hold_balance;
            $properties = Property::where('id', $request->propperity_id)->first();
            $cost = $properties->unit_price;
            $min = $properties->min_investement;
            $max = $properties->remain_units;
            $benfits=$properties->penefits_from_investement;
            $created_at= $properties->last_investement_date;
            $date=Carbon::now();
            $dat= $date->lte($created_at);
            $accadmin = Account::where('id', 0)->first();
            $balance=$accadmin->balance;
            $on_hold=$accadmin->on_hold_balance;
             $per=$properties->investement_percentage;
            $un=$properties->units;
            if ($status == "approved") {
                if ($dat == true) {
                    if ($max >= $request->units && $request->units >= $min) {
                        if ($amount >= $cost * $request->units) {
                            if (Investment::where('propperity_id', $request->propperity_id)->where('sender_id', $id)->where('type', 'invest')->where('status', 'active')->exists()) {

                                $prop = Investment::where('propperity_id', $request->propperity_id)->where('sender_id', $id)->where('type', 'invest')->where('status', 'active')->first();
                                $ben=$prop->benfits;
                                $units = $prop->units;
                                $cosun = $prop->cost;
                                $total = $amount - ($cost * $request->units);
                                $sysi = $balance - ($cost * $request->units);
                                $updated = Account::where('id', $id)
                                    ->update(['balance' => $total
                                    ]);
                                $upd = Account::where('id', 0)
                                    ->update(['balance' => $sysi
                                    ]);
                                $updateunits = Property::where('id', $request->propperity_id)
                                    ->update(['remain_units' => $max - $request->units,
                                     'investement_percentage'=>$per+$units/$un*100
                                    ]);

                                $system = Account::where('user_id', $request->propperity_id)->where('user_type', 'App\Models\Property')->first();
                                $prop = $system->balance;
                                $T = $prop + $cost * $request->units;
                                $updatet = Account::where('user_id', $request->propperity_id)->where('user_type', 'App\Models\Property')->update(['balance' => $T]);
                                $updated_on = Account::where('id', $id)
                                    ->update(['on_hold_balance' => $on_hold_balance + $cost * $request->units
                                    ]);
                                $update = Account::where('id', 0)
                                    ->update(['on_hold_balance' => $on_hold + $cost * $request->units]);

                                $update_uni = Investment::where('propperity_id', $request->propperity_id)->where('sender_id', $id)->where('type', 'invest')
                                    ->update(['units' => $units + $request->units,
                                        'cost' => $cosun + $request->units * $cost,
                                          'benfits'=>$ben+$request->units*$benfits,
                                          
                                    ]);
                                    if ($max - $request->units == 0) {
                                $updateunits = Property::where('id', $request->propperity_id)
                                    ->update(['status' => "invested"
                                    ]);
                            }
                                DB::commit();
                                return response()->json([
                                    'message' => trans('admin.success3')
                                ], 201);
                            } elseif (Investment::where('propperity_id', $request->propperity_id)->where('sender_id', $id)->where('type', 'invest')->where('status', 'onhold')->exists()) {
                                return response()->json([
                                    'message' => trans('admin.wait_to'),
                                ], 401);
                            } else {
                                $investment = Investment::create(array_merge(
                                    $validator->validated(),
                                    ['sender_id' => $id],
                                    ['reciever_id' => 0],
                                    ['reciever_type' => 'App\Models\Account'],
                                    ['sender_type' => 'App\Models\Account'],
                                    ['status' => 'onhold'],
                                    ['cost' => $cost * $request->units],
                                    ['is_transfered' => 'false'],
                                    ['type' => 'invest']
                                ));
                                $total = $amount - ($cost * $request->units);
                                $sysi = $balance - ($cost * $request->units);
                                $updated = Account::where('id', $id)
                                    ->update(['balance' => $total
                                    ]);
                                $upd = Account::where('id', 0)
                                    ->update(['balance' => $sysi
                                    ]);

                                $updated_on = Account::where('id', $id)
                                    ->update(['on_hold_balance' => $on_hold_balance + $cost * $request->units
                                    ]);

                                $update = Account::where('id', 0)
                                    ->update(['on_hold_balance' => $on_hold + $cost * $request->units]);
                                DB::commit();
                                return response()->json([
                                    'message' => trans('admin.success3')
                                ], 201);

                            }
                        } else {
                            return response()->json([
                                'message' => trans('admin.balance')
                            ], 401);
                        }
                    } else {
                        return response()->json([
                            'message' => trans('admin.unauthorized')
                        ], 401);
                    }
                } else {
                    return response()->json([
                        'message' => trans('admin.thetime')
                    ], 401);
                }
            }else {
                return response()->json(['message' => trans('admin.approvement')], 401);
            }
                  
              }
              else{
        return response()->json(['message'=>trans('admin.foundaccount')], 401);
    }}
        catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }

    }

    public function withdraw(Request $request){
        
        $validator = Validator::make($request->all(), [
            'amount'=> 'required',
        ],[
            'amount.required' =>'requireamount',
        ]);
        if ($validator->fails()) {
            return response()->json(['message'=>$validator->errors()->first(),'status'=> 422]);
        }
         try{
              DB::beginTransaction();
         if (Account::where('user_id',auth('client-api')->user()->id)->where('status','approved')->exists()){
        $account=Account::where('user_id',auth('client-api')->user()->id)->where('user_type','App\Models\Client')->first();
        $status = $account->status;
        $amount = $account->balance;
        $id = $account->id;
        $system=Account::where('id', 0)->first();
        $sys=$system->balance;
        if( $status=="approved"){
            $transaction = UserTransaction::create(array_merge(
                $validator->validated(),
                ['sender_id' => null],
                ['reciever_id' => $id],
                ['reciever_type' => 'App\Models\Account'],
                ['sender_type' =>null ],
                ['type' =>'withdraw']
            ));
            $total=$amount-$request->amount;
            $sya=$sys-$request->amount;
            $updated=Account::where('id', $id)
                ->update(['balance' => $total]);
            $update_system=Account::where('id', 0)
                ->update(['balance' => $sya]);
                 DB::commit();
            return response()->json([
                'message' => trans('admin.success5')
            ], 201);}
        else{
            return response()->json(['error' => trans('admin.approvement')], 401);
        	}}else{
        return response()->json(['message' => trans('admin.foundaccount')], 401);
    }}   
    catch(\Exception $e){
		DB::rollback();
		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
}
    public function refund(Request $request)
    {
       
            $validator = Validator::make($request->all(), [
                'propperity_id' => 'required',
                'units' => 'required'
            ], [
                'propperity_id' => trans('admin.requireproperity'),
                'units' => trans('admin.requireunit'),
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 422);
            }
             try{
              DB::beginTransaction();
            $account = Account::where('user_id', auth('client-api')->user()->id)->where('user_type', 'App\Models\Client')->first();
            $status = $account->status;
            $id = $account->id;
            $amount = $account->balance;
            $on_hold= $account->on_hold_balance;
            $properties = Property::where('id', $request->propperity_id)->first();
            $cost = $properties->unit_price;
            $max = $properties->remain_units;
            $min=$properties->min_investement;
            $investments = Investment::where('propperity_id', $request->propperity_id)->where('sender_id',$id)->where('type','invest')->first();
            $in = $investments->status;
            $inv = $investments->units;
            $co=$investments->cost;
            $b = Account::where('id', 0)->first();
            $balance=$b->balance;
            $on=$b->on_hold_balance;
            if ($status == "approved") {
                if ($in == "onhold") {
                    if ($inv >= $request->units) {
                        $refund = UserTransaction::create(array_merge(
                            ['amount' => $cost * $request->units],
                            ['sender_id' => $id],
                            ['reciever_id' => 0],
                            ['reciever_type' => 'App\Models\Account'],
                            ['sender_type' => 'App\Models\Account'],
                            ['type' => 'refund'],
                        ));
                        $all = $cost * $request->units + $amount;
                        $total = $balance + ($cost * $request->units);

                        $updated = Account::where('id', $id)
                            ->update(['balance' => $all
                            ]);
                        $updated_on = Account::where('id', $id)
                            ->update(['on_hold_balance' =>$on_hold-($cost * $request->units)
                            ]);
                        $update = Account::where('id', 0)
                            ->update(['balance' => $total,
                                'on_hold_balance'=>$on-($cost * $request->units)
                            ]);
                        if($inv-$request->units==0){

                        $update_inv= Investment::where('propperity_id', $request->propperity_id)->where('sender_id',$id)->where('type','invest')->update(['status' => 'rejected',
                            'units'=>$inv-$request->units,
                            'cost'=>$co-($cost*$request->units),
                            'is_transfered'=>'true',
                            'type'=>'refunded',
                        ]);
                        }
                        else{
                         $update_inv= Investment::where('propperity_id', $request->propperity_id)->where('sender_id',$id)->where('type','invest')->update(['status' => 'onhold',
                            'units'=>$inv-$request->units,
                            'cost'=>$co-($cost*$request->units),
                        ]);
                        }
                        DB::commit();
                        return response()->json([
                            'message' =>trans ('admin.success6')
                        ], 201);
                    } else {
                        return response()->json([
                            'message' => trans('admin.unauthorized'),
                        ], 401);
                    }
                }
                else {
                    return response()->json([
                        'message' => trans('admin.refund'),
                    ], 401);
                }
            }
            else {
                return response()->json(['error' =>trans( 'admin.approvement')], 401);
            }
        }
        catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy_account()
    {
         $update = Client::where('id', auth('client-api')->user()->id)->update(['status' =>'inactive']);
            return response()->json(['message' => trans('admin.delteacc')], 201);
        }
    public function request_sell(Request $request){
       
            $validator = Validator::make($request->all(), [
                'propperity_id' => 'required',
                'units' => 'required'
            ], [
                'propperity_id' =>trans('admin.requireproperity'),
                'units' => trans('admin.requireunit'),
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 422);
            }
             try{
              DB::beginTransaction();
            $account = Account::where('user_id', auth('client-api')->user()->id)->where('user_type', 'App\Models\Client')->first();
            $status = $account->status;
            $id = $account->id;
            $properties = Property::where('id', $request->propperity_id)->first();
            $cost = $properties->unit_price;
            $max = $properties->remain_units;
            $investments = Investment::where('propperity_id', $request->propperity_id)->where('sender_id',$id)->where('type','invest')->where('status','active')->first();
            $inv = $investments->units;
            $in=$investments->status;
            $created_at= $investments->created_at;
            $date=Carbon::now();
            $result= $date->gte($created_at->addMonth(6));
            if ($status == "approved") {
                if ($in == "active") {
                    if($result==true){
                        if ($inv >= $request->units) {
                            $sell=Investment::create(array_merge(
                                ['cost' => $cost * $request->units],
                                ['sender_id' => $id],
                                ['reciever_id' => 0],
                                ['reciever_type' => 'App\Models\Account'],
                                ['sender_type' => 'App\Models\Account'],
                                ['type' => 'sell'],
                                ['is_transfered'=>'false'],
                                ['status'=>'onhold'],
                                ['units'=>$request->units],
                                ['propperity_id'=>$request->propperity_id],
                            ));
                            DB::commit();
                            return response()->json([
                                'message' =>trans ('admin.success6')
                            ], 201);
                        } else {
                            return response()->json([
                                'message' => trans('admin.unauthorized'),
                            ], 401);
                        }
                    }else{
                        return response()->json([
                            'message' => trans('admin.aftermonth'),
                        ], 401);
                    }
                }
                else {
                    return response()->json([
                        'message' => trans('admin.refund'),
                    ], 401);
                }
            }
            else {
                return response()->json(['message' =>trans( 'admin.approvement')], 401);
            }
        }
        catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function getallnotification(){
$notify=PushNotification::all();
return response()->json([
                'message'=>'Success',
                'notfications'=>$notify,
            ],200);
    
}
}
