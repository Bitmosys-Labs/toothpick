<?php

namespace App\Modules\Immunization\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Immunization extends Model
{
    use SoftDeletes;
    public  $table = 'immunization';

    protected $fillable = ['id','staff_id','requirement','deleted_at','created_at','updated_at',];
}
