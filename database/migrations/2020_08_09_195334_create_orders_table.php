<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("empresa_id")->unsigned();
            $table->integer("shopping_cart_id")->unsigned();
            $table->foreign('shopping_cart_id')->references('id')->on('shopping_carts');
            $table->string("line1")->nullable(true);
            $table->string("line2")->nullable(true);
            $table->string("telefono");
            $table->string("direccion");
            $table->string("barrio");
            $table->string("ciudad");
            $table->string("pais");
            $table->string("departamento");
            $table->string("nombre_recibe");
            $table->string("email");
            $table->string("status")->default("creado");
            $table->string("numero_guia")->nullable(true);
            $table->string("total");
            $table->integer("respuestavajilla")->unsigned()->default("0");
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
        Schema::dropIfExists('orders');
    }
}
