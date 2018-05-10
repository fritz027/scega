<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepositDtlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposit_dtl', function (Blueprint $table) {
            $table->string('member_no',10);
            $table->string('deposit_type',10);
            $table->timestamp('tran_date');
            $table->string('tran_no',14);
            $table->string('tran_type',1);
            $table->decimal('amount',12,2);
            $table->datetime('clear_date')->nullable();
            $table->tinyInteger('pb_printed');
            $table->string('paymt_type',1)->nullable();
            $table->string('check_no',20)->nullable();
            $table->string('bank',30)->nullable();
            $table->dateTime('check_dt')->nullable();
            $table->integer('seq_no')->default(0);
            $table->decimal('curr_balance',12,2)->nullable()->default(0);
            $table->dateTime('last_trn_date')->nullable();
            $table->string('op_id');
            $table->primary(array('member_no','deposit_type','tran_date','tran_no','seq_no','op_id'),'tbl_deposit_dtl_primary_key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deposit_dtl');
    }
}
