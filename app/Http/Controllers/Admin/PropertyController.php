<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyRequest;
use App\Http\Requests\MultiDeleteRequest;
use App\Repository\PropertyRepositoryInterface;

class PropertyController extends Controller
{

    protected $Property;

    public function __construct(PropertyRepositoryInterface $Property)
    {
        $this->Property = $Property;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->Property->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->Property->create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyRequest $request)
    {
        return $this->Property->store($request);
    }


    public function edit($id)
    {
        return $this->Property->edit($id);
    }


    public function updateProperity(Request $request,$id)
    {
        return $this->Property->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bulkDelete()
    {
        return $this->Property->bulkDelete();
    }

    public function DeleteMany(MultiDeleteRequest $request){
        // return $request;
        return $this->Property->MultiDelete($request);
    }

    public function search(Request $request){
        return $this->Property->search($request);
    }

    public function showtosell(){
        return $this->Property->showtosell();
    }
 public function deletesearch($id){
        return $this->Property->deletesearch($id);
    }

}
