<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time_Depo extends Model
{
    protected $table = 'time_depo';

    protected $primaryKey = 'jrnref_no';

    public $incrementing = false;
    public $timestamps = false;

    protected $dates = ['dep_date','due_date'];

    public function deposit_member(){
        return $this->hasOne('App\Member','member_no','member_no');
    }
}
