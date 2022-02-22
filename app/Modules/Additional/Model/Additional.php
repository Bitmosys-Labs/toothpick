<?php

namespace App\Modules\Additional\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Additional extends Model
{
    use SoftDeletes;
    public  $table = 'additional';

    protected $fillable = ['id','receipt_id','amount','purpose','receipt','status','deleted_at','created_at','updated_at',];
}
