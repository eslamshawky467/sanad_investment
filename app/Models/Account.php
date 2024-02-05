<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Kyslik\ColumnSortable\Sortable;

class Account extends Model
{
    use Sortable;
    public $sortable = ['id', 'created_at', 'updated_at'];
    protected $guarded = [];
    protected $table='accounts'; //صح كدا ا
    public function file(){

        return $this->morphMany(File::class,'Fileable');
    }
    public function sendMoney()
    {
        return $this->morphMany(UserTransaction::class, 'sender');
    }
    public function recievedMoney()
    {
        return $this->morphMany(UserTransaction::class, 'reciever');
    }
    public function send()
    {
        return $this->morphMany(Investment::class, 'sender');
    }
    public function recieved()
    {
        return $this->morphMany(Investment::class, 'reciever');
    }
    public function property(){
        return $this->belongsTo('App\Models\Property', 'user_id');
    }

    public function client(){
        return $this->belongsTo('App\Models\Client', 'user_id');
    }
    public function admin(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
