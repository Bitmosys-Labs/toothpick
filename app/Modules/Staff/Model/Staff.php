<?php

namespace App\Modules\Staff\Model;
use App\Modules\Booking\Model\Booking;
use App\Modules\Dcp\Model\Dcp;
use App\Modules\Experience\Model\Experience;
use App\Modules\Immunization\Model\Immunization;
use App\Modules\Rate\Model\Rate;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use SoftDeletes;
    public  $table = 'staff';

    protected $fillable = ['id','type','deleted_at','created_at','updated_at',];

    public function dcps()
    {
        return  $this->belongsToMany(Dcp::class, 'staff_dcp', 'staff_id', 'user_id');
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class, 'staff_id', 'id');
    }

    public function immunizations(){
        return $this->hasMany(Immunization::class, 'staff_id', 'id');
    }

    public function bookings(){
        return $this->hasMany(Booking::class, 'staff_id', 'id');
    }

    public function rates(){
        return $this->hasMany(Rate::class, 'staff_id', 'id');
    }

}
