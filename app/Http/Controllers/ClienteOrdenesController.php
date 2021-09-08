<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ShoppingCart;
use URL;

class ClienteOrdenesController extends Controller
{

    public function __construct(){
        $this->middleware("auth");      //Solo van a poder abrir ordenes quienes esten con sesion iniciada
        $this->middleware("shoppingcart");      
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Código de empresa
        $empresa_id = substr(URL::asset("/"),strlen(URL::asset("/")) - 5,4);
        $empresa_id = number_format($empresa_id, 0);

        $orders = ShoppingCart::select('shopping_carts.id as idShop','orders.created_at as fecha', 'shopping_carts.tipo', 'orders.total', 'orders.status', 'orders.updated_at as actualizado')
        ->leftjoin("orders", "shopping_carts.id" , "orders.shopping_cart_id")
        ->where('shopping_carts.status', '<>', 'incompleto')
        ->where('shopping_carts.tipo', '<>', 'Reserva')
        ->where('shopping_carts.user_id', '=', auth()->user()->id)
        ->where('shopping_carts.empresa_id', '=', $empresa_id)
        ->orderBy('orders.created_at', 'desc')
        ->limit(10)
        ->get();

        
        //dd(DB::getQueryLog());
        //dd($orders);
        //dd(auth()->user()->empresa_id);

        

        return view('ordenclientes.index', ['orders' => $orders]);
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
