<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeDepoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_depo', function (Blueprint $table) {
            $table->string('jrnref_no',15);
            $table->string('member_no',10);
            $table->dateTime('dep_date');
            $table->smallInteger('term');
            $table->timestamp('due_date');
            $table->decimal('dep_amt',12,2);
            $table->decimal('int_rate',8,5);
            $table->string('open_status',2);
            $table->string('term_status',2);
            $table->string('td_certif_no',10);
            $table->string('sl_code2',2);
            $table->decimal('dm_cm_amt',12,2);
            $table->string('ref_jrnref_no',15);
            $table->string('op_id',5);
            $table->dateTime('term_dt');
            $table->string('acct_code',10);
            $table->decimal('coltrl_amt',12,2);
            $table->string('last_ws',20);
            $table->string('last_user',20);
            $table->dateTime('last_update');
            $table->dateTime('active_date');
            $table->primary(array('jrnref_no','op_id'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_depo');
    }
}
