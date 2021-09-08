<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Producto;
use App\Medida;

use App\Favorito;
use App\Articulo;

use Carbon\Carbon;
use URL;

use Illuminate\Support\Str;

class ProdCatController extends Controller
{

    use UploadTrait;


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

        //dd($request->file('imagen'));
        //dd($request);

        $this->validate($request, [

            'nombre' => 'required',
            'valor' => 'required',
            //'Link' => 'required',
            //'idcategoria' => 'required',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024'

        ]); 

        

        if ($request->has('imagen')) {
           // Get image file
           $image = $request->file('imagen');

           // Make a image name based on user name and current timestamp
           $name = Str::slug(auth()->user()->empresa_id.'_'.$request->input('name')).'_'.time();
           $name2 = $name.'.'.$image->getClientOriginalExtension();
           // Define folder path
           
           //$folder = '/img/articulos';
           $folder = substr(URL::asset("/storage/img/articulos"),35); 
           //dd($folder);
           // Make a file path where image will be stored [ folder path + file name + file extension]
           $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
           // Upload image
           $this->uploadOne($image, $folder, 'public', $name);

      
           $producto = new Articulo;
           $producto->descripcion = $request->input('nombre');
           $producto->codarticulo = 0;
           $producto->referencia = 'T-0001';
           $producto->dpto = 'GENERAL';
           $producto->seccion = 'GENERAL';
           $producto->precio = $request->input('valor');
           $producto->imagen = $name2;
           $producto->habilitado = '1';
           $producto->favorito = $request->input('idcategoria');
           $producto->medida = $request->input('idmedia');
           $producto->impto = 0;
           
           $producto->empresa_id = auth()->user()->empresa_id;
           //$producto->create_at = Carbon::now(),      //no es necesario crear los campos de fecha, se agregan automatico
           //$producto->updated_at = Carbon::now();      //no es necesario crear los campos de fecha, se agregan automatico
           $producto->save();
        }


        //Producto::create($request->all());
        //REDIRECCINAR

        //return("Hecho....");
        return redirect()->route('productos.index');

        //return($request);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return("Hey....");
        $medidas = Medida::all();                     //Con eloquent
        
        return view('prodcat.create', compact('id','medidas'));
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
        $articulo = Articulo::find($id);

        $field = $request->name;
        $articulo->$field = $request->value;
        $articulo->save();
          
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
