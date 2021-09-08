<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Google Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">

        <!-- Bootstrap core CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/css/material-fullpalette.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/css/ripples.min.css" rel="stylesheet">


        


    </head>
    <body onload="window.print()">
        <div id="app" >

            <div class="row">
                <div class="col-5">
            
                    <table  class="table  table-borderless">
                        <tbody>
                            <tr>
                                @if($shopping_cart->tipo == "Mesa")

                                
                                    <th colspan="2"><strong><h2>Tu Pedido para {{ $shopping_cart->tipo }}   {{ $order->mesa }}</h2></strong></th>
                                @else
                                    <th colspan="2"><strong><h2>Tu Pedido para {{ $shopping_cart->tipo }}</h2></strong></th>
                                @endif

                                
                            </tr>                                    
                            <tr>
                                <th><strong>Pedido ID:</strong></th>
                                <td>{{ $shopping_cart->customid }}</td>
                            </tr>                                    
                            <tr>
                                <th><strong>Nombre:</strong></th>
                                <td>{{ $order->nombre_recibe }}</td>
                            </tr>

                            @if($shopping_cart->tipo <> "Mesa")

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
                                    <td>
                                        {{ $order->ciudad.' - '.$order->departamento.' - '.$order->pais }}

                                    </td>
                                </tr>

                            @endif
                        </tbody>
                    </table>
    
            

                    <table class="table  table-borderless">
                        <thead>
                            <tr>
                                <td>Cant</td>
                                <td>Artículo</td>
                                <td style="text-align:right">Precio</td>

                            </tr>
                        </thead>
                        <tbody>
                    
                            @foreach ($articulos as $articulo)

                                <tr>
                                    <td> <span class="fs-sm-2-0">{{$articulo->cantidad}}</span>  </td>
                                    <td> {{ $articulo->descripcion }} </td>
                                    <td style="text-align:right"> $ {{ number_format($articulo->precio * $articulo->cantidad, 0) }} </td>

                                </tr>
                                {{--  @widget('showModificadoresInvoice', ['articulo_id' => $articulo->codart  , 'shopping_cart' => $shopping_cart->id ] )  --}}
                                @widget('showmodificadorinvoice', ['articulo_id' => $articulo->codart  , 'shopping_cart' => $shopping_cart->id ] )
                            @endforeach
                            <tr>
                                <td colspan="1" > <h4>Total</h4>  </td>
                                <td colspan="2" style="text-align:right"> <h4>$ {{ number_format($total, 0) }}</h4> </td>
            
                            </tr> 
                            <tr>

                                <th colspan="3">Observaciones</th>
                            </tr>                       
                            <tr>

                                <td colspan="3">{{ $order->line1 }}</td>
                            </tr>                      
                                
                            @if($shopping_cart->tipo == "Mesa")
                                @if($empresa->preguntavajilla == 1)
                                    <tr>
                                        <th><strong>Servicio con:</strong></th>
                                        @if($order->respuestavajilla == '1')
                                            <td>Desechable</td>
                                        @else
                                            <td>Vajilla</td>
                                        @endif
                                    </tr> 
                                    
                                @endif                                      
                            @endif

                        </tbody> 
                    </table>
        
                </div>
            </div>

        </div>
    <br>
    <br>


</body>
</html>
  
