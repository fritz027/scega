<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan_Payments extends Model
{
    protected $table = 'loan_payments';

    protected $primaryKey = 'loan_id';

    public $incrementing = false;

    protected $dates = ['tran_date'];

    public $timestamps = false;


    public function loans(){
        return $this->hasOne('App\Loan','loan_id','loan_id');
    }
}
