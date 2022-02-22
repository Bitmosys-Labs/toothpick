<?php

namespace App\Modules\Identity\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Identity extends Model
{
    use SoftDeletes;
    public  $table = 'identity';

    protected $fillable = ['id','type','staff_id','requirement','deleted_at','created_at','updated_at',];
}
