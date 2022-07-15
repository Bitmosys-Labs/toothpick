<?php

namespace App\Modules\Logo\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    use SoftDeletes;
    public  $table = 'logo';

    protected $fillable = ['id','type','deleted_at','created_at','updated_at',];
}
