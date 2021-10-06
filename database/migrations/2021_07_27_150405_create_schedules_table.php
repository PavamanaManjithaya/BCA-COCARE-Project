<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('beneficiaries_id');
            $table->bigInteger('user_id');
			$table->date('bookingdate');
            $table->bigInteger('vaccinecenter_id');
            $table->bigInteger('vaccinetype_id');
            $table->dateTime('scheduletime');
            $table->char('secretcode',5);
            $table->Integer('doseno');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
