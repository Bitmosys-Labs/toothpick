<?php

namespace App\Modules\Day\Model;
use App\Modules\Availability\Model\Availability;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use SoftDeletes;
    public  $table = 'days';

    protected $fillable = ['id','day','deleted_at','created_at','updated_at',];

    public function availability(){
        return $this->hasMany(Availability::class, 'days_id', 'id');
    }
}
