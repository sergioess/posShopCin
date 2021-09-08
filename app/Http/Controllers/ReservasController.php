<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Reserva;
use URL;

class ReservasController extends Controller
{



    function __construct()
    {

        // $this->middleware('auth',['except' => ['/','create','saludo','store','mensajes']]);
        $this->middleware('auth',['except' => ['/']]);
        $this->middleware('roles:0');       //Se listan los roles que tienen acceso a usuarios

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //número de empresa
        $empresa_id = substr(URL::asset("/"),strlen(URL::asset("/")) - 5,4);
        $empresa_id = number_format($empresa_id, 0);

        //filtra las reservas de la empresa
        $reservas = Reserva::select('reservas.id as idreserva', 'users.name','reservas.fecha','reservas.hora','reservas.comensales','reservas.observacion')
        ->leftjoin("users", "users.id" , "reservas.user_id")
        ->where('reservas.empresa_id', '=', $empresa_id)
        ->ultimos()
        ->get();


        $totalMesContar = Reserva::leftjoin("users", "users.id" , "reservas.user_id")
        ->where('reservas.empresa_id', '=', $empresa_id)
        ->ultimos()
        ->totalMesContar2();
        
        //dd($reservas);
        return view('reservas.index', ['reservas' => $reservas , 'reservasCount' => $totalMesContar]);
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
