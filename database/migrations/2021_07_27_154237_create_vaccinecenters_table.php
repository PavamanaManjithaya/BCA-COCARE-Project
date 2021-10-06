<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaccinecentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaccinecenters', function (Blueprint $table) {
            $table->id();
            $table->string('cvcname');
            $table->string('category');
            $table->string('address');
            $table->string('pincode');
            $table->bigInteger('state_id');
            $table->bigInteger('district_id');
            $table->time('starttime');
            $table->time('endtime');
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
        Schema::dropIfExists('vaccinecenters');
    }
}
