<?php

namespace App\Modules\About\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use SoftDeletes;
    public  $table = 'about';

    protected $fillable = ['id','body','deleted_at','created_at','updated_at',];
}
