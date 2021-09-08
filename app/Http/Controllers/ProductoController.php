<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Producto;
use App\Medida;

use App\Favorito;
use App\Articulo;

use Carbon\Carbon;
use URL;

use Illuminate\Support\Str;



class ProductoController extends Controller
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
        
        $productos = Articulo::all()
        ->where('empresa_id',auth()->user()->empresa_id)
        ->sortBy("descripcion");                     //Con eloquent
        //dd($productos);
        
        $categorias = Favorito::all()
        ->where('empresa_id',auth()->user()->empresa_id)
        ->sortBy("descripcion");                     //Con eloquent

        
        return view('productos.index', compact('productos','categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return("Hey....");



        $medidas = Medida::all(); 
        $categorias = Favorito::all()
        ->where('empresa_id',auth()->user()->empresa_id)
        ->sortBy("descripcion");                     //Con eloquent                     //Con eloquent
        
        return view('productos.create', compact('medidas','categorias'));

    }


    public function create2($id)
    {
        return($id);
        //return view('productos.create', compact('cat'));
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

            'nombre' => 'required',
            'valor' => 'required',
            
            'categoria' => 'required',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024'
        ]); 

        //dd($request->imagen);

        // Check if a profile image has been uploaded
        if ($request->has('imagen')) {
            // Get image file
            $image = $request->file('imagen');

            // Make a image name based on user name and current timestamp
            $name = Str::slug(auth()->user()->empresa_id.'_'.$request->input('name')).'_'.time();
            $name2 = $name.'.'.$image->getClientOriginalExtension();
            // Define folder path
            
            //$folder = '/img/articulos';
            $folder = '/';
            $folder = substr(URL::asset("/storage/img/articulos"),35); 
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            //dd($filePath);
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);

       
            $producto = new Articulo;
            $producto->descripcion = $request->input('nombre');

            if ($request->descripcion)
            {
                $producto->descripcion2 = $request->input('descripcion');
            }
            

            $producto->codarticulo = 0;
            $producto->referencia = 'T-0001';
            $producto->dpto = 'GENERAL';
            $producto->seccion = 'GENERAL';
            $producto->precio = $request->input('valor');
            $producto->imagen = $name2;
            $producto->habilitado = '1';
            $producto->favorito = $request->input('categoria');
            $producto->medida = $request->input('idmedia');
            $producto->impto = 0;
            
            $producto->empresa_id = auth()->user()->empresa_id;
            //$producto->create_at = Carbon::now(),      //no es necesario crear los campos de fecha, se agregan automatico
            //$producto->updated_at = Carbon::now();      //no es necesario crear los campos de fecha, se agregan automatico
            $producto->save();

        }




        //REDIRECCINAR

        return redirect()->route('productos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return($id);
    }

    public function show2(Request $request)
    {
        //dd($request->categoria);

        $productos = Articulo::where('favorito', '=', $request->input('categoria'))
        ->where('empresa_id',auth()->user()->empresa_id)
        ->get();                     //Con eloquent
        $categorias = Favorito::all()
        ->where('empresa_id',auth()->user()->empresa_id)
        ->sortBy("descripcion");                     //Con eloquent  

        return view('productos.index', compact('productos', 'categorias'));
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

        return view('productos.edit', compact('producto'));
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
        //return "This is category edit page";

        DB::table('articulos')->where('id',$id)->update([
            "descripcion" => $request->input('nombre'),
            "precio" => $request->input('valor'),
            
            //"Link" => $request->input('Link'),
        ]);
            //dd( $request->file('imagen'));
            //dd($request->input('imagen'));
        if ($request->has('imagen')) {
            // Get image file
            $image = $request->file('imagen');

            // Make a image name based on user name and current timestamp
            $name = Str::slug(auth()->user()->empresa_id.'_'.$request->input('imagen')).'_'.time();
            $name2 = $name.'.'.$image->getClientOriginalExtension();
            // Define folder path
            
            //$folder = '/img/articulos';
            $folder = substr(URL::asset("/storage/img/articulos"),35); 
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            dd($filePath);
            $this->uploadOne($image, $folder, 'public', $name);

       


            DB::table('articulos')->where('id',$id)->update([
                "imagen" => $name2,
                ]);

        }
        else{
            DB::table('articulos')->where('id',$id)->update([
                "habilitado" => $request->input('Link'),
                "descripcion" => $request->input('nombre'),
                "precio" => $request->input('valor'),
                ]);       



        }




        //REDIRECCINAR

        //return("Hecho....");
        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //return("Hecho....$id");    


        DB::table('articulos')->where('id',$id)->delete();


        //REDIRECCINAR

        //return("Hecho....");
        return redirect()->route('productos.index');
    }
}
