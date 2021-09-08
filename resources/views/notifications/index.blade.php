@extends('layouts.dashboard')

@section('content')

    <div class="container ">
        <br>
        <br>


        {{-- {{ dd($articulos)}} --}}

        <div class="row justify-content-center">
            <div class="col-md-12">
                @if ($vista == '1')
                    <header class="p-1 text-center blue-grey white-text">

                        @if ($shopping_cart->tipo != 'Reserva')
                            <h1>Pedidos Nuevos</h1>
                        @else
                            <h1>Reserva Nueva</h1>
                        @endif

                    </header>
                    <div class="card">

                        <div class="card-header text-center">

                            @if ($shopping_cart->tipo != 'Reserva')

                                @if ($shopping_cart->tipo == 'Mesa')

                                    <h2>Tu Pedido para {{ $shopping_cart->tipo }} {{ $order->mesa }}</h2>
                                @else
                                    <h2>Tu Pedido para {{ $shopping_cart->tipo }}</h2>
                                @endif
                            @else
                                <h2>Datos de la Reserva</h2>
                            @endif
                        </div>

                        <div class="card-body ">


                            <table style="text-transform: none;" class="table table-condensed">
                                <tbody>
                                    <tr>
                                        <th><strong>Pedido ID:</strong></th>
                                        <td>{{ $shopping_cart->customid }}</td>
                                    </tr>
                                    <tr>
                                        <th><strong>Nombre:</strong></th>
                                        <td>{{ $order->nombre_recibe }}</td>
                                    </tr>


                                    @if ($shopping_cart->tipo != 'Reserva')

                                        @if ($shopping_cart->tipo == 'Domicilio')
                                            <tr>
                                                <th><strong>Teléfono:</strong></th>
                                                <td>{{ $order->email }}</td>
                                            </tr>
                                            <tr>
                                                <th><strong>Teléfono:</strong></th>
                                                <td>{{ $order->telefono }}</td>
                                            </tr>
                                            <tr>
                                                <th><strong>Dirección:</strong></th>
                                                <td>{{ $order->direccion }}</td>
                                            </tr>
                                            <tr>
                                                <th><strong>Barrio</strong></th>
                                                <td>{{ $order->barrio }}</td>
                                            </tr>
                                            <tr>
                                                <th><strong>Ciudad</strong></th>
                                                <td>{{ $order->ciudad . ' - ' . $order->departamento . ' - ' . $order->pais }}
                                                </td>
                                            </tr>

                                        @endif
                                        <tr>
                                            <th><strong>Observaciones</strong></th>
                                            <td>{{ $order->line1 }}</td>
                                        </tr>

                                        @if ($shopping_cart->tipo == 'Mesa')
                                            @if ($empresa->preguntavajilla == 1)
                                                <tr>
                                                    <th><strong>Servicio con:</strong></th>
                                                    @if ($order->respuestavajilla == '1')
                                                        <td>Desechable</td>
                                                    @else
                                                        <td>Vajilla</td>
                                                    @endif
                                                </tr>
                                            @endif
                                        @endif

                                        @if ($shopping_cart->enviado == 1)
                                            <tr>
                                                <th><strong>Forma de Pago</strong></th>

                                                <td>Efectivo</td>

                                            </tr>
                                        @else
                                            <tr>
                                                <th><strong>Forma de Pago</strong></th>

                                                <td>Credibanco - {{ $pagos->paymentState }} -
                                                    {{ $pagos->approvalCode }} -
                                                    {{ number_format($pagos->depositedAmount, 0) }}</td>

                                            </tr>
                                        @endif

                                    @else
                                        <tr>
                                            <th><strong>Teléfono:</strong></th>
                                            <td>{{ $comprador->telefono }}</td>
                                        </tr>
                                        <tr>
                                            <th><strong>Dirección:</strong></th>
                                            <td>{{ $comprador->direccion }}</td>
                                        </tr>
                                        <tr>
                                            <th><strong>Barrio</strong></th>
                                            <td>{{ $comprador->barrio }}</td>
                                        </tr>
                                        <tr>
                                            <th><strong>Ciudad</strong></th>
                                            <td>{{ $comprador->ciudad . ' - ' . $comprador->departamento . ' - ' . $comprador->pais }}
                                            </td>
                                        </tr>
                                    @endif



                                </tbody>
                            </table>


                            @if ($shopping_cart->tipo != 'Reserva')
                                <div class="w-100 h-25" style="background-color: #252020;">
                                    <hr>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <td>Cant</td>
                                                <td>Artículo</td>
                                                <td style="text-align:right">Precio</td>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($articulos as $articulo)
                                                {{-- {{dd($articulo)}} --}}
                                                <tr>
                                                    <td> <span class="fs-sm-2-0">{{ $articulo->cantidad }}</span>
                                                    </td>
                                                    <td> {{ $articulo->descripcion }} </td>
                                                    <td style="text-align:right"> $
                                                        {{ number_format($articulo->precio * $articulo->cantidad, 0) }}
                                                    </td>

                                                </tr>
                                                {{-- @widget('showModificadoresInvoice', ['articulo_id' => $articulo->codart  , 'shopping_cart' => $shopping_cart->id ] ) --}}
                                                @widget('showmodificadorinvoice', ['articulo_id' => $articulo->codart ,
                                                'shopping_cart' => $shopping_cart->id ] )

                                            @endforeach
                                            <tr>
                                                <td colspan="1">
                                                    <h4>Total</h4>
                                                </td>
                                                <td colspan="2" style="text-align:right">
                                                    <h4>$ {{ number_format($total, 0) }}</h4>
                                                </td>

                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            @else


                                <div class="w-100 " style="background-color: #252020; height:10px">
                                    <hr>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover">

                                        <tbody>
                                            {{-- @foreach ($reservas as $reserva) --}}

                                            <tr>
                                                <th>Fecha</th>
                                                <td>{{ $reservas->fecha }}</td>
                                            </tr>

                                            <tr>
                                                <th>Hora</th>
                                                <td>{{ substr($reservas->hora, 11, 5) }} </td>
                                            </tr>

                                            <tr>
                                                <th>Personas</th>
                                                <td>{{ $reservas->comensales }} </td>
                                            </tr>

                                            <tr>
                                                <th>Observaciones</th>
                                                <td>{{ $reservas->observacion }} </td>
                                            </tr>

                                            {{-- @endforeach --}}


                                        </tbody>
                                    </table>
                                </div>



                            @endif



                        </div>




                        <div class="card-footer  text-center" style="background-color: white;">
                            <div class="form-group text-center">


                                @if ($shopping_cart->tipo != 'Reserva')
                                    <a class="btn btn-primary white-text" class="tooltip-test" target="_blank"
                                        title="Imprimir" href="{{ route('notifications.show', $shopping_cart->id) }}">
                                        <h5><i class="fas fa-print"></i> Imprimir Pedido</h5>
                                    </a>
                                @endif



                                {{-- {{dd($receptor_id)}} --}}
                                <form class="no-padding" id="logout-formw" method="POST"
                                    action="{{ route('notifications.store') }}">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="notificacion_id" value="{{ $id_notificacion }}">
                                    <input type="hidden" name="shopping_cart_id" value="{{ $shopping_cart->id }}">
                                    <input type="hidden" name="shopping_cart_tipo" value="{{ $shopping_cart->tipo }}">
                                    <input type="hidden" name="sender_id" value="{{ $comprador->id }}">
                                    <input type="hidden" name="recipient_id" value="{{ $receptor_id }}">
                                    <input type="hidden" name="empresa_id" value="{{ $shopping_cart->empresa_id }}">

                                    <a class="btn btn-secondary white-text" class="tooltip-test" title="Aceptar Pedido"
                                        onclick="document.getElementById('logout-formw').submit();">
                                        <h5><i class="far fa-check-circle"></i> Confirmar</h5>
                                    </a>
                                    <br>


                                </form>

                            </div>

                        </div>

                    @else
                        <div class="card">
                            <div class="card-body ">
                                <h3>Sin Notificaciones Nuevas</h3>
                            </div>
                        </div>
                @endif

            </div>
        </div>


    </div>
    <br>
    <br>
@endsection
