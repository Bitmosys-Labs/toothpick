<?php

namespace App\Modules\Dcp\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Dcp extends Model
{
    use SoftDeletes;
    public  $table = 'dcp';

    protected $fillable = ['id','user_id','staff_id','gdc_no','postcode','address','latitude','longitude','country','emergency_contact','relation_to_emergency_contact','travel','hourly_rate','status','employment_history','deleted_at','created_at','updated_at',];
}
