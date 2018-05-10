<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table_Update extends Model
{
    protected $table = 'table_updates';

    protected $primaryKey = 'id';

    public $timestamps = false;
}
