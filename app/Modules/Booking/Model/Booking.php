<?php

namespace App\Modules\Booking\Model;
use App\Modules\Booking_status\Model\Booking_status;
use App\Modules\Practice\Model\Practice;
use App\Modules\Staff\Model\Staff;
use App\Modules\Timesheet\Model\Timesheet;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use SoftDeletes;
    public  $table = 'booking';

    protected $fillable = ['id','practice_id','staff_id','slug','date','from','to','hourly_rate','parking','additional', 'work_with','status','deleted_at','created_at','updated_at',];

    public function practice(){
        return $this->belongsTo(Practice::class, 'practice_id', 'id');
    }

    public function staff(){
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }

    public function timesheet(){
        return $this->hasOne(Timesheet::class, 'booking_id', 'id');
    }

    public function booking_status(){
        return $this->hasOne(Booking_status::class, 'id', 'id');
    }

    public function sluggable(){
        return [
            'slug' => [
                'source' => 'practice_id'
            ]
        ];
    }
}
