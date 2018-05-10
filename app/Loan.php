<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $table = 'loan';

    protected $primaryKey =  'loan_id';

    public $incrementing = false;

    public $timestamps = false;

    protected $dates = ['loan_date'];


    public function loan_types(){
        return $this->hasOne('App\Loan_Type','loan_type','loan_type');
    }

    public function Loans_payments(){
        return $this->hasMany('App\Loan_Payments','loan_id','loan_id');
    }
}
