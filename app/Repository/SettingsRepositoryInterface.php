<?php
namespace App\Repository;
interface SettingsRepositoryInterface{

     public function index();
    public function create();
    public function edit($id);
    public function store($request);
    public function update($request,$id);
    public function MultiDelete($request);
    public function search($request);
    public function deletesearch($id);
    public function editSetting($type);
    public function updateSetting($request,$type);

}