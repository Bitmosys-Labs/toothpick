<?php

namespace App\Core_modules\User\Model;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasRoles, HasApiTokens, SoftDeletes;
    public  $table = 'users';

    protected $fillable = ['id','name','username','control','last_visit','status','email','password','deleted_at','created_at','updated_at',];

    protected $hidden = [
      'remember_token'
    ];

    protected $casts = [
      'email_verified_at' => 'datetime'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

}
