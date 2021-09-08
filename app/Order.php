<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'orders';
    protected $fillable = ['shopping_cart_id', 'empresa_id', 'line1', 'line2', 'telefono', 'direccion', 'barrio', 'ciudad', 'pais', 'departamento', 'nombre_recibe'
    , 'email', 'total', 'mesa', 'respuestavajilla'];


    //Los scope se enlazan
    public function scopeUltimos($query){
        return $query->ordenadoID()->delmes();
    }

    public function scopeOrdenadoID($query){
        return $query->orderBy('orders.id', 'desc');
    }


    public function scopeDelmes($query){
        return $query->whereMonth('orders.created_at', '=', date('m'));
    }


    public static function totalMes(){
        return Order::Delmes()->sum('total');
    }

    public function scopeTotalmes2($query){
        return $query->delmes()->sum('total');
    }


    public static function totalMesContar(){
        return Order::Delmes()->count();

    }

    public function scopeTotalMesContar2($query){
        return $query->delmes()->count();
    }

    public static function createFromPayResponse($response, $shopping_cart)
    {
        //dd($response);

        return  Order::create([
            'shopping_cart_id' => $shopping_cart,
            'empresa_id' => $response->empresa_id,
            'line1' => $response->line1,
            'line2' => $response->line2,
            'telefono' => $response->shippinPhone,
            'direccion' => $response->shippinAddress,
            'barrio' => $response->shippinBarrio,
            'ciudad' => $response->shippinCity,
            'pais' => $response->shippinCountry,
            'departamento' => $response->shippinState,
            'nombre_recibe' => $response->buyerName,
            'email' => $response->buyerEmail,
            'numero_guia' => md5($response),
            'total' => $response->amount,
            'mesa' => $response->mesa,
            'respuestavajilla' => $response->respuestavajilla
        ]);

      

    }
}
