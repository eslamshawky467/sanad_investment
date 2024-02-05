<?php
namespace App\Repository;


interface WithdrawRepositoryInterface{
    public function index();
    public function create();
    public function store( $request);
    public function bulkDelete();
    public function search($request);
    public function deletetransaction($id);
}
