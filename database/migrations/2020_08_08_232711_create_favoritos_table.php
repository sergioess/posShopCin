<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favoritos', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("empresa_id")->unsigned();          //se asigna el id de la empresa
            $table->integer("codfavorito")->default(0);
            $table->string("descripcion");
            $table->string("visibleweb");                       //Visible o no-> T: es visivle  , F:no es visible
            $table->string('imagen');
            $table->integer("orden")->default(0);
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
        Schema::dropIfExists('favoritos');
    }
}
