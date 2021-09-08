<?php

namespace App\View\Components;

use Illuminate\View\Component;



class showModificador extends Component
{
      public  $articulo_id;
      public  $shopping_cart_id;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $articulo_id = 'diez' , string $shopping_cart_id = '0')
    {
          $this->articulo_id = $articulo_id;
          $this->shopping_cart_id = $shopping_cart_id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        //  dd(ucfirst($this->articulo_id));

        // $producto = Articulo::findOrFail($articulo_id);  //Con eloquent

        
        // $modificadores = Modificador::where('articulo_id', '=', $shopping_cart_id)
        //     ->get();

        
        // $modificadoresArticulos = ModinArticulo::select('shopping_carts.id as shopping', 'articulos.descripcion as articulo', 'modificadors.descripcion as nommod')
        // ->leftjoin('shopping_carts', 'modin_articulos.shopping_cart_id',  '=', 'shopping_carts.id')
        // ->leftJoin('articulos', 'articulos.id', '=', 'modin_articulos.articulo_id')
        // ->leftJoin('modificadors', 'modificadors.id', '=', 'modin_articulos.modificador_id')
        // ->where('shopping_carts.id',$shopping_cart_id)
        // ->get();

        // return view('components.show-modificador', [
        //     'articulo' => $producto,
        //     'modificadores' => $modificadores,
        //     'modarticulo' => modificadoresArticulos
        // ]);



        return view('components.show-modificador');
    }
}
