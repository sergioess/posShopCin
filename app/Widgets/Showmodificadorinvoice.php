<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

use App\Articulo;
use App\Modificador;
use App\ModinArticulo;
use App\ShoppingCart;

class Showmodificadorinvoice extends AbstractWidget
{
   /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'articulo_id' => 1, 
        'shopping_cart' => 2
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //
        //
        //dd($this->config['articulo_id']);
        $producto = Articulo::findOrFail($this->config['articulo_id']);  //Con eloquent
        //dd($producto);
        
        $modificadores = Modificador::where('articulo_id', '=', $this->config['articulo_id'])
            ->get();

        $modificadoresCount = Modificador::where('articulo_id', '=', $this->config['articulo_id'])
        ->count();

        //dd($modificadoresCount);
        $modificadoresArticulos = ModinArticulo::select('shopping_carts.id as shopping', 'articulos.descripcion as articulo', 'modificadors.descripcion as nommod'
        , 'modin_articulos.modificador_id as modinart')
        ->leftjoin('shopping_carts', 'modin_articulos.shopping_cart_id',  '=', 'shopping_carts.id')
        ->leftJoin('articulos', 'articulos.id', '=', 'modin_articulos.articulo_id')
        ->leftJoin('modificadors', 'modificadors.id', '=', 'modin_articulos.modificador_id')
        ->where('shopping_carts.id',$this->config['shopping_cart'])
        ->get();

        //dd($modificadoresArticulos);

        if($modificadoresCount>0)
        {
            return view('widgets.showmodificadorinvoice', [
                'articulo' => $producto,
                'modificadores' => $modificadores,
                'modarticulos' => $modificadoresArticulos,
                'shopping_cart_id' => $this->config['shopping_cart'],
                'articulo_id' => $this->config['articulo_id']
            ]);
        }
        else
        {
            return '';
        }

    }
}
