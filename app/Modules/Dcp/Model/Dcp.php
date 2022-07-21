<?php

namespace App\Modules\Dcp\Model;
use App\Core_modules\User\Model\User;
use App\Modules\Kin\Model\Kin;
use App\Modules\Practice\Model\Practice;
use App\Modules\Rating\Model\Rating;
use App\Modules\Staff\Model\Staff;
use App\Modules\User_comp\Model\User_comp;
use App\Modules\User_identity\Model\User_identity;
use App\Modules\User_immunization\Model\User_immunization;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Dcp extends Model
{
    use SoftDeletes;
    public  $table = 'dcp';

    protected $fillable = ['id','user_id','staff_id','gdc_no','postcode','address','latitude','longitude','country', 'travel','hourly_rate','status','employment_history','deleted_at','created_at','updated_at',];

    public function staff(){
        return $this->belongsToMany(Staff::class, 'staff_dcp', 'user_id', 'staff_id');
    }

    public function practice(){
        return $this->belongsTo(Practice::class, 'employment_history', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function kin(){
        return $this->hasMany(Kin::class, 'dcp_id', 'id');
    }

    public function rating(){
        return $this->hasMany(Rating::class, 'dcp_id', 'id');
    }

    public function compliance(){
        return $this->hasMany(User_comp::class, 'user_id', 'id');
    }

    public function immunization(){
        return $this->hasMany(User_immunization::class, 'user_id', 'id');
    }

    public function identity(){
        return $this->hasMany(User_identity::class, 'user_id', 'id');
    }
}
