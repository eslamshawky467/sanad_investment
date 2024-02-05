<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function scopeSelection($query)
    {
        return $query->select('id','title_'.app()->getLocale() .' as title','content_'.app()->getLocale() .' as content','type');
    }


}
