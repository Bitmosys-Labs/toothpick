<?php

namespace App\Modules\Rating\Model;
use App\Modules\Dcp\Model\Dcp;
use App\Modules\Practice\Model\Practice;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use SoftDeletes;
    public  $table = 'rating';

    protected $fillable = ['id','practice_id','dcp_id','rating','deleted_at','created_at','updated_at',];

    public function practice(){
        return $this->belongsTo(Practice::class, 'practice_id', 'id');
    }

    public function dcp(){
        return $this->belongsTo(Dcp::class, 'dcp_id', 'id');
    }
}
