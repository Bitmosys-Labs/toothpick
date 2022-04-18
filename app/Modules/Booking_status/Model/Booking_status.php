<?php

namespace App\Modules\Booking_status\Model;
use App\Core_modules\User\Model\User;
use App\Modules\Booking\Model\Booking;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Booking_status extends Model
{
    use SoftDeletes;
    public  $table = 'booking_status';

    protected $fillable = ['id','user_id','date','canceled_by','reason_for_cancel','cancel_date','status','deleted_at','created_at','updated_at',];

    public function booking(){
        return $this->belongsTo(Booking::class, 'id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
