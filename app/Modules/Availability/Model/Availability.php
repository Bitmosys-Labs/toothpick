<?php

namespace App\Modules\Availability\Model;
use App\Core_modules\User\Model\User;
use App\Modules\Day\Model\Day;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use SoftDeletes;
    public  $table = 'availability';

    protected $fillable = ['id','user_id','days_id','deleted_at','created_at','updated_at',];

    public function user(){
        $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function days(){
        $this->belongsTo(Day::class, 'days_id', 'id');
    }
}
