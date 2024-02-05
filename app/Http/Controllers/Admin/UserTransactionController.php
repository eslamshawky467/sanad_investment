<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Mail\SendUserDetails;
use App\Models\Account;
use App\Models\Client;
use App\Models\User;
use App\Models\UserTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Repository\UserTransactionRepositoryInterface;

class UserTransactionController extends Controller
{

    protected $transaction;

    public function __construct(UserTransactionRepositoryInterface $transaction)
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


    public function edittransaction($id)
    {
        return $this->transaction->edittransaction($id);
    }


    public function update(Request $request)
    {
        return  $this->transaction->update($request);
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
