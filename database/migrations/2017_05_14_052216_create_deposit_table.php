<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepositTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposit', function (Blueprint $table) {
            $table->string('member_no',10);
            $table->string('deposit_type',10);
            $table->decimal('beg_bal',12,2);
            $table->timestamp('beg_bal_dt');
            $table->decimal('balance',12,2);
            $table->decimal('withdrawble',12,2);
            $table->datetime('last_trn_date')->nullable();
            $table->integer('pb_lineno')->default(0);
            $table->string('status',1)->nullable()->default(1);
            $table->string('op_id',5);
            $table->decimal('min_amt',12,2)->nullable();
            $table->decimal('max_amt',12,2)->nullable();
            $table->decimal('coltrl_amt',12,2)->nullable();
            $table->string('serial_no',20)->nullable();
            $table->string('last_ws',20)->nullable();
            $table->string('last_user',20)->nullable();
            $table->dateTime('last_update')->nullable();
            $table->dateTime('active_date')->nullable();
            $table->primary(array('member_no','deposit_type','op_id','beg_bal_dt'),'pk_for_deposit_tbl');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deposit');
    }
}
