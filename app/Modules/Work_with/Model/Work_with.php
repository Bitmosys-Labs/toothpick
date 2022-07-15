<?php

namespace App\Modules\Work_with\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Work_with extends Model
{
    use SoftDeletes;
    public  $table = 'work_with';

    protected $fillable = ['id','type','deleted_at','created_at','updated_at',];
}
