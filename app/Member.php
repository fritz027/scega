<?php
/**
 * Created by PhpStorm.
 * User: Aspire
 * Date: 2/20/2017
 * Time: 2:27 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use App\Deposit;


class Member Extends Model
{
    protected $table = 'member';

    protected $primaryKey =  'member_no';

    public $incrementing = false;

    public $timestamps = false;


    protected $dates = ['bdate'];

    public function deposits(){

        return $this->hasMany('App\Deposit','member_no','member_no');
    }


    public function loans(){
        return $this->hasMany('App\Loan_Application','member_no','member_no');
    }

}