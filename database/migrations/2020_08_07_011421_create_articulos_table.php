<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->integer("empresa_id")->unsigned();      //se asigna el id de la empresa
            $table->integer('codarticulo')->unique();
            $table->string('referencia');
            $table->string('descripcion');
            $table->string('dpto');
            $table->string('seccion');
            $table->string('medida');
            $table->string('imagen');
            $table->double('precio');
            $table->double('impto');                        //porcentaje de impuesto
            $table->integer('favorito');                    //codigo de la clasificacion
            $table->integer('habilitado');                  //1:habilitado para ver , 0: no se muestra en el listado no esta disponible
            $table->text("descripcion2")->nullable();
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
        Schema::dropIfExists('articulos');
    }
}
