<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reservas';


    //Los scope se enlazan
    public function scopeUltimos($query){
        return $query->ordenadoID()->delmes();
    }

    public function scopeOrdenadoID($query){
        return $query->orderBy('reservas.id', 'desc');
    }

    public function scopeTotalMesContar2($query){
        return $query->delmes()->count();
    }

    public function scopeDelmes($query){
        return $query->whereMonth('reservas.created_at', '=', date('m'));
    }




}
