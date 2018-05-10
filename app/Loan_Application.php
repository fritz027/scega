<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Loan_Application extends Model
{
    protected $table = 'wloan_app';

    protected $primaryKey = 'loan_id';

    protected $dates = ['loan_app_date','recvd_at_ofc_dt','approve_dt','release_dt'];

    public $incrementing = false;

    public $timestamps = false;


    public $fillable = [
        'loan_id',
        'member_no',
        'loan_app_date',
        'loan_type',
        'loan_amount_app',
        'loan_purpose',
        'term',
    ];


    public function comakers(){
        return $this->hasMany('App\CoMaker','loan_id','loan_id');
    }

    public function members(){
        return $this->hasOne('App\Member','member_no','member_no');

    }
    public function loan_types(){
        return $this->hasOne('App\Loan_Type','loan_type','loan_type');
    }
}
