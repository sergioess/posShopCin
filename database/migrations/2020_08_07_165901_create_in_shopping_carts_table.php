<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInShoppingCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('in_shopping_carts', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("articulo_id")->unsigned();
            $table->integer("shopping_cart_id")->unsigned();
            $table->integer("cantidad")->unsigned();
            $table->double("precio")->unsigned();
            $table->foreign('articulo_id')->references('id')->on('articulos');
            $table->foreign('shopping_cart_id')->references('id')->on('shopping_carts'); //hace referencia al id de la tabla shopping_carts

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
        Schema::dropIfExists('in_shopping_carts');
    }
}
