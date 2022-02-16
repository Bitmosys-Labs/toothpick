<?php

namespace App\Modules\Document\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use SoftDeletes;
    public  $table = 'document';

    protected $fillable = ['id','picture','status','deleted_at','created_at','updated_at',];
}
