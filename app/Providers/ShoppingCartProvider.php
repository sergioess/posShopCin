<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\ShoppingCart;

use App\Empresa;
use URL;


class ShoppingCartProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
            //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer("*", function($view){
            $shopping_cart_id = \Session::get('shopping_cart_id');

            $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);
    
            \Session::put("shopping_cart_id", $shopping_cart->id);
            

            /////Mantiene el dato de la empresa
            $empresa_id = substr(URL::asset("/"),strlen(URL::asset("/")) - 5,4);
            $empresa_id = number_format($empresa_id, 0);
            //dd($empresa_id)
            $empresa = Empresa::where('id', $empresa_id)->first();    

            // $estadoEmpresa = "Activo";
            // if($empresa->estado==0)
            // {
            //     $estadoEmpresa = "Inactivo";
            // }
            //dd($estadoEmpresa);

            //$view->with("shopping_cart", $shopping_cart);
            //$view->with("articulosCount", $shopping_cart->articulos_Size() );
            $view->with("articulosCount", $shopping_cart->articulos_Size())
                    ->with('nombreEmpresa', $empresa->nombre )
                    ->with('empresa', $empresa )
                    ->with('estado', $empresa->estado)
                    ->with('tipoCarrito', $shopping_cart->tipo)
                    ->with('estadoOrd', $shopping_cart->status);

        });     //el * es para decir que aplica a todas las vistas
    }
}
