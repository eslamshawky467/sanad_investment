<?php
namespace App\Repository;
interface AccountRepositoryInterface{
    public function index();
    public function create();
    public function store( $request);
    public function editaccount($id);
    public function update($request);
    public function bulkDelete();
    public function search($request);
    public function deleteaccount($id);
    public function approved($id);
    public function canceled($id);
    public function show_details($id);
    public function  Download($file);
}
