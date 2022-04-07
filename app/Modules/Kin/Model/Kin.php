<?php

namespace App\Modules\Kin\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Kin extends Model
{
    use SoftDeletes;
    public  $table = 'kin';

    protected $fillable = ['id','name','contact','home_contact','relation','address','deleted_at','created_at','updated_at',];
}
