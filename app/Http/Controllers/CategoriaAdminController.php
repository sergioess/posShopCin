<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Favorito;
use App\Articulo;

use Carbon\Carbon;

use Illuminate\Support\Str;


class CategoriaAdminController extends Controller
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
 
         $query = DB::table('favoritos')->where('empresa_id',auth()->user()->empresa_id);
         $categorias = $query->orderBy('visibleweb', 'desc')->orderBy('descripcion', 'ASC')->get();
        
        // $i=0;
        // foreach($fechas as $row) {
        //     $data[0] = array ('fecha'=>$row->fecha2);
                 
        //     $i++;
        // }  

        
        // $categorias = Favorito::all()
        // ->where('empresa_id',auth()->user()->empresa_id)
        // ->;         
                    //Con eloquent


                    // $categorias = Favorito::all()
                    // ->where('empresa_id',auth()->user()->empresa_id)
                    // ->sortBy("descripcion");         
                                //Con eloquent

        return view('categoriasadmin.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categoriasadmin.create');
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

            'descripcion' => 'required',
            //'visibleweb' => 'required|max:1',
            // 'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024'
        ]); 

        //dd($request);


        // Check if a profile image has been uploaded
        if ($request->has('imagen')) {
            // Get image file
            $image = $request->file('imagen');

            // Make a image name based on user name and current timestamp
            $name = Str::slug('cat'.$request->input('name')).'_'.time();
            $name2 = $name.'.'.$image->getClientOriginalExtension();
            //$name = $request->input('imagen');
            // Define folder path
            $folder = '/menu';
            $folder = substr(URL::asset("/storage/img/menu"),35); 
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);

            
        }

        

        $elMaximo = Favorito::where('empresa_id',auth()->user()->empresa_id)
        ->max('codfavorito');

        $elMaximo += 1;
        //dd($elMaximo);

        $categoria = new Favorito;
        $categoria->descripcion = $request->input('descripcion');
        $categoria->visibleweb = 'T';
        $categoria->codfavorito = $elMaximo;
        //$categoria->imagen = $name2;
        $categoria->empresa_id = auth()->user()->empresa_id;
        //$message->create_at = Carbon::now(),      //no es necesario crear los campos de fecha, se agregan automatico
        //$message->updated_at = Carbon::now()      //no es necesario crear los campos de fecha, se agregan automatico
        $categoria->save();

        //Producto::create($request->all());
        //REDIRECCINAR

        //return("Hecho....");
        return redirect()->route('categoriasadmin.index');

        //return($request->input('imagen'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = Favorito::findOrFail($id);  //Con eloquent
        return view('categoriasadmin.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Id)
    {

        DB::table('favoritos')->where('Id',$Id)->update([
            "descripcion" => $request->input('nombre')
            // "visibleweb" => $request->input('tipo'),
            // "imagen" => $request->input('imagen')
        ]);


        //REDIRECCINAR

        //return("Hecho....");
        return redirect()->route('categoriasadmin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('favoritos')->where('Id',$id)->delete();


        //REDIRECCINAR

        //return("Hecho....");
        return redirect()->route('categoriasadmin.index');
    }


    public function traslate()
    {

        $empresa2 = 2;
            
        $favsEmpresa1 =  Favorito::whereIn('id', array(85,86,87,88,89,90,92))
        ->where('empresa_id', '=', '1')
        ->get();
        //dd($favsEmpresa1);


        foreach ($favsEmpresa1 as $fav)
        {
            //dd($fav);

            $articulosFav = Articulo::where('favorito', '=', $fav->id)->get();
            //dd($articulosFav);

            $nuevofav =  Favorito::create([
                "codfavorito" => 22,
                "descripcion" => $fav->descripcion,
                "visibleweb" => 'T',
                "empresa_id" => $empresa2,
                "imagen" => $fav->imagen,
                "tipo" => 'P'
            ]);
            //dd($nuevofav);
            
            foreach ($articulosFav as $artnew)
            {
                Articulo::create([
                    "codarticulo" => 0,
                    "referencia" => "T-0001",
                    "descripcion" => $artnew->descripcion,
                    "dpto" => "GENERAL",
                    "seccion" => "GENERAL",
                    "imagen" => $artnew->imagen,
                    "precio" => $artnew->precio,
                    "impto" => 0.0,
                    "favorito" => $nuevofav->id,
                    "habilitado" => 1,
                    "empresa_id" => $empresa2,
                    "descripcion2" => $artnew->descripcion2,
                ]);
            }


        }
    }

}
