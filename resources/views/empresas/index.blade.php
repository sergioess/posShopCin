@extends('layouts.dashboard')

@section('content')
    <br>
    <br>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @if (Auth::user()->empresa_id == 50000)
                    <h1> <a href="{{ route('empresas.create') }}">
                    <button class="btn btn-xs btn-link"  data-toggle="tooltip"  title="Crear Empresa">
                        <i class="fa fa-plus-circle  fa-3x" aria-hidden="true"></i>
                    </button></a></h1>
                @endif

                <div class="panel p-3">
                    <div class="panel-heading">

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel bg-secondary">
                                        <div class="panel-heading p-2 text-white">
                                            <h5><strong>Datos de la Empresa</strong></h5>
                                        </div>
                                        @foreach ($empresas as $empresa)
                                            <div class="panel-body">
                                                <table style="text-transform: none;" class="table table-condensed">
                                                    <tbody>
                                                        <tr>
                                                            <th><strong>Empresa:</strong></th>
                                                            <td>{{ $empresa->nombre }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th><strong>Nombre Fiscal:</strong></th>
                                                            <td>{{ $empresa->nombre_fiscal }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th><strong>NIT:</strong></th>
                                                            <td>{{ $empresa->nit }}</td>
                                                        </tr>                                                    
                                                        <tr>
                                                            <th><strong>Email:</strong></th>
                                                            <td>{{ $empresa->email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th><strong>Teléfono:</strong></th>
                                                            <td>{{ $empresa->telefono }}</td>
                                                        </tr>
                                                        <!-- empresa -->
                                                        <tr>
                                                            <th><strong>Dirección:</strong></th>
                                                            <td>{{ $empresa->direccion.' - '.$empresa->barrio }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th><strong>Ciudad:</strong></th>
                                                            <td>{{ $empresa->ciudad.' - '.$empresa->departamento.' - '.$empresa->pais }}</td>
                                                        </tr>


                                                    </tbody>
                                                </table>
                                            </div>
                                            <div id="toolbar-table">
                                                <div class="tab-pane active" >
                                                    
                                                    <a href="{{ route('empresas.edit', $empresa->id) }}" class="btn btn-info btn-embossed" title="Editar Datos Empresa">
                                                        <i class="fas fa-edit  fa-1x">&nbsp;</i>Editar
                                                    </a>

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                
                            </div>
                
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
