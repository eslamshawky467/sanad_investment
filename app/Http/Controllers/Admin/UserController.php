<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\ClientRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Repository\AdminRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $User;

    public function __construct(UserRepositoryInterface $User)
    {
        $this->User = $User;
    }
    public function index()
    {
        return  $this->User->index();

    }


    public function create()
    {
        return $this->User->create();
    }


    public function store(ClientRequest $request)
    {
        return $this->User->store($request);
    }


    public function edituser($id)
    {
        return $this->User->edituser($id);
    }


    public function update(Request $request)
    {
        return  $this->User->update($request);
    }

    public function bulkDelete(){

        return $this->User->bulkDelete();
    }
    public function search(Request $request){
        return $this->User->search($request);
    }
    public function deleteuser($id){

        return $this->User->deleteuser($id);
    }

}
