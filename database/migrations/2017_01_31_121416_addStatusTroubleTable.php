<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusTroubleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('troubles', function (Blueprint $table) {
            $table->string('status')->default('P'); //P - Pendente, C - concluída, X - Cancelada
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('troubles', function (Blueprint $table) {
            $table->removeColumn('status');
        });
    }
}
