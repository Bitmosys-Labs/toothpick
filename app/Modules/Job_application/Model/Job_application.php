<?php

namespace App\Modules\Job_application\Model;
use App\Modules\Job\Model\Job;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Job_application extends Model
{
    use SoftDeletes;
    public  $table = 'job_application';

    protected $fillable = ['id','full_name','phone','email','job_id','no_of_days','drive','access_to_car','postcode','cv','status','deleted_at','created_at','updated_at',];

    public function job(){
        return $this->belongsTo(Job::class, 'job_id', 'id');
    }
}
