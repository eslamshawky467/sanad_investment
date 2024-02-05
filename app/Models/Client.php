<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Passport\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Client  extends Authenticatable  implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    use Sortable;
    protected $fillable = [
        'name', 'email', 'password','status','phone_number','identity_card','country_id'
    ];
    public $sortable = ['id', 'name', 'created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getJWTIdentifier() {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }
    public function sendMoney()
    {
        return $this->morphMany(Account::class, 'sender');
    }
    public function recievedMoney()
    {
        return $this->morphMany(Account::class, 'reciever');
    }
    public function Country(){
        return $this->belongsTo('App\Models\Country', 'country_id');
    }
}
