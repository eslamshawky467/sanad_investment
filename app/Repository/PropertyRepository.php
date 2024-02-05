<?php
namespace App\Repository;
use App\Models\Property;
use App\Http\Traits\ProperityTrait;
use App\Models\File;
use App\Repository\PropertyRepositoryInterface;
use Illuminate\Support\Facades\DB;

class PropertyRepository implements PropertyRepositoryInterface{

    use ProperityTrait;

    public function index(){
        $properties=Property::sortable()->paginate(25);
        return view('admin.properties.index',compact('properties'));
    }

    public function create(){
        return view('admin.properties.create');
    }

    public function store($request)
    {
         try{
              DB::beginTransaction();
        $unit_price=$request->total_price/$request->total_units;
        //  $image=$request->image[0];
        $pro=  Property::create([
            'title' => $request->title,
            'description' => $request->description,
            'total_price' => $request->total_price,
            'total_units' => $request->total_units,
            'min_investement' => $request->min_investement,
            'last_investement_date' => $request->last_investement_date,
            'penefits_from_investement' => $request->penefits_from_investement,
            'location' => $request->location,
            'Name_of_own_box'=>$request->Name_of_own_box,
            'unit_price' => $unit_price,
            'investement_percentage' => 0,
            'remain_units'=>$request->total_units,
            'category_1'=>$request->category_1,
            'category_2'=>$request->category_2,
            'category_3'=>$request->category_3,
            'units'=>$request->total_units,
            'status'=>'active',
        ]);
        //   return   $name= $this->saveImage($request->file('image')[0],'properities',$request->title);
        foreach($request->file('image') as $index=> $image)
        {
            $type= $this->FileType($image->getClientOriginalExtension());
            $name= $this->saveImage($image,$index,'properities',$request->title);
            // insert in image_table

            $images= new File();
            $images->file_name=$name;
            $images->Fileable_id= $pro->id;
            $images->Fileable_type = 'App\Models\Property';
            $images->type=$type;
            $images->save();
        }
        DB::commit();
        session()->flash('Add', trans('admin.addmsg'));
        return redirect()->route('properties.index');
     }   catch(\Exception $e){
		DB::rollback();
		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
    }

    public function edit($id)
    {
        $property = Property::findorfail($id);
        return view('admin.properties.edit', compact('property'));

    }
    public function update($request,$id)
    {
         try{
              DB::beginTransaction();
         $property = Property::with('file')->findOrFail($id);
        $unit_price=$request->total_price/$request->total_units;
        $property->update([
            'title' => $request->title,
            'description' => $request->description,
            'total_price' => $request->total_price,
            'total_units' => $request->total_units,
            'min_investement' => $request->min_investement,
            'last_investement_date' => $request->last_investement_date,
            'penefits_from_investement' => $request->penefits_from_investement,
            'location' => $request->location,
            'Name_of_own_box'=>$request->Name_of_own_box,
            'unit_price' => $unit_price,
            'remain_units'=>$request->total_units,
            'category_1'=>$request->category_1,
            'category_2'=>$request->category_2,
            'category_3'=>$request->category_3,
            'units'=>$request->total_units,
            'status'=>'active',
        ]);
            DB::commit();
        session()->flash('edit', trans('admin.editmsg'));
        return redirect()->route('properties.index');
        }
        catch(\Exception $e){
		DB::rollback();
		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
    }
    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $admins = Property::FindOrFail($recordId);
            $this->delete($admins);
        }
        session()->flash('delete',trans('admin.deletemsg'));
        return redirect()->back();
    }

    private function delete(Property $Property)
    {
        $Property->delete();

    }

    public function search($request)
    {
        $output = "";
        $output .='<tr>
                            <th>'.trans('admin.titleProperty').'</th>
                            <th>'.trans('admin.totalPriceProperty').'</th>
                            <th>'.trans('admin.unit_priceProperty').'</th>
                            <th>'.trans('admin.total_unitsProperty').'</th>
                            <th>'.trans('admin.min_investementProperty').'</th>
                            <th>'.trans('admin.last_investement_dateProperty').'</th>
                            <th>'.trans('admin.penefits_from_investementProperty').'</th>
                            <th>'.trans('admin.locationProperty').'</th>
                              <th>'.trans('admin.remain_units').'</th>
                               <th>'.trans('admin.status').'</th>


                            <th >'.trans('admin.delete').'</th>
                                    </tr>';
        $properties = Property::where('title', 'Like', '%' . $request->search . '%')->get();
        foreach ($properties as $property) {
            $output .= '<tr>

    <td>' . $property->title . '</td>
    <td>' . $property->total_price . '</td>
    <td>' . $property->unit_price . '</td>
    <td>' . $property->total_units . '</td>
    <td>' . $property->min_investement . '</td>
    <td>' . $property->last_investement_date . '</td>
    <td>' . $property->penefits_from_investement . '</td>
    <td>' . $property->location . '</td>
     <td>'. $property->remain_units .'</td>
     <td>'. $property->status .'</td>
       <td>' . ' <a href="/DeleteProperity/' . $property->id . '"  class="btn btn-danger btn-sm">'.trans('admin.delete').'</a>' . '</td>
    </tr>';
        }
        return response($output);
    }

    public function deletesearch($id)
    {
        $property = Property::find($id);
        $property->delete();
        session()->flash('delete',trans('admin.deletemsg'));
        return redirect()->route('properties.index');
    }
    public function showtosell(){
        $properties=Property::all();
        return view('admin.properties.show',compact('properties'));
    }
}


