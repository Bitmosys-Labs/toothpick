<?php

namespace App\Modules\Compliance\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Compliance extends Model
{
    use SoftDeletes;
    public  $table = 'compliance';

    protected $fillable = ['id','type','staff_id','requirement','deleted_at','created_at','updated_at',];
}
