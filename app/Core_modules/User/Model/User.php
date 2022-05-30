<?php

namespace App\Core_modules\User\Model;

use App\Modules\Availability\Model\Availability;
use App\Modules\Bank_detail\Model\Bank_detail;
use App\Modules\Booking_status\Model\Booking_status;
use App\Modules\Compliance\Model\Compliance;
use App\Modules\Dcp\Model\Dcp;
use App\Modules\Document\Model\Document;
use App\Modules\Experience\Model\Experience;
use App\Modules\Identity\Model\Identity;
use App\Modules\Immunization\Model\Immunization;
use App\Modules\Invoice\Model\Invoice;
use App\Modules\Practice\Model\Practice;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasRoles, HasApiTokens, SoftDeletes;
    public  $table = 'users';

    protected $fillable = ['id','name','username', 'email_verified_at', 'control','last_visit','status','email','password', 'contact', 'role', 'deleted_at','created_at','updated_at',];

    protected $hidden = [
      'remember_token'
    ];

    protected $casts = [
      'email_verified_at' => 'datetime'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function dcp(){
        return $this->hasOne(Dcp::class, 'user_id', 'id');
    }

    public function booking_status(){
        return $this->hasMany(Booking_status::class, 'user_id', 'id');
    }

    public function practice(){
        return $this->hasOne(Practice::class, 'user_id', 'id');
    }

    public function availability(){
        return $this->hasMany(Availability::class, 'user_id', 'id');
    }

    public function bank_details(){
        return $this->hasMany(Bank_detail::class, 'user_id', 'id');
    }

    public function experiences(){
        return $this->belongsToMany(Experience::class, 'experience_user', 'user_id', 'experience_id');
    }

    public function immunization_documents(){
        return $this->belongsToMany(Document::class, 'imm_doc', 'user_id','doc_id');
    }

    public function immunizations(){
        return $this->belongsToMany(Immunization::class, 'imm_doc', 'user_id', 'imm_id');
    }

    public function compliances(){
        return $this->belongsToMany(Compliance::class, 'comp_doc', 'user_id', 'comp_id');
    }

    public function compliance_documents(){
        return $this->belongsToMany(Document::class, 'comp_doc', 'user_id','doc_id');
    }

    public function identities(){
        return $this->belongsToMany(Identity::class, 'ide_doc', 'ide_id');
    }

    public function identity_documents(){
        return $this->belongsToMany(Document::class, 'ide_doc', 'doc_id');
    }

    public function invoice(){
        return $this->hasMany(Invoice::class, 'practice_id', 'id');
    }

}
