<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTroublePhotos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trouble_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('extension', 4);
            $table->integer('trouble_id')->unsigned();
            $table->foreign('trouble_id')->references('id')->on('troubles');
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
        Schema::dropIfExists('trouble_photos');
    }
}
