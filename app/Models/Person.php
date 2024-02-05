<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Person extends Model
{
    use Sortable;
    protected  $table='people';
    public $sortable = ['id', 'created_at', 'updated_at'];
    protected $guarded = [];
    public function property(){
        return $this->belongsTo('App\Models\Property', 'property_id');
    }

}
