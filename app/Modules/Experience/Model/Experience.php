<?php

namespace App\Modules\Experience\Model;
use App\Core_modules\User\Model\User;
use App\Modules\Staff\Model\Staff;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use SoftDeletes;
    public  $table = 'experience';

    protected $fillable = ['id','staff_id','type','deleted_at','created_at','updated_at',];

    public function staff(){
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'experience_user', 'experience_id', 'user_id');
    }
}
