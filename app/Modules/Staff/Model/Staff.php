<?php

namespace App\Modules\Staff\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use SoftDeletes;
    public  $table = 'staff';

    protected $fillable = ['id','type','deleted_at','created_at','updated_at',];
}
