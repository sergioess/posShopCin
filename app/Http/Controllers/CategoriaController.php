<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Favorito;
use App\Articulo;
use App\InShoppingCart;
use App\ShoppingCart;

class CategoriaController extends Controller
{

    public function __construct(){
        $this->middleware("auth");      //Solo van a poder abrir ordenes quienes esten con sesion iniciada
        
        $this->middleware("shoppingcart"); 
        //$this->middleware('preventBackHistory'); 
       
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // $shopping_cart_id = \Session::get('shopping_cart_id');
        // $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);
        $shopping_cart = $request->shopping_cart;



        //Si se da el botón atras y siguen agregando articulos
        if($shopping_cart->status == 'Aprobado'){
            \Session::remove("shopping_cart_id");
            return redirect('/logout');
        }

        $favoritos = Favorito::all()
        ->where('visibleweb','T')
        ->where('empresa_id',$shopping_cart->empresa_id)
        ->sortBy("orden");                     //Con eloquent

        return view('categorias.index', ["favoritos" => $favoritos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($codfavorito, Request $request)
    {

        // $shopping_cart_id = \Session::get('shopping_cart_id');
        // $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);
        $shopping_cart = $request->shopping_cart;

        //Si se da el botón atras y siguen agregando articulos
        if($shopping_cart->status == 'Aprobado'){
            \Session::remove("shopping_cart_id");
            return redirect('/logout');
        }


        //dd($codfavorito);
        $favorito = Favorito::where('id', '=', $codfavorito)
            ->where('empresa_id', '=', $shopping_cart->empresa_id)->first();
        //dd($favorito);
        $articulos = Articulo::all()
        ->where('favorito',$codfavorito)
        ->where('empresa_id',$shopping_cart->empresa_id)
        ->where('habilitado', 1)
        ->sortBy("descripcion");                     //Con eloquent

        return view('categorias.show', ["articulos" => $articulos, 'favorito' => $favorito]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //sdd($request);
        $favorito = Favorito::find($id);

        $field = $request->name;
        $favorito->$field = $request->value;
        $favorito->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
