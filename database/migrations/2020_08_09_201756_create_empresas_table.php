<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments("id");
            $table->string("nombre");
            $table->string("direccion");
            $table->string("nit");
            $table->string("telefono");
            $table->string("barrio");
            $table->string("ciudad");
            $table->string("departamento");
            $table->string("pais");
            $table->string("email");
            $table->string("nombre_fiscal"); 
            $table->integer("user_admin_id")->unsigned();           //Es el usuario que va a administrar y recibir notificaiones de los pedidos
            $table->integer("estado")->unsigned();
            $table->string("navvar");
            $table->integer("preguntavajilla")->default("0");  
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
        Schema::dropIfExists('empresas');
    }
}
