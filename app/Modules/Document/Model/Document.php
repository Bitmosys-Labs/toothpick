<?php

namespace App\Modules\Document\Model;
use App\Core_modules\User\Model\User;
use App\Modules\Compliance\Model\Compliance;
use App\Modules\Identity\Model\Identity;
use App\Modules\Immunization\Model\Immunization;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use SoftDeletes;
    public  $table = 'document';

    protected $fillable = ['id','picture', 'validity', 'feedback', 'status','deleted_at','created_at','updated_at',];

    public function immunizations(){
        return $this->belongsToMany(Immunization::class, 'imm_doc', 'imm_id');
    }

    public function user_immunizations(){
        return $this->belongsToMany(User::class, 'imm_doc', 'user_id');
    }

    public function compliances(){
        return $this->belongsToMany(Compliance::class, 'comp_doc', 'comp_id');
    }

    public function user_compliances(){
        return $this->belongsToMany(User::class, 'comp_doc', 'user_id');
    }

    public function identities(){
        return $this->belongsToMany(Identity::class, 'ide_doc', 'ide_id');
    }

    public function user_identities(){
        return $this->belongsToMany(User::class, 'ide_doc', 'user_id');
    }
}
