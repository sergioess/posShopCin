@extends('layouts.app')


@section('content')
    <br>
    <br>
    <header class="big-padding text-center blue-grey white-text">
        <h1>Reserva Enviada</h1>

    </header>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card large-padding">

                    <table class="table table-responsibe">


                        <tr>
                            <td>Id</td>
                            <td>{{ $shopping_cart->customid }}</td>
                        </tr>

                        <tr>
                            <td>Fecha</td>
                            <td>{{ $fecha }}</td>
                        </tr>

                        <tr>
                            <td>Hora</td>
                            <td>{{ $hora }}</td>
                        </tr>

                        <tr>
                            <td>Observacion</td>
                            <td>{{ $observa }}</td>
                        </tr>

                    </table>
                    <div class="text-center">
                        <a href="{{ url('/logout') }}" class="btn btn-primary nav-link">Volver a Inicio</a>

    

                    </div>
                </div>
            </div>
        </div>

    </div>

    <br>
    <br>
    <br>

@endsection
