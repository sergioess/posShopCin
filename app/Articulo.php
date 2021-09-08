<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table = 'articulos';			//para asignar el nombre de la tabla de forma manual

    protected $fillable = ['codarticulo', 'referencia' ,'descripcion', 'precio', 'descripcion2', 'dpto', 'seccion', 'imagen', 'impto', 'favorito', 'habilitado'
                            ,'empresa_id'];
}
