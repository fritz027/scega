<?php
/**
 * Created by PhpStorm.
 * User: Aspire
 * Date: 3/19/2017
 * Time: 8:21 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $table = 'deposit';

    protected $primaryKey = 'member_no';

    protected $dates = ['beg_bal_dt'];

    public $incrementing = false;

    public $timestamps = false;


    public function deposit_type(){
        return $this->hasOne('App\Deposit_Type','deposit_type','deposit_type');
    }

    public function deposit_dtl(){
        return $this->hasMany('App\Deposit_Dtl','member_no','member_no');
    }


}