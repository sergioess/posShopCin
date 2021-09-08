<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ShoppingCart;
use App\Empresa;
use Cookie;
use Illuminate\Support\Facades\Auth;
use URL;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function home()
    {
        //dd(URL::asset("/"));

        if (Cookie::has('namecompany'))
        {
            //dd($_COOKIE["namecompany"]);
            //Cookie::queue(Cookie::forget('namecompany'));
        }

        //$empresa_id = ($_COOKIE["idcompany"]);
        $empresa_id = substr(URL::asset("/"),strlen(URL::asset("/")) - 5,4);
        $empresa_id = number_format($empresa_id, 0);
        //dd($empresa_id);
        $empresa = Empresa::where('id', $empresa_id)->first();    
        //dd($empresa->nombre);
        
        Cookie::queue("namecompany", $empresa->nombre);

        //dd($empresa);
        // $estadoEmpresa = "Activo";
        // if($empresa->estado==0)
        // {
        //     $estadoEmpresa = "Inactivo";
        // }
        //dd($estadoEmpresa);
        return view('main.home', ["empresa" => $empresa, 'estado' => $empresa->estado ]);
        
    }



}
