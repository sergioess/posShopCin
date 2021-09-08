<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use URL;
use App\Empresa;
use App\Encuesta;

class EncuestaSaludController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $empresa_id = substr(URL::asset("/"),strlen(URL::asset("/")) - 5,4);
        $empresa_id = number_format($empresa_id, 0);
        //dd($empresa_id);
        $empresa = Empresa::where('id', $empresa_id)->first();    

        return view('encuestas.create', ["empresa" => $empresa ]);
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
        $this->validate($request, [

            'email' => ['string', 'email', 'max:255'],
            'nombre' => ['required', 'string']
        ]); 



        $encuesta = new Encuesta;
        $encuesta->nombre = $request->nombre;
        $encuesta->email = $request->email;
        $encuesta->contacto = $request->contacto;
        $encuesta->fiebre = $request->fiebre;
        $encuesta->tos = $request->tos;
        $encuesta->dificultad = $request->dificultad;
        $encuesta->fatiga = $request->fatiga;
        $encuesta->dolor = $request->dolor;
        $encuesta->gusto = $request->gusto;
        $encuesta->empresa_id = $request->empresa_id;
        $encuesta->save();

      
        return redirect("/encuesta");
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
        //
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
