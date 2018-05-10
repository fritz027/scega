<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member', function (Blueprint $table) {
            $table->string('member_no',10);
            $table->string('member_name',50);
            $table->string('nick_name',30)->nullable();
            $table->string('member_type',1);
            $table->string('assoc_type',30)->nullable();
            $table->dateTime('bdate')->nullable();
            $table->string('birth_place',30)->nullable();
            $table->string('addr_street1',40)->nullable();
            $table->string('addr_street2',40)->nullable();
            $table->string('zipcode',6)->nullable();
            $table->string('telno',40)->nullable();
            $table->string('email',50)->nullable();
            $table->string('gender',1)->nullable();
            $table->decimal('height',5,2)->nullable();
            $table->decimal('weight',5,2)->nullable();
            $table->string('civ_stat',10)->nullable();
            $table->string('spouse',40)->nullable();
            $table->dateTime('sps_bdate')->nullable();
            $table->datetime('membership_date');
            $table->dateTime('membership_wdr_date')->nullable();
            $table->dateTime('death_date')->nullable();
            $table->string('cause_of_death',250)->nullable();
            $table->string('mbr_rem',250)->nullable();
            $table->string('religion',30)->nullable();
            $table->string('blood_type',3)->nullable();
            $table->string('chapter',3)->nullable();
            $table->string('mbr_status',1)->nullable();
            $table->string('mbr_class',3)->nullable();
            $table->string('ctc_no',50)->nullable();
            $table->dateTime('issued_on')->nullable();
            $table->string('issued_at',60)->nullable();
            $table->string('op_id',5);
            $table->string('bank_acct_no',30)->nullable();
            $table->string('mbr_emp_no',10)->nullable();
            $table->string('mbr_tin_no',12)->nullable();
            $table->string('soa_nofnot',255)->nullable();
            $table->string('soa_coltrl',255)->nullable();
            $table->string('last_ws',20)->nullable();
            $table->string('last_user',20)->nullable();
            $table->dateTime('last_update')->nullable();
            $table->dateTime('active_date')->nullable();
            $table->primary(array('member_no','op_id'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member');
    }
}
