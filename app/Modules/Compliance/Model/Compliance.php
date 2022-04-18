<?php

namespace App\Modules\Compliance\Model;
use App\Core_modules\User\Model\User;
use App\Modules\Document\Model\Document;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Compliance extends Model
{
    use SoftDeletes;
    public  $table = 'compliance';

    protected $fillable = ['id','type','staff_id','requirement','deleted_at','created_at','updated_at',];

    public function documents(){
        return $this->belongsToMany(Document::class, 'comp_doc', 'doc_id');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'comp_doc', 'user_id');
    }
}
