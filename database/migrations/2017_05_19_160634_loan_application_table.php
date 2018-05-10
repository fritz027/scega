<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LoanApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wloan_app', function (Blueprint $table) {
            $table->string('loan_id',10);
            $table->string('member_no',10);
            $table->dateTime('loan_app_date');
            $table->string('loan_type',10);
            $table->decimal('loan_amount_app',12,2);
            $table->string('loan_purpose',100);
            $table->integer('term');
            $table->dateTime('recvd_at_ofc_dt')->nullable();
            $table->dateTime('approve_dt')->nullable();
            $table->dateTime('release_dt')->nullable();
            $table->primary('loan_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wloan_app');
    }
}
