<?php

namespace App\Modules\Additional\Model;
use App\Modules\Timesheet\Model\Timesheet;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Additional extends Model
{
    use SoftDeletes;
    public  $table = 'additional';

    protected $fillable = ['id','invoice_id','amount','purpose','receipt','status','deleted_at','created_at','updated_at',];

    public function timesheet(){
        return $this->belongsTo(Timesheet::class, 'invoice_id', 'id');
    }
}
