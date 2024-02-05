<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class UserTransaction extends Model
{
    protected $guarded=[];
    use Sortable;
    public $sortable = ['amount', 'created_at'];
    public function sender()
    {
        return $this->morphTo();
    }
    public function reciever()
    {
        return $this->morphTo();
    }

}
