<?php

namespace App\Modules\Token\Model;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    public  $table = 'token';

    protected $fillable = ['id','user_id','token','created_at','updated_at',];
}
