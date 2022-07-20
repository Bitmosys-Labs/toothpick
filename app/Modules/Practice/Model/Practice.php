<?php

namespace App\Modules\Practice\Model;
use App\Core_modules\User\Model\User;
use App\Modules\Booking\Model\Booking;
use App\Modules\Rating\Model\Rating;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    use SoftDeletes;
    public  $table = 'practice';

    protected $fillable = ['id','user_id','owners_name','payment','postcode','address', 'pay_rate', 'parking', 'emergency_contact','gdc_no','contact', 'latitude', 'longitude', 'deleted_at','created_at','updated_at',];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function bookings(){
        return $this->hasMany(Booking::class, 'practice_id', 'id');
    }

    public function ratings(){
        return $this->hasMany(Rating::class, 'practice_id', 'id');
    }

}
