<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Articulo;
use App\ShoppingCart;
use App\Favorito;

class ArticulosController extends Controller
{
    public function __construct(){
        $this->middleware("auth");      //Solo van a poder abrir ordenes quienes esten con sesion iniciada
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articulos = Articulo::all()
        ->sortBy("descripcion");                     //Con eloquent

        return view('articulos.index', compact('articulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articulo = New Articulo;

        return view('articulos.create', ["articulo" => $articulo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $articulo = New Articulo;
        $articulo->codarticulo = $request->codarticulo;
        $articulo->referencia = $request->referencia;
        $articulo->descripcion = $request->descripcion;
        $articulo->precio = $request->precio;

        if ($articulo->save()){
            return redirect("/articulos");
        }else{
            return view("/articulos.create", ["articulo" => $articulo]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $shopping_cart_id = \Session::get('shopping_cart_id');
        $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);
        //Si se da el botón atras y siguen agregando articulos
        if($shopping_cart->status == 'Aprobado'){
            \Session::remove("shopping_cart_id");
            return redirect('/logout');
        }



        $articulo = Articulo::find($id);
        $favorito = Favorito::find($articulo->favorito);


        return view('articulos.show', ["articulo" => $articulo, 'favorito' => $favorito]);
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $articulo = Articulo::find($id);

        return view('articulos.edit', ["articulo" => $articulo]);
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
        $articulo = Articulo::find($id);
        $articulo->codarticulo = $request->codarticulo;
        $articulo->referencia = $request->referencia;
        $articulo->descripcion = $request->descripcion;
        $articulo->precio = $request->precio;

        if ($articulo->save()){
            return redirect("/articulos");
        }else{
            return view("/articulos.edit", ["articulo" => $articulo]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Articulo::destroy($id);
        return redirect("/articulos");
    }
}
