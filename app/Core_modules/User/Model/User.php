<?php

namespace App\Core_modules\User\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles, HasApiTokens, SoftDeletes;
    public  $table = 'users';

    protected $fillable = ['id','name','username','control','last_visit','status','email','password','remember_token','deleted_at','created_at','updated_at',];

}
