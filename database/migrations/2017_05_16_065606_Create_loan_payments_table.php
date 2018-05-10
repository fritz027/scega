<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_payments', function (Blueprint $table) {
            $table->string('loan_id',12);
            $table->timestamp('tran_date');
            $table->string('tran_no',14);
            $table->decimal('prin_due',12,2);
            $table->decimal('int_due',12,2);
            $table->decimal('fines_due',12,2);
            $table->decimal('prin_payment',12,2);
            $table->decimal('int_payment',12,2);
            $table->decimal('fines_payment',12,2);
            $table->tinyInteger('pb_printed');
            $table->decimal('past_prin_bal',12,2);
            $table->decimal('past_int_bal',12,2);
            $table->decimal('past_fines_bal',12,2);
            $table->tinyInteger('fire_trg');
            $table->timestamp('last_tran_dt')->nullable();
            $table->string('op_id',5);
            $table->string('dbt_prin_type',1)->nullable();
            $table->string('paymt_type',1)->nullable()->default('C');
            $table->string('check_no',2)->nullable();
            $table->timestamp('check_dt')->nullable();
            $table->timestamp('clear_dt')->nullable();
            $table->primary(array('loan_id','tran_date','tran_no','op_id'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_payments');
    }
}
