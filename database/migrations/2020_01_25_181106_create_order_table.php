<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('total_price')->nullable();
            $table->string('name')->nullable();
            $table->string('watsapp')->nullable();
            $table->bigInteger('pickuppoint_id')->nullable()->unsigned();
            $table->bigInteger('tour_id')->nullable()->unsigned();
            $table->string('quantity')->nullable()->comment('numero de personas');
            $table->string('date')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('type_pay_id')->nullable()->unsigned();
            $table->string('token')->nullable();
            $table->string('status')->nullable()->default('pendiente');
            $table->string('pref_id')->nullable();
            $table->timestamps();

            $table->foreign('pickuppoint_id')->references('id')->on('pickUpPoints')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('type_pay_id')->references('id')->on('type_pays')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tour_id')->references('id')->on('tours')
                ->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
