<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_foods', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bill_id')->unsigned()->nullable();
            $table->foreign('bill_id')->references('id')->on('bills')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('food_id')->unsigned()->nullable();
            $table->foreign('food_id')->references('id')->on('food')->onUpdate('cascade')->onDelete('cascade');
            $table->float('food_quantity');
<<<<<<< HEAD:database/migrations/2021_08_13_024506_create_bill_foods_table.php
            $table->float('price');
            $table->float('food_discount');
=======
            $table->float('food_price');
            $table->float('food_discount');
            $table->float('price_after_discount');
>>>>>>> dd0482b3b9ec825bc95fac72b9983deda6948f62:database/migrations/2021_08_17_092610_create_bill_foods_table.php
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
        Schema::dropIfExists('bill_foods');
    }
}
