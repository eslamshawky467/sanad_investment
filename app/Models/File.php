<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
class File extends Model
{
    use HasFactory;
    protected $table='files';
    protected $guarded = [];

    public function scopeProperityFile(Builder $query){
        return $query->select('id','Fileable_id','file_name','type');
    }

    public function Fileable(){

        return $this->morphTo();

    }
    public function url()
    {
        return asset('storage/'.$this->file_name);
    }

    public function getFileNameAttribute($value)
    {
        return asset('storage/'.$value);
    }
}
