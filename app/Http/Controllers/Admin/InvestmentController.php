<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\AdminRepositoryInterface;
use App\Repository\InvestmentRepositoryInterface;
use Illuminate\Http\Request;

class InvestmentController extends Controller
{
    protected $invest;

    public function __construct(InvestmentRepositoryInterface $invest)
    {
        $this->invest = $invest;
    }
    public function index(){
        return $this->invest->index();
    }

    public function editinvestment($id){


    }

    public function update($request){


    }

    public function bulkDelete(){

    }

    public function search(Request $request){
        return $this->invest->search($request);
    }

    public function deleteinvestment($id){

    }

    public function approved($id){

    }

    public function canceled($id){

    }

    public function show_investments($id){
        return $this->invest->show_investments($id);
    }
}
