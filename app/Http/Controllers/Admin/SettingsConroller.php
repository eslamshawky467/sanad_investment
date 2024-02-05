<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingsRequest;
use App\Http\Requests\MultiDeleteRequest;
use App\Repository\SettingsRepositoryInterface;
use App\Http\Requests\MultiDeleteSettingsRequest;

/**
 * SettingsConroller
 */
class SettingsConroller extends Controller
{

    protected $Settings;

    public function __construct(SettingsRepositoryInterface $Settings)
    {
        $this->Settings=$Settings;
    }

    public function index()
    {
      return $this->Settings->index(); 
    }

   
    public function create()
    {
       return $this->Settings->create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingsRequest $request)
    {
        return $this->Settings->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
    public function edit($id)
    {
        return $this->Settings->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingsRequest $request,$id)
    {
        // return $request;
        return $this->Settings->update($request,$id);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function DeleteSetting($id)
    {
        // return $id;
        return $this->Settings->deletesearch($id);
    }

    public function DeleteMany(MultiDeleteSettingsRequest $request){
        // return $request;
        return $this->Settings->MultiDelete($request);
    }

    public function SearchSetting(Request $request){
        return $this->Settings->search($request);
    }
    public function editSetting($type){
        return $this->Settings->editSetting($type);
    }
    public function updateSetting(SettingsRequest $request,$type){
        return $this->Settings->updateSetting($request,$type);
    }
}
