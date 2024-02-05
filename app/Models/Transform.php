<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transform extends Model
{
    protected $guarded=[];
    public function sent(){
        return $this->belongsTo('App\Models\Account', 'sender_id');
    }
    public function recieved(){
        return $this->belongsTo('App\Models\Account_admin', 'reciever_id');
    }
}
