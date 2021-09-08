@extends('layouts.dashboard')


@section('tittle', 'Dashboard')

@section('content')

    {{--  {{ dd($orders) }}  --}}
<br><br>
    <div class="container ">

        <div class="panel panel-default">

            <div class="panel-heading p-3">

                <h2>Reservas</h2>
                
                    
            </div>
            
            <div class="panel-body white p-2 ">
                <hr>
                
                <h3 class="ml-1">Estadísticas</h3>
                
                <div class="row top-space">
                    <div class="sale-data ml-n3">

                    </div>

                    <div class="col-xs-6 col-md-4 col-lg-3 sale-data">
                        
                        <span>{{ $reservasCount }}</span>
                        Número de Reservas
                    </div>
                    
                </div>
                <br>
                <hr>

                <h3>Reservas</h3>
                 {{--  {{ dd($reservas) }}      --}}
                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Personas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservas as $reserva)
                      
                        <tr>
                            <td> {{ $reserva->idreserva }} </td>
                            <td> {{ $reserva->name }} </td>
                            <td> {{ $reserva->fecha }} </td>
                            <td> {{ substr($reserva->hora,11)  }} </td>

                            <td> {{ $reserva->comensales }} </td>
                                
                        </tr>
                        @if($reserva->observacion)
                            <tr>
                                <td colspan="1"></td>
                                <td colspan="4"> {{ $reserva->observacion }} </td>                                
                            </tr
                        @endif
                        {{--  <tr>
                            <th colspan="2"> Observacion:</td>

                        </tr>
                        <tr>
                            <th colspan="2"> $reserva->observacion</td>

                        </tr>  --}}
                    @endforeach

                    </tbody>
                </table>

            </div>
    
        </div>
    <div>

@endsection




