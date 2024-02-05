<?php
namespace App\Repository;
interface PaymentRepositoryInterface{
    public function index();
    public function create();
    public function store( $request);

}
