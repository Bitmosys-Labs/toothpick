<?php

namespace App\Modules\Additional\Model;
use App\Modules\Receipt\Model\Receipt;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Additional extends Model
{
    use SoftDeletes;
    public  $table = 'additional';

    protected $fillable = ['id','invoice_id','amount','purpose','receipt','status','deleted_at','created_at','updated_at',];

    public function receipt(){
        return $this->belongsTo(Receipt::class, 'receipt_id', 'id');
    }
}
