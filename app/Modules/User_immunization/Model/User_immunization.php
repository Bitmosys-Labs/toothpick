<?php

namespace App\Modules\User_immunization\Model;
use App\Modules\Dcp\Model\Dcp;
use App\Modules\Immunization\Model\Immunization;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class User_immunization extends Model
{
    use SoftDeletes;
    public  $table = 'user_immunization';

    protected $fillable = ['id','imm_id','user_id','picture','status','validity','feedback','deleted_at','created_at','updated_at',];

    public function dcp(){
        return $this->belongsTo(Dcp::class, 'user_id','id');
    }

    public function immunization(){
        return $this->belongsTo(Immunization::class, 'imm_id', 'id');

    }
}
