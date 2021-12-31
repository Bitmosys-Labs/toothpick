<?php

namespace App\Modules\Team\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use SoftDeletes;
    public  $table = 'team';

    protected $fillable = ['id','image','designation','name','description','link','deleted_at','created_at','updated_at',];
}
