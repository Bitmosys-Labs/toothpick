<?php

namespace App\Modules\User_comp\Model;
use App\Modules\Compliance\Model\Compliance;
use App\Modules\Dcp\Model\Dcp;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class User_comp extends Model
{
    use SoftDeletes;
    public  $table = 'user_comp';

    protected $fillable = ['id','comp_id','user_id','picture','status','validity','feedback','deleted_at','created_at','updated_at',];

    public function dcp(){
        return $this->belongsTo(Dcp::class, 'user_id','id');
    }

    public function compliance(){
        return $this->belongsTo(Compliance::class, 'comp_id', 'id');
    }

}
