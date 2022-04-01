<?php

namespace App\Modules\Booking\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use SoftDeletes;
    public  $table = 'booking';

    protected $fillable = ['id','practice_id','staff_id','slug','date','from','to','hourly_rate','parking', 'additional', 'status','deleted_at','created_at','updated_at',];
}
