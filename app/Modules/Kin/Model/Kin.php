<?php

namespace App\Modules\Kin\Model;
use App\Modules\Dcp\Model\Dcp;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Kin extends Model
{
    use SoftDeletes;
    public  $table = 'kin';

    protected $fillable = ['id', 'dcp_id', 'name','contact','home_contact','relation','address','deleted_at','created_at','updated_at',];

    public function dcp(){
        return $this->belongsTo(Dcp::class, 'dcp_id', 'id');
    }
}
