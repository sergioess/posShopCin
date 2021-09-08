<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InShoppingCart;
use App\ShoppingCart;

class EnMesaController extends Controller
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
        $shopping_cart_id = \Session::get('shopping_cart_id');

        $response = ShoppingCart::where('id', $shopping_cart_id)
          ->update(['tipo' => 'Mesa', 'empresa_id' => $request->empresa_id, 'user_id' => auth()->user()->id]);

        if($response==1){
            return redirect('/datosentrega');
        }else{
            return back();
        }        

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
