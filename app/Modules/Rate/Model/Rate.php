<?php

namespace App\Modules\Rate\Model;
use App\Modules\Staff\Model\Staff;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use SoftDeletes;
    public  $table = 'rate';

    protected $fillable = ['id','staff_id','postcode','rate','deleted_at','created_at','updated_at',];

    public function staff(){
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }
}
