<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account_admin extends Model
{
    protected $guarded = [];
    public function user(){
        return $this->belongsTo('App\Models\User', 'admin_id');
    }
}
