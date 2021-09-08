<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ModinArticulo;
use DB;

class ModificadorUpdateController extends Controller
{

    public function __construct(){
        $this->middleware("auth");     // Solo van a poder abrir ordenes quienes esten con sesion iniciada
    }

    // public function addModificador( $articulo)
	// {

    //     $shopping_cart_id = \Session::get('shopping_cart_id');
    //     dd($shopping_cart_id);


    //         //crea
    // 		$modificador->shopping_cart_id = $shopping_cart_id;
    // 		$modificador->articulo_id = $articulo;
    // 		$modificador->modificador_id = $modificador;
    //         $modificador->save();
            

    //         $producto = new Articulo;
    //         $articulo = Articulo::find($id);
    //         $field = $request->name;
    //         $articulo->$field = $request->value;
    //         $articulo->save();



    // }

    public function update($id,Request $request)
	{

        // $shopping_cart_id, $articulo, $modificador
        $shopping_cart_id = \Session::get('shopping_cart_id');
        //dd($request);
        //dd($shopping_cart_id);
        //$articulo = 2179;
        $modificador = $request->modificador;
        //dd($id);


        // $field = $request->name;
        // $articulo->$field = $request->value;
        // $articulo->save();



          $modificador1 = ModinArticulo::where('shopping_cart_id', '=', $shopping_cart_id)
             ->where('articulo_id', '=', $id)
             ->where('modificador_id', '=', $modificador)->first();


            // $modificador1 = ModinArticulo::where('shopping_cart_id', '=', $shopping_cart_id)
            // ->where('articulo_id', '=', $id);

    	if ($modificador1)
    	 {
        //     //borra
            //dd($modificador1->id);
            $modificador1->delete();
            //ModinArticulo::destroy($modificador1->id);

    	 }
    	 else
    	 {
            //crea
            $modificador2 = new ModinArticulo;
    		$modificador2->shopping_cart_id = $shopping_cart_id;
    		$modificador2->articulo_id = $id;
    		$modificador2->modificador_id = $modificador;
    		$modificador2->save();
         }
         
         return back();
    }
}
