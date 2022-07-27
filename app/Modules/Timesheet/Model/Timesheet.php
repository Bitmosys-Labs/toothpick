<?php

namespace App\Modules\Timesheet\Model;
use App\Modules\Additional\Model\Additional;
use App\Modules\Booking\Model\Booking;
use App\Modules\Invoice\Model\Invoice;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    use SoftDeletes;
    public  $table = 'timesheet';

    protected $fillable = ['id','booking_id', 'invoice_id', 'slug','start_time','end_time','lunch_time','approved_by','signature', 'total_hours', 'payable_amount','vat','status', 'due_date', 'deleted_at','created_at','updated_at',];

    public function booking(){
        return $this->belongsTo(Booking::class, 'booking_id', 'id');
    }

    public function additional(){
        return $this->hasOne(Additional::class, 'invoice_id', 'id');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id', 'id');
    }

}
