<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEncuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encuestas', function (Blueprint $table) {
            $table->increments("id");
            $table->string("nombre");
            $table->string("email");
            $table->string("contacto")->default("no");   
            $table->string("fiebre")->default("no");            
            $table->string("tos")->default("no");            
            $table->string("dificultad")->default("no");            
            $table->string("fatiga")->default("no");            
            $table->string("dolor")->default("no");            
            $table->string("gusto")->default("no");   
            $table->integer("empresa_id")->unsigned();           
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
        Schema::dropIfExists('encuestas');
    }
}
