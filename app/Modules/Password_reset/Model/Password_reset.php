<?php

namespace App\Modules\Password_reset\Model;


use Illuminate\Database\Eloquent\Model;

class Password_reset extends Model
{
    public  $table = 'password_resets';

    protected $fillable = ['email','token','created_at',];
}
