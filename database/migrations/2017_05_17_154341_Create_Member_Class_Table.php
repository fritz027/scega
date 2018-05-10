<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mbr_class', function (Blueprint $table) {
            $table->string('mbr_class',3);
            $table->string('description',30);
            $table->string('op_id',5);
            $table->primary('mbr_class');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mbr_class', function (Blueprint $table) {
            //
        });
    }
}
