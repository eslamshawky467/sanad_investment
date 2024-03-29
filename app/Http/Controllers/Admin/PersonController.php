<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Person;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
	

class PersonController extends Controller
{
    public function index()
    {
        $person=Person::all();
        return view('admin.person.index',compact('person'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $properties=Property::all();
        return view('admin.person.create',compact('properties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
        Person::create([
            'name' => $request->name,
            'job'=>$request->job,
            'link'=>$request->link,
            'property_id'=>$request->property_id,
        ]);
        session()->flash('Add', trans('admin.addmsg'));
        return redirect()->route('person.index');
        }catch(\Exception $e){
		
		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
    }
        
    
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editperson($id)
    {
        
        $person=Person::findorfail($id);
        $properties=Property::all();
        return view('admin.person.edit',compact('properties','person'));
    }


    public function deleteperson($id)
    {
        $accounts = Person::find($id);
        $accounts->delete();
        session()->flash('delete',trans('admin.deletemsg'));
        return redirect()->route('person.index');
    }








    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
          try{
        $accounts = Person::findOrFail($request->id);
        $acc= $accounts->update([
            'job' =>$request->job,
            'link'=>$request->link,
            'name'=>$request->name,
            'property_id'=>$request->property_id,
        ]);
        session()->flash('edit', trans('admin.editmsg'));
        return redirect()->route('person.index');
          }catch(\Exception $e){
		
		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
