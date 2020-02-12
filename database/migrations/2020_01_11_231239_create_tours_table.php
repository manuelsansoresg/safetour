<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->text('description')->nullable();

            $table->double('price', 18, 4)->default(0) ->nullable();
            $table->timestamps();
        });

        Schema::create('tour_images', function (Blueprint $table) {
            $table->bigInteger('tour_id')->nullable()->unsigned();
            $table->string('name');
            $table->timestamps();

            $table->foreign('tour_id')->references('id')->on('tours')
            ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('pickUpPoints', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->double('price', 18, 4)->default(0)->nullable();
            $table->timestamps();

        });

        Schema::create('type_pays', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('type')->nullable()->comment('si es suma , resta, ninguno');
            $table->double('price', 18, 4)->default(0)->nullable();
            $table->string('legend')->nullable();
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

        Schema::dropIfExists('tours');
        Schema::dropIfExists('tour_images');
        Schema::dropIfExists('pickUpPoints');
        Schema::dropIfExists('type_pays');
    }
}
