<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('district_id');
            $table->bigInteger('vaccinecenter_id');
            $table->bigInteger('vaccinetype_id');
            $table->bigInteger('stock_id');
            $table->date('date');
            $table->integer('qty');
            $table->integer('sage');
            $table->integer('eage');
            $table->integer('dose');
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
        Schema::dropIfExists('stocks');
    }
}
