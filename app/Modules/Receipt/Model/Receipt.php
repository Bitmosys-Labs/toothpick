<?php

namespace App\Modules\Receipt\Model;
use App\Modules\Additional\Model\Additional;
use App\Modules\Timesheet\Model\Timesheet;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use SoftDeletes;
    public  $table = 'receipt';

    protected $fillable = ['id','timesheet_id','slug','working_hours','rate','total','status','deleted_at','created_at','updated_at',];

    public function timesheet(){
        return $this->belongsTo(Timesheet::class, 'timesheet_id', 'id');
    }

    public function additionals(){
        return $this->hasMany(Additional::class, 'receipt_id', 'id');
    }
}
