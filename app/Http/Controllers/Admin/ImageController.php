<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners=Image::all();
        return view('admin.Image.index',compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Image.create');
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
        $banners = new Image();
        if($request->image != null)
        {
            $banner = $request->image;
            $imagename =time().'.'.$banner->getClientOriginalExtension();
            $banner->move('bannerFolder',$imagename);
            $banners->image = $imagename;
        }
        $banners->save();
        session()->flash('Add', trans('admin.addmsg'));
        return redirect()->back();
        }catch(\Exception $e){
		
		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
    }
    public function destroyimage($id)
    {
        $accounts = Image::find($id);
        $accounts->delete();
        session()->flash('delete',trans('admin.deletemsg'));
        return redirect()->route('image.index');
    }
}
