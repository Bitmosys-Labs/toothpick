<?php

namespace App\Modules\Job\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use Sluggable;
    use SoftDeletes;
    public  $table = 'jobs';

    protected $fillable = ['id','slug','position','number','requirements','till','status','deleted_at','created_at','updated_at',];

    public function sluggable(){
        return  [
            'slug' => [
                'source' => 'position'
            ]
        ];
    }
}
