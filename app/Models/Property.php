<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;
    use Sortable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    public $sortable = ['id', 'title', 'description', 'total_price','unit_price','total_units','min_investement','last_investement_date','investement_percentage','penefits_from_investement','lang','lat','created_at','updated_at'];

    protected $table='properties';

    public function file(){

        return $this->morphMany(File::class,'Fileable');
    }


}
