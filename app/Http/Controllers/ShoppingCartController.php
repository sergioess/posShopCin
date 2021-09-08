<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\ShoppingCart;
use App\InShoppingCart;
use App\AdicionalesArticulo;
use App\Articulo;
use App\Empresa;

use DB;

//use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCreated;

class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct(){
        $this->middleware("shoppingcart");      //Solo van a poder abrir ordenes quienes esten con sesion iniciada
    }
    


    public function index(Request $request)
    {

        


        

        // $shopping_cart_id = \Session::get('shopping_cart_id');

        // $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);

        //Remplaza las dos lineas anteriores
        $shopping_cart = $request->shopping_cart;





        //$total = $shopping_cart->total();

        //Total del Carrito
        // $total = InShoppingCart::leftJoin('articulos', 'articulos.id', '=', 'in_shopping_carts.articulo_id')
        // ->where('in_shopping_carts.shopping_cart_id',"=" ,$shopping_cart->id)
        // ->sum(DB::raw('articulos.precio * in_shopping_carts.cantidad'));


         $total = InShoppingCart::where('in_shopping_carts.shopping_cart_id',"=" ,$shopping_cart->id)
         ->sum(DB::raw('in_shopping_carts.precio * in_shopping_carts.cantidad'));        
        //dd($total);

        //Articulos agregados al carrito
        $articulos = ShoppingCart::select('in_shopping_carts.id as cod', 'articulos.descripcion', 'articulos.precio', 'articulos.id as artid', 'in_shopping_carts.id as innshop_id'
        , 'in_shopping_carts.cantidad')
        ->leftjoin('in_shopping_carts', 'in_shopping_carts.shopping_cart_id', '=', 'shopping_carts.id')
        ->leftJoin('articulos', 'articulos.id', '=', 'in_shopping_carts.articulo_id')
        ->where('shopping_carts.id',$shopping_cart->id)
        ->get();

        //Trae los adicionales para mostrarlos
        //1. Articulos del Carrito
        $ptosCarrito = InShoppingCart::select('in_shopping_carts.articulo_id')
        ->where('shopping_cart_id', '=', $shopping_cart->id)->get();

        //dd($ptosCarrito->toArray());

        //2. Articulos adicionales asignados al carrito
        $articuloIn = AdicionalesArticulo::select('adicionales_articulos.adiciona_articulo_id as id')
        ->distinct('adicionales_articulos.adiciona_articulo_id')
        ->whereIn('adicionales_articulos.articulo_id', $ptosCarrito)->get();
        //dd($articuloIn->toArray());

        //3. Datos del articulo
        $articulosAdicionales = Articulo::select('articulos.id', 'articulos.descripcion', 'articulos.precio', 'articulos.imagen', 'articulos.impto')
        ->whereIn('id',  $articuloIn->toArray())
        ->get();
        //dd($articulosAdicionales);
        

        $empresa = Empresa::find($shopping_cart->empresa_id);

        return view('shoppingcarts.index', ['articulos' => $articulos, 'total' => $total, 'shopping_cart' => $shopping_cart, 'articulosAdicionaes' => $articulosAdicionales
        , 'empresa' => $empresa,'StatusPasarela' => "NADA" ]);

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
        
    }



    public function datosEntrega(Request $request)
    {


        $shopping_cart_id = \Session::get('shopping_cart_id');
        $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);

        $empresa = Empresa::find($shopping_cart->empresa_id);

        $total = InShoppingCart::where('in_shopping_carts.shopping_cart_id',"=" ,$shopping_cart->id)
        ->sum(DB::raw('in_shopping_carts.precio * in_shopping_carts.cantidad')); 

        //dd($shopping_cart);

        return view('shoppingcarts.datosentrega', ['shopping_cart' => $shopping_cart, 'empresa' => $empresa, 'total' => $total ]);
    }


}
