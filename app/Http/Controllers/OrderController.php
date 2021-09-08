<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Order;

use DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct(){
        $this->middleware("auth");      //Solo van a poder abrir ordenes quienes esten con sesion iniciada
        $this->middleware('roles:0');       //Se listan los roles que tienen acceso a usuarios
    }


    public function index()
    {
        $orders = Order::select('orders.id','orders.status', 'orders.direccion', 'orders.nombre_recibe', 'shopping_carts.tipo', 'orders.created_at', 'orders.total'
        , 'orders.shopping_cart_id', 'orders.numero_guia')
        ->where('orders.empresa_id', '=', auth()->user()->empresa_id)
        ->leftjoin("shopping_carts", "shopping_carts.id" , "orders.shopping_cart_id")
        ->where('orders.status', '<>', 'creado')
        ->ultimos()
        ->get();

        
        //dd(DB::getQueryLog());
        //dd($orders);
        //dd(auth()->user()->empresa_id);
        $totalMes = Order::where('empresa_id', '=', auth()->user()->empresa_id)
            ->totalmes2();


        $totalMesContar = Order::where('empresa_id', '=', auth()->user()->empresa_id)
            ->totalMesContar2();
        

        return view('orders.index', ['orders' => $orders, 'totalmes' => $totalMes, 'transacciones' => $totalMesContar ]);
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
        //dd($request->name);
        $order = Order::find($id);
        $field = $request->name;
        // $order->status ='recibido';
        $order->$field = $request->value;
        $order->save();
        

        
         
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
