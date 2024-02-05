<?php
namespace App\Http\Controllers\Api;
use App\Http\Resources\AllProperitiesResource;
use App\Models\CatProp;
use App\Models\Person;
use App\Models\Investment;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PropertyResource;
use Illuminate\Support\Facades\DB;

class ProperityController extends Controller
{
    public function index()
    {
        $properities = Property::
        with(['file' =>
            function ($query) {
                $query->properityFile();
            }])->paginate(6);
        if ($properities->isEmpty()) {
            return response()->json([
                'status' => true,
                'errNum' => "S000",
                'message' => 'لا توجد عقارات حاليا '
            ]);
        }
        // return $properities;
        return $category = new AllProperitiesResource($properities);

    }

   public function ProperityDetails(Request $req){
        // return $req->id;
        $properity =Property::find($req->id);
        $person=Person::where('property_id',$req->id)->get();
                if (!$properity) {
            return response()->json([
                'status' => true,
                'errNum' => "S000",
                'message'=>'لا يوجد هذا العقار  '
            ]);
        }
        if($sanad=Investment::where('propperity_id',$req->id)->where('sender_id',0)->where('sender_type','App\Models\Account_admin')->exists()){
        $sanad=Investment::where('propperity_id',$req->id)->where('sender_id',0)->where('sender_type','App\Models\Account_admin')->sum('cost');
         $category=  new PropertyResource($properity);
        return response()->json([
            'status' => true,
            'errNum' => "S000",
             'message'=>'Success',
            'data'=>$category,
            'costed'=>$sanad,
            'person'=>$person,
        ]);
        }
        else
        $category=  new PropertyResource($properity);
        return response()->json([
            'status' => true,
            'errNum' => "S000",
             'message'=>'Success',
            'data'=>$category,
            'costed'=>"0",
            'person'=>$person,
               ]);
    }
}
