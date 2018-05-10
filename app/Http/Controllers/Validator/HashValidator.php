<?php

namespace App\Http\Controllers\Validator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Hash;

class HashValidator extends Validator
{
    public function validatehash($attribute, $value, $parameters){
        return Hash::check($value,$parameters[0]);
    }
}
