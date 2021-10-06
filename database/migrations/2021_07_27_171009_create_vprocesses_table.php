<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVprocessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vprocesses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('beneficiaries_id');
			$table->bigInteger('verifier_id');
			$table->bigInteger('vaccinator_id');
            $table->boolean('verifierstatus');
            $table->boolean('vaccinatorstatus');
            $table->datetime('vaccinedate');
            $table->bigInteger('vaccinecenter_id');
            $table->bigInteger('schedules_id');
            $table->float('amount', 8, 2);
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
        Schema::dropIfExists('vprocesses');
    }
}
