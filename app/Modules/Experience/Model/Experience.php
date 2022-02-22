<?php

namespace App\Modules\Experience\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use SoftDeletes;
    public  $table = 'experience';

    protected $fillable = ['id','staff_id','type','deleted_at','created_at','updated_at',];
}
