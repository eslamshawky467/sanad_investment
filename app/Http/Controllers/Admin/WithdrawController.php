<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\UserTransactionRepositoryInterface;
use App\Repository\WithdrawRepositoryInterface;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    protected $transaction;

    public function __construct(WithdrawRepositoryInterface $transaction)
    {
        $this->transaction = $transaction;
    }
    public function index()
    {
        return  $this->transaction->index();

    }


    public function create()
    {
        return $this->transaction->create();
    }


    public function store(Request $request)
    {
        return $this->transaction->store($request);
    }

    public function bulkDelete(){
        return $this->transaction->bulkDelete();
    }
    public function search(Request $request){
        return $this->transaction->search($request);
    }
    public function deletetransaction($id){

        return $this->transaction->deletetransaction($id);
    }
}
