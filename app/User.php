<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','member_no'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function members(){

        return $this->hasOne('App\Member','member_no','member_no');
    }

    public function deposits($id){


        $deposit = DB::table('deposit')
            ->select('deposit_type.deposit_desc','deposit.deposit_type','deposit.balance',DB::raw('SUM(deposit.beg_bal) as beg_bal'))
            ->join('deposit_type','deposit_type.deposit_type','=','deposit.deposit_type')
            ->where(['deposit.member_no' => $id])
            ->Where(['deposit.status' => '1'])
            ->groupBy('deposit_type.deposit_desc','deposit.deposit_type','deposit.balance')
            ->get();

        return $deposit;

    }


    public function Member_Loan(){
        return $this->hasMany('App\Loan','member_no','member_no');
    }


    public function Members_Deposits(){
        return $this->hasMany('App\Deposit','member_no','member_no');
    }

   public function Member_DepType($deptype){
        $dep_desc = DB::table('deposit_type')->where('deposit_type',$deptype)->get();

	return $dep_desc;
    }


    /*
     *
     * Boot the model
     *
     */

    public static function boot(){
        parent::boot();

        static::creating(function ($user) {
            $user->token = str_random(35);
        });


    }

    public function hasVerified(){
        $this->verified = true;
        $this->token = null;

        $this->save();

    }
  }
