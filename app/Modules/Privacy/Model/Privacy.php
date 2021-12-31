<?php

namespace App\Modules\Privacy\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Privacy extends Model
{
    use SoftDeletes;
    public  $table = 'privacy';

    protected $fillable = ['id','body','deleted_at','created_at','updated_at',];
}
