<?php

namespace App\Core_modules\User\Model;

use App\Modules\Campaign\Model\Campaign;
use App\Modules\Donation\Model\Donation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles;
    use SoftDeletes;
    public  $table = 'users';

    protected $fillable = ['id','name','username','control','last_visit','status','email','password','remember_token','deleted_at','created_at','updated_at',];

    public function donations(){
        return $this->hasMany(Donation::class, 'user_id', 'id');
    }

    public function campaigns(){
        return $this->hasMany(Campaign::class, 'user_id', 'id');
    }

}
