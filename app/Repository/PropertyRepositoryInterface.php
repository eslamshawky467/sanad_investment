<?php
namespace App\Repository;

interface PropertyRepositoryInterface{
    public function index();
    public function create();
    public function store( $request);
    public function edit($id);
    public function update($request,$id);
    public function bulkDelete();
    public function search($request);
    public function deletesearch($id);
    public function showtosell();

}
