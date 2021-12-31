<?php

namespace App\Modules\Message\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use SoftDeletes;
    public  $table = 'message';

    protected $fillable = ['id','full_name','subject','email','message','status','deleted_at','created_at','updated_at',];
}
