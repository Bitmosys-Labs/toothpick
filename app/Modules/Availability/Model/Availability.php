<?php

namespace App\Modules\Availability\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use SoftDeletes;
    public  $table = 'availability';

    protected $fillable = ['id','user_id','days_id','deleted_at','created_at','updated_at',];
}
