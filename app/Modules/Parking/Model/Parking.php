<?php

namespace App\Modules\Parking\Model;
use App\Modules\Booking\Model\Booking;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    use SoftDeletes;
    public  $table = 'parking';

    protected $fillable = ['id','type','deleted_at','created_at','updated_at',];

    public function booking(){
        return $this->belongsTo(Booking::class, 'id', 'parking_id');
    }
}
