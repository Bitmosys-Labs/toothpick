<?php

namespace App\Modules\Identity\Model;
use App\Core_modules\User\Model\User;
use App\Modules\Document\Model\Document;
use App\Modules\Staff\Model\Staff;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Identity extends Model
{
    use SoftDeletes;
    public  $table = 'identity';

    protected $fillable = ['id','type','staff_id','requirement','deleted_at','created_at','updated_at',];

    public function documents(){
        return $this->belongsToMany(Document::class, 'ide_doc', 'doc_id');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'ide_doc', 'user_id');
    }

    public function staff(){
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }
}
