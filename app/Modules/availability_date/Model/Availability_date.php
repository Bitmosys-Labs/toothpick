<?php

namespace App\Modules\Availability_date\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Availability_date extends Model
{
    use SoftDeletes;
    public  $table = 'availability_date';

    protected $fillable = ['id','user_id','date','deleted_at','created_at','updated_at',];
}
