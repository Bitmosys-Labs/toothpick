<?php

namespace App\Core_modules\Role_user\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role_user extends Model
{
    use SoftDeletes;

    public  $table = 'model_has_role';

    protected $fillable = ['user_id','role_id','deleted_at'];
}
