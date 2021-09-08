@extends('layouts.app')


@section('content')
    <br>
    <br>
    <header class="big-padding text-center blue-grey white-text">
        <h1>Pedido Finalizado</h1>

    </header>

    @if($order->direccion != "0")
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card large-padding">

                        <table class="table table-responsibe">
                            <tr class="text-center">
                                <td colspan="2">
                                    {{-- <h3>Pago Procesado <span class="{{ $order->status }}"> {{ $order->status }}</span></h3> --}}
                                    <h5><p>Verifica los datos de Tu entrega</p></h5>
                                    
                                </td>
                            </tr>

                            <tr>
                                <td>Nombre Recibe:</td>
                                <td>{{ $order->nombre_recibe }}</td>
                            </tr>

                            <tr>
                                <td>Correo</td>
                                <td>{{ $order->email }}</td>
                            </tr>



                            <tr>
                                <td>Dirección</td>
                                <td>{{ $order->direccion }}</td>
                            </tr>
                            <tr>
                                <td>Barrio</td>
                                <td>{{ $order->barrio }}</td>
                            </tr>

                        



                            <tr>
                                <td>Ciudad</td>
                                <td>{{ $order->ciudad }}</td>
                            </tr>
{{--  
                            <tr>
                                <td>Departamento</td>
                                <td>{{ "$order->departamento $order->pais" }}</td>
                            </tr>  --}}


                        </table>
                        <div class="text-center">
                            <a href="{{ url('/logout') }}" class="btn btn-primary nav-link">Volver a Comprar</a>

        

                        </div>
                    </div>
                </div>
            </div>

        </div>
    @else
    <div class="container">
        <div class="row  justify-content-center">
            <div class="text-center col-11 col-md-6">
                <a href="{{ url('/logout') }}" class="btn btn-primary nav-link">Volver a Comprar</a>
        
        
        
            </div>
        </div>

    </div>

    @endif
    <br>
    <br>
    <br>

@endsection
