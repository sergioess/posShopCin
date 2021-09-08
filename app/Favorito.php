<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    protected $table = 'favoritos';	
    protected $fillable = ['descripcion', 'visibleweb', 'empresa_id', 'imagen', 'tipo'];
}

