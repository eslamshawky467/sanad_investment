<?php
namespace App\Repository;


interface UserRepositoryInterface{
    public function index();
    public function create();
    public function store( $request);
    public function edituser($id);
    public function update($request);
    public function bulkDelete();
    public function search($request);
    public function deleteuser($id);
}



