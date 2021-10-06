<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeneficiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('referenceid');
            $table->bigInteger('user_id');
            $table->string('id_proof');
            $table->string('id_number');
            $table->string('name');
            $table->string('gender');
            $table->date('dob');
            $table->integer('dose');
            $table->timestamps();
        });

    }

    /**
     * 
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beneficiaries');
    }
}
