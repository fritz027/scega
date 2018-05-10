<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoMaker extends Model
{
    protected $table = 'wloan_comaker';

    protected $primaryKey = ['loan_id','comaker_id'];

    public $incrementing = false;

    public $timestamps = false;

    public $fillable = ['loan_id','comaker_id'];


    public function loanapp(){
        return $this->hasOne('App\Loan_Application','loan_id','loan_id');
    }

    public function member_comaker(){
        return $this->hasOne('App\Member','member_no','comaker_id');
    }
}
