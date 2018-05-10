<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan', function (Blueprint $table) {
            $table->string('loan_id',10);
            $table->string('member_no',10);
            $table->timestamp('loan_date');
            $table->string('loan_type',10);
            $table->decimal('loan_amount',12,2)->nullable()->default(0);
            $table->smallInteger('term');
            $table->decimal('int_rate',11,8)->nullable();
            $table->string('status',1);
            $table->string('loan_vchno',14)->nullable();
            $table->decimal('interest',12,2)->nullable();
            $table->decimal('fines',12,2)->nullable();
            $table->decimal('payments',12,2)->nullable();
            $table->timestamp('last_tran_dt')->nullable();
            $table->integer('pb_lineno')->nullable();
            $table->smallInteger('installment_type')->nullable();
            $table->decimal('service_fee',8,5)->default(0)->nullable();
            $table->string('add_on_flag',1)->nullable();
            $table->decimal('add_on_pert',8,5)->nullable();
            $table->string('int_type',1)->nullabe();
            $table->tinyInteger('overdue_comptd')->nullable();
            $table->string('class_code',3)->nullable();
            $table->string('req_crdt_chk',1)->nullable();
            $table->tinyInteger('prepaid_int')->nullable();
            $table->string('collector',10)->nullable();
            $table->decimal('add_on_sva',8,5)->nullable()->default(0);
            $table->decimal('ins_prem',12,2)->nullable();
            $table->decimal('taxes_prem',12,2)->nullable();
            $table->decimal('doc_stamp',12,2)->nullable();
            $table->decimal('notrl_fee',12,2)->nullable();
            $table->string('op_id',5);
            $table->smallInteger('dday_colmn')->nullable()->default(0);
            $table->decimal('sched_lamt',12,2)->nullable()->default(0);
            $table->decimal('int_factor',12,2)->nullable()->default(0);
            $table->smallInteger('no_of_payments')->default(0);
            $table->datetime('start_dt')->nullable();
            $table->string('cdt_status',1)->nullable()->default(0);
            $table->tinyInteger('prepaid_prin')->nullable();
            $table->decimal('filling_fee',12,2)->nullable();
            $table->string('last_ws',20)->nullable();
            $table->string('last_user',20)->nullable();
            $table->timestamp('last_update')->nullable();
            $table->timestamp('active_date')->nullable();
            $table->string('cisa_payment_method',30)->nullable();
            $table->string('cisa_collateral',30)->nullable();
            $table->primary(array('loan_id','op_id'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan');
    }
}
