<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_mstr', function (Blueprint $table) {
            $table->string('table_name');
            $table->integer('column_no')->default(1);
            $table->integer('last_value');
            $table->primary(array('table_name','column_no'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_mstr');
    }
}
