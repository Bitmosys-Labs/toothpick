<?php

namespace App\Modules\Term\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use SoftDeletes;
    public  $table = 'terms';

    protected $fillable = ['id','body','deleted_at','created_at','updated_at',];
}
