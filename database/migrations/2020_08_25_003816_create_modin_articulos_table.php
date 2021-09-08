<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModinArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modin_articulos', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("articulo_id")->unsigned();
            $table->integer("modificador_id")->unsigned();
            $table->integer("shopping_cart_id")->unsigned();
            $table->foreign('articulo_id')->references('id')->on('articulos');
            $table->foreign('modificador_id')->references('id')->on('modificadors'); //hace referencia al id de la tabla shopping_carts
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
        Schema::dropIfExists('modin_articulos');
    }
}
