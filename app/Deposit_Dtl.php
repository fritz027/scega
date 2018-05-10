<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit_Dtl extends Model
{
        protected $table = 'deposit_dtl';

        protected $primaryKey = 'member_no';

        protected $dates = ['tran_date'];

        public $timestamps = false;

        public $incrementing = false;


    public function deposits(){
        return $this->hasOne('App\Deposit','member_no','member_no');
    }
}
