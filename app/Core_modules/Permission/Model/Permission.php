<?php

namespace App\Core_modules\Permission\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use SoftDeletes;
    public  $table = 'permissions';

    protected $fillable = ['id','name','display_name','deleted_at','created_at','updated_at',];
}
