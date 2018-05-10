<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_type', function (Blueprint $table) {

            $table->string('loan_type',10);
            $table->string('loan_desc',30);
            $table->string('int_cd',10);
            $table->string('fines_cd',10);
            $table->string('op_id',5);
            $table->smallInteger('term');
            $table->decimal('int_rate',11,8);
            $table->smallInteger('installment_type');
            $table->decimal('service_fee',8,5);
            $table->string('add_on_flag',1);
            $table->decimal('add_on_pert',8,5);
            $table->string('int_type',1);
            $table->string('class_code',3);
            $table->string('req_crdt_chk',1);
            $table->tinyInteger('prepaid_int');
            $table->decimal('add_on_sva',8,5);
            $table->decimal('int_factor',11,8);
            $table->string('loan_purpose',250);
            $table->string('srv_cd',10);
            $table->integer('no_of_payments');
            $table->string('use_sbracket',1);
            $table->string('use_ibracket',1);
            $table->string('use_intfactbrkt',1);
            $table->smallInteger('dday_colmn');
            $table->smallInteger('to_par');
            $table->string('tqry_name',5);
            $table->string('cisa_type_of_obligation',50);
            $table->string('contract_type',2);
            $table->primary('loan_type');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loan_type', function (Blueprint $table) {
            //
        });
    }
}
