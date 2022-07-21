<?php

namespace App\Modules\User_identity\Model;
use App\Modules\Dcp\Model\Dcp;
use App\Modules\Identity\Model\Identity;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class User_identity extends Model
{
    use SoftDeletes;
    public  $table = 'user_identity';

    protected $fillable = ['id','ide_id','user_id','picture','status','validity','feedback','deleted_at','created_at','updated_at',];

    public function dcp(){
        return $this->belongsTo(Dcp::class, 'user_id','id');
    }

    public function identity(){
        return $this->belongsTo(Identity::class, 'ide_id', 'id');

    }
}
