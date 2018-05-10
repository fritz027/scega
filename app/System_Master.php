<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System_Master extends Model
{
    protected $table = 'sys_mstr';

    protected $primaryKey = 'table_name';

    protected $fillable = ['table_name','last_value'];

    public $incrementing = false;

    public $timestamps = false;



}