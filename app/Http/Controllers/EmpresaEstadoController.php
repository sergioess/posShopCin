<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;

class EmpresaEstadoController extends Controller
{


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //edita el estado de la empresa Activo o Inactivo

        $empresa = Empresa::find($id);

        //dd($id);
        $field = $request->name;
        $empresa->$field = $request->value;
        $empresa->save();
    }


}
