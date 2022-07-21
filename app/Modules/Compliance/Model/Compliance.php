<?php

namespace App\Modules\Compliance\Model;
use App\Core_modules\User\Model\User;
use App\Modules\Document\Model\Document;
use App\Modules\Staff\Model\Staff;
use App\Modules\User_comp\Model\User_comp;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Compliance extends Model
{
    use SoftDeletes;
    public  $table = 'compliance';

    protected $fillable = ['id','type','staff_id','requirement','deleted_at','created_at','updated_at',];

    public function comp_doc(){
        return $this->hasMany(User_comp::class, 'comp_id', 'id');
    }

//    public function users(){
//        return $this->belongsToMany(User::class, 'comp_doc', 'user_id');
//    }

    public function staff(){
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }
}
