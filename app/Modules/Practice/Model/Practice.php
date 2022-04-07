<?php

namespace App\Modules\Practice\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    use SoftDeletes;
    public  $table = 'practice';

    protected $fillable = ['id','user_id','owners_name','payment','postcode','address','emergency_contact','gdc_no','contact', 'latitude', 'longitude', 'deleted_at','created_at','updated_at',];
}
