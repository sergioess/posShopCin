<?php

namespace App;

use DB;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{

    protected $table = 'shopping_carts';

    //Mass assignment
    protected $fillable = ['status'];

    public function approve($customid, $idplataforma)
    {
        $this->updateCustomIDAndStatus($customid, $idplataforma);
    }



    public function generateCustomID()
    {
        $idorder= md5("$this->id $this->updated_at");
        $this->customid =$idorder;
        $this->save();
        return $idorder;

    }


    public function updateCustomIDAndStatus($customid, $idplataforma)
    {
        $this->status = "Aprobado";
        $this->customid = $customid;
        $this->enviado = $idplataforma;
        $this->save();

    }

    public function updateStatusEnPreparacion()
    {
        $this->status = "EnPreparacion";
        $this->save();

    }    


    //crear una relacion con inshoppincart
    public function inShoppingCarts(){
        return $this->hasMany('App\InShoppingCart');
    }
    //crear una relacion con inshoppincart
    public function articulos (){
        return $this->belongsToMany("App\Articulo",'in_shopping_carts');    //Primero la clase y luego la tabla con la que se relaciona
    }

    //Cantidad de Articulos en el carrito
    public function articulos_Size(){
        return $this->articulos->count();
    }

    public function total(){
        //dd($this->articulos);
        //return $this->articulos->sum('precio');

        return $this->articulos->sum(DB::raw('articulos.precio * in_shopping_carts.cantidad'));


        
    }

    public static function findOrCreateBySessionID($shopping_cart_id){
        if($shopping_cart_id)
        {
            //Buscar el carrito de compas con este ID
            return ShoppingCart::findBySession($shopping_cart_id);
        }
        else
        {
            //Crear un carrito de compras
            return ShoppingCart::createWithoutSession();
        }



    }


    public static function findBySession($shopping_cart_id){
        return ShoppingCart::find($shopping_cart_id);
    }

    public static function createWithoutSession(){

        return ShoppingCart::create([
            "status" => "incompleto"
        ]);

/*         $shopping_cart = new ShoppingCart;
        $shopping_cart->status = "incompleto";
        $shopping_cart->save();
        return $shopping_cart; */
    }



}
