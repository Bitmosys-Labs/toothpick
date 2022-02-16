<?php

namespace App\Modules\Receipt\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use SoftDeletes;
    public  $table = 'receipt';

    protected $fillable = ['id','timesheet_id','slug','working_hours','rate','total','status','deleted_at','created_at','updated_at',];
}
