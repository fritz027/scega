<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit_Type extends Model
{
    Protected $table = 'deposit_type';

    protected $primaryKey = 'deposit_type';

    public $timestamps = false;

    public $incrementing = false;

    public function deposittype(){
        return $this->hasMany('App\Deposit','deposit_type','deposit_type');
    }
}
