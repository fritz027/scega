<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepositTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposit_type', function (Blueprint $table) {
            $table->string('deposit_type',10);
            $table->string('op_id',5);
            $table->string('deposit_desc',30);
            $table->string('int_cd',10);
            $table->string('fines_cd',10);
            $table->integer('priority');
            $table->string('credit_cd',10);
            $table->string('shrt_name',20);
            $table->string('debit_cd',10);
            $table->primary('deposit_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deposit_type', function (Blueprint $table) {
            //
        });
    }
}
