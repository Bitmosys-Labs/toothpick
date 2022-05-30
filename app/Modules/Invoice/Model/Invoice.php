<?php

namespace App\Modules\Invoice\Model;
use App\Modules\Timesheet\Model\Timesheet;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Core_modules\User\Model\User;


use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use SoftDeletes;
    public  $table = 'invoice';

    protected $fillable = ['id','deleted_at','slug','practice_id','issue_date','due_date','total','remarks','status','created_at','updated_at',];

    public function practice(){
        return $this->belongsTo(User::class, 'practice_id', 'id');
    }

    public function timesheet(){
        return $this->hasMany(Timesheet::class, 'invoice_id', 'id');
    }
}
