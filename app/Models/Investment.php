<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Investment extends Model
{
    use Sortable;
    public $sortable = ['created_at', 'updated_at'];
    protected $guarded=[];
    public function sender()
    {
        return $this->morphTo();
    }
    public function reciever()
    {
        return $this->morphTo();
    }
    public function invest(){
        return $this->belongsTo('App\Models\Property', 'propperity_id');
    }
}
