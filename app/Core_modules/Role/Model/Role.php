<?php

namespace App\Core_modules\Role\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    public  $table = 'roles';

    protected $fillable = ['id','name','deleted_at','created_at','updated_at',];
}
