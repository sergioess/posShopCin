<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;

class EmpresaController extends Controller
{





    function __construct()
    {

        $this->middleware('roles:0');       //Se listan los roles que tienen acceso a usuarios

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(auth()->user()->empresa_id==50000)
        {
            $empresa = Empresa::all();
        }
        else
        {
            $empresa = Empresa::all()
            ->where("id", auth()->user()->empresa_id); 
        }

   
        //dd($empresa);
        return view('empresas.index', ["empresas" => $empresa]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('empresas.create');
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

            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telefono' => ['required', 'string'],
            'nit' => ['required', 'string'],
            'direccion' => ['required', 'string'],
            'barrio' => ['required', 'string'],
            'ciudad' => ['required', 'string'],
            'departamento' => ['required', 'string'],
            'pais' => ['required', 'string'],
        ]); 



        $empresa = new Empresa;
        $empresa->nombre = $request->input('nombre');
        $empresa->nombre_fiscal = $request->input('nombre_fiscal');
        $empresa->nit = $request->input('nit');
        $empresa->email = $request->input('email');
        $empresa->telefono = $request->input('telefono');
        $empresa->direccion = $request->input('direccion');
        $empresa->barrio = $request->input('barrio');
        $empresa->ciudad = $request->input('ciudad');
        $empresa->departamento = $request->input('departamento');
        $empresa->pais = $request->input('pais');
        $empresa->save();

      
       return redirect()->route('empresas.index');
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
        $empresa = Empresa::findOrFail($id);  //Con eloquent

        return view('empresas.edit', compact('empresa'));
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
        
         $this->validate($request, [

             'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
             'telefono' => ['required', 'string'],
             'direccion' => ['required', 'string'],
             'barrio' => ['required', 'string'],
             'ciudad' => ['required', 'string'],
             'departamento' => ['required', 'string'],
             'pais' => ['required', 'string'],
         ]); 

         //dd($request);
         

        $empresa = Empresa::find($id);

        $empresa->email = $request->input('email');
        $empresa->telefono = $request->input('telefono');
        $empresa->direccion = $request->input('direccion');
        $empresa->barrio = $request->input('barrio');
        $empresa->ciudad = $request->input('ciudad');
        $empresa->departamento = $request->input('departamento');
        $empresa->pais = $request->input('pais');
        $empresa->save();

       
        return redirect()->route('empresas.index');

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
