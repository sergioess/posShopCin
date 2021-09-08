<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("empresa_id")->unsigned();
            $table->integer("user_id")->unsigned();
            $table->date("fecha");
            $table->integer("shopping_cart_id")->unsigned();
            $table->integer("comensales")->unsigned();
            $table->datetime("hora");   
            $table->text("observacion")->nullable();       
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
        Schema::dropIfExists('reservas');
    }
}
