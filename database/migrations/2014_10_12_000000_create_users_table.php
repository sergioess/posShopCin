<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('barrio');
            $table->string('ciudad');
            $table->string('departamento');
            $table->string('pais');
            $table->string('documento');
            $table->integer('claseusr');                // Rol del usuario yo:0 con empresa_id=50000, Adminde empresa:0 con id_empresa > 0, Cliente:2 con empresa=0
            $table->longText('observacion');
            $table->integer('empresa_id');              //se guarda el id de la empresa cuando el usuario es admin y recibe notificaciones
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
