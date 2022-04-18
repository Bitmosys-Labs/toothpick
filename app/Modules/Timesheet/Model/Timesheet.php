<?php

namespace App\Modules\Timesheet\Model;
use App\Modules\Booking\Model\Booking;
use App\Modules\Receipt\Model\Receipt;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    use SoftDeletes;
    public  $table = 'timesheet';

    protected $fillable = ['id','booking_id','slug','start_time','end_time','lunch_time','approved_by','signature','payable_amount','vat','status','deleted_at','created_at','updated_at',];

    public function booking(){
        return $this->belongsTo(Booking::class, 'booking_id', 'id');
    }

    public function receipt(){
        return $this->hasOne(Receipt::class, 'timesheet_id', 'id');
    }

}
