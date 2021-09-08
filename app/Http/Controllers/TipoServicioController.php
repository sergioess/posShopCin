<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\InShoppingCart;
use App\ShoppingCart;

class TipoServicioController extends Controller
{



    public function domicilio(Request $request)
    {

        $shopping_cart_id = \Session::get('shopping_cart_id');

        $response = ShoppingCart::where('id', $shopping_cart_id)
          ->update(['tipo' => 'Domicilio', 'empresa_id' => $request->empresa_id]);

        if($response==1){
            return redirect('/categorias');
        }else{
            return back();
        }        


        
    }


    public function enmesa()
    {

        $shopping_cart_id = \Session::get('shopping_cart_id');

        $response = ShoppingCart::where('id', $shopping_cart_id)
          ->update(['tipo' => 'Mesa']);

        if($response==1){
            return redirect('/categorias');
        }else{
            return back();
        }       
    }


    public function reserva()
    {

        $shopping_cart_id = \Session::get('shopping_cart_id');

        $response = ShoppingCart::where('id', $shopping_cart_id)
          ->update(['tipo' => 'Reserva']);

        if($response==1){
            return redirect('/articulos/1');
        }else{
            return back();
        }     
        
    }


}
