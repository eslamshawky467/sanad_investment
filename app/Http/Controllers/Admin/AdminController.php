<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Repository\AdminRepository;
use App\Repository\AdminRepositoryInterface;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    protected $Admin;

    public function __construct(AdminRepositoryInterface $Admin)
    {
        $this->Admin = $Admin;
    }
    public function index()
    {
        return  $this->Admin->index();

    }


    public function create()
    {
        return $this->Admin->create();
    }


    public function store(UserRequest $request)
    {
        return $this->Admin->store($request);
    }


    public function editsearch($id)
    {
        return $this->Admin->editsearch($id);
    }


    public function update(Request $request)
    {
        return  $this->Admin->update($request);
    }


    public function bulkDelete(){

        return $this->Admin->bulkDelete();
    }
    public function search(Request $request){
        return $this->Admin->search($request);
    }
    public function deletesearch($id){

        return $this->Admin->deletesearch($id);
    }
    public function profile(){

        return $this->Admin->profile();
    }
       public function overview(){

        return $this->Admin->overview();
    }
       public function createPDF(){
        return $this->Admin->createPDF();
    }
}
