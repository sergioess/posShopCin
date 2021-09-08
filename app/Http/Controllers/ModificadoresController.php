<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Articulo;
use App\Modificador;
use App\AdicionalesArticulo;

class ModificadoresController extends Controller
{

    public function __construct(){
        $this->middleware("auth");     // Solo van a poder abrir ordenes quienes esten con sesion iniciada
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $modificador = new Modificador;
        $modificador->descripcion = $request->descripcion;
        $modificador->articulo_id = $request->articulo_id;
        $modificador->save();

        //return redirect()->route('modificadores.edit',['id' => $request->articulo_id ]);
        return back()->with('id', $request->articulo_id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Articulo::findOrFail($id);  //Con eloquent

        $modificadores = Modificador::where('articulo_id', '=', $id)
            ->get();

        $adicionales = AdicionalesArticulo::select('articulos.id as cod', 'articulos.descripcion as desarticulo', 'adicionales_articulos.id')
        ->leftjoin('articulos', 'articulos.id', '=', 'adicionales_articulos.adiciona_articulo_id')
        ->where('articulo_id', '=', $id)
        ->get();

        //dd($adicionales);

        $productos = Articulo::all()
        ->where('empresa_id',auth()->user()->empresa_id)
        ->sortBy("descripcion"); 

        return view('modificador.edit', ['producto' => $producto, 'modificadores' => $modificadores, 'productos' => $productos, 'adicionales' => $adicionales]);
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
        $modificadoresArticulos = Modificador::where('articulo_id','=', $request->adicional_articulo)
        ->get();
        //dd($producto);

        foreach ($modificadoresArticulos as $modArticulo)
        {
            $modificador = new Modificador;
            $modificador->descripcion = $modArticulo->descripcion;
            $modificador->articulo_id = $id;
            $modificador->save();
        }


        

        return back()->with('id', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Modificador::destroy($id);


        return back();
    }
}
