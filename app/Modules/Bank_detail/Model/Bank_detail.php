<?php

namespace App\Modules\Bank_detail\Model;
use App\Core_modules\User\Model\User;
use App\Modules\Booking\Model\Booking;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Bank_detail extends Model
{
    use SoftDeletes;
    public  $table = 'bank_details';

    protected $fillable = ['id','user_id','bank_name','acc_no','status','deleted_at','created_at','updated_at',];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
