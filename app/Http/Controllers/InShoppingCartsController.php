<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InShoppingCart;
use App\ShoppingCart;
use App\ModinArticulo;

use DB;

class InShoppingCartsController extends Controller
{


    public function __construct(){
        $this->middleware("shoppingcart");      //Solo van a poder abrir ordenes quienes esten con sesion iniciada
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $shopping_cart_id = \Session::get('shopping_cart_id');

        // $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);

        $shopping_cart = $request->shopping_cart;

        
        //Si se da el botón atras y siguen agregando articulos
        if($shopping_cart->status == 'Aprobado'){
            \Session::remove("shopping_cart_id");
            return redirect('/logout');
        }

        //dd($request->cantidad * $request->price);
        $response = InShoppingCart::create([
            'articulo_id' => $request->articulo_id,
            'shopping_cart_id' => $shopping_cart->id,
            'cantidad' => $request->cantidad,
            'precio' => $request->price
        ]);

        if($response){
            if($request->shopp == "0")
            {
                return redirect('/categorias');
            }
            else
            {
                return redirect('/carrito');
            }
            
        }else{
            return back();
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod, Request $request)
    {
        //dd($cod);

        //Busca el carrito y elimina todos los modificadores guardados
        $carrito = InShoppingCart::find($cod);
        //dd($carrito);
        $modificador1 = ModinArticulo::where('shopping_cart_id', '=', $carrito->shopping_cart_id)
        ->where('articulo_id', '=', $carrito->articulo_id);

        $modificador1->delete();

        //Elimina el articulo del carrito
        InShoppingCart::destroy($cod);


        // $shopping_cart_id = \Session::get('shopping_cart_id');
        // $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);
        $shopping_cart = $request->shopping_cart;

        //$total = $shopping_cart->total();

        //dd($carrito);    
        $total = InShoppingCart::leftJoin('articulos', 'articulos.id', '=', 'in_shopping_carts.articulo_id')
        ->where('in_shopping_carts.shopping_cart_id',"=" ,$carrito->shopping_cart_id)
        ->sum(DB::raw('articulos.precio * in_shopping_carts.cantidad'));

        if($total)
        {
            return redirect("/carrito");
        }else{
            return redirect('/categorias');
        }

        
    }




    public function update($id,Request $request)
	{


        
        //dd($request);


        $in_shopping = InShoppingCart::find($id);

        $in_shopping->cantidad = $request->cantidad;
        $in_shopping->save();

        return redirect("/carrito");
    }


}
