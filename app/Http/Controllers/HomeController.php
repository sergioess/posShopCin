<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;

use Cookie;
use App\ShoppingCart;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //return view('home');
        $idcompany = $_COOKIE["idcompany"] ;

        //dd($idcompany);
        $shopping_cart_id = \Session::get('shopping_cart_id');
        $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);

        $response = ShoppingCart::where('id', $shopping_cart_id)
        ->update(['tipo' => '-', 'empresa_id' => $idcompany, 'user_id' => auth()->user()->id]);
        //dd($response);
        if($response){
            return redirect('/categorias');
        }


    }


    public function inicia()
    {
        return view('home');
    }

}
