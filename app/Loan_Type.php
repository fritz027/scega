<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan_Type extends Model
{
    protected $table = 'loan_type';

    protected $primaryKey = 'loan_type';

    public $incrementing = false;
}
