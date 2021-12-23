<?php

namespace App\Core_modules\Permission_role\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission_role extends Model
{
    public  $table = 'role_has_permissions';

    protected $fillable = ['permission_id','role_id'];
}
