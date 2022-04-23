<?php

namespace App\Modules\Immunization\Model;
use App\Core_modules\User\Model\User;
use App\Modules\Document\Model\Document;
use App\Modules\Staff\Model\Staff;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Immunization extends Model
{
    use SoftDeletes;
    public  $table = 'immunization';

    protected $fillable = ['id','staff_id', 'type', 'requirement','deleted_at','created_at','updated_at',];

    public function staff(){
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'imm_doc', 'user_id');
    }

    public function documents(){
        return $this->belongsToMany(Document::class, 'imm_doc', 'doc_id', 'imm_id');
    }
}
