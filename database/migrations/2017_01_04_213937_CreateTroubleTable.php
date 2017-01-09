<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTroubleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('troubles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('address', 60);
            $table->integer('number')->nullable();
            $table->string('district', 30);
            $table->float('latitude', 10, 6);
            $table->float('longitude', 10, 6);
            $table->mediumText('description');
            $table->integer('marker_id')->unsigned();
            $table->foreign('marker_id')->references('id')->on('markers');
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
        Schema::dropIfExists('troubles');
    }
}
