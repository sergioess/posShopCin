@extends('layouts.dashboard')


@section('tittle', 'Dashboard')

@section('content')

    {{--  {{ dd($orders) }}  --}}
<br><br>
    <div class="container ">

        <div class="panel panel-default">

            <div class="panel-heading p-3">

                <h2>Pedidos</h2>
                
                    
            </div>
            
            <div class="panel-body white p-2">
                <hr>
                <h3 class="ml-1">Estadísticas</h3>

                <div class="row top-space">
                    {{--  col-xs-4: en moviles 4 columnas, en pantallas medianas 3  y en pantallas grandes 2  --}}

                    <div class="sale-data ml-n3">

                     </div>

                    <div class="col-xs-6 col-md-4 col-lg-3 sale-data">
                       <h5>COL</h5> 
                        <span>{{ number_format($totalmes, 0) }}</span>
                        Ingresos del Mes
                    </div>

                    <div class="col-xs-4 col-md-3 col-lg-3 sale-data">
                        <h5>No.</h5> 
                        <span>{{ $transacciones }}</span>
                        Número de Ventas
                    </div>
                    
                </div>
                <br>
                <hr>

                <h3>Ventas</h3>
                {{--  {{ dd($orders) }}    --}}
                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Comprador</th>
                            <th>Dirección</th>
                            <th>Tipo</th>
                            <th  style="text-align:center">Status</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th style="text-align:center">Domiciliario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                      
                        <tr>
                            <td> {{ $order->id }} </td>
                            <td> {{ $order->nombre_recibe }} </td>
                            <td> {{ $order->direccion }} </td>
                            <td> {{ $order->tipo }} </td>
                            <td  style="text-align:center"> 
 
                                <a href="#" class="select-status" data-type="select" data-pk="{{$order->id}}" 
                                    data-url="{{url("/orders/$order->id")}}" 
                                    data-title="Status"
                                    data-value="{{$order->status}}"
                                    data-name="status">
                                </a>



                            </td>
                            <td> {{ $order->created_at }} </td>
                            <td style="text-align:right"> {{ number_format($order->total, 0) }} </td>
                            <td  style="text-align:center"> 
 
                                <a href="#" class="numero_guia" id="{{$order->id}}" data-type="text" data-url="{{url("/orders/$order->id")}}"  data-name="numero_guia" 
                                    data-pk="{{$order->id}}" class="editable editable-click" >{{$order->numero_guia}}</a>


                                    

                                {{--  <a href="#" class="select-status" data-type="select" data-pk="{{$order->id}}" 
                                    data-url="{{url("/orders/$order->id")}}" 
                                    data-title="Domiciliario"
                                    data-value="{{$order->numero_guia}}"
                                    data-name="numero_guia">
                                </a>  --}}



                            </td>                            
                            <td> 

                                <a href="{{ route('notifications.show', $order->shopping_cart_id) }}"  target="_blank"  class="btn btn-link btn-xs" data-toggle="tooltip"  title="Imprimir">
                                    <i class="fas fa-print fa-2x" ></i>
                                </a> 


                            </td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
    
        </div>
    <div>

@endsection



@section('scripts')


	<script type="text/javascript">
		$.fn.editable.defaults.mode = 'inline';
		$.fn.editable.defaults.ajaxOptions = {type: "PUT"};


		$.ajaxSetup({

			headers: {

				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

			}

		});
		$('.select-status').editable({
			source: [
				
				{value: 'recibido', text: 'Recibido'}, 
				{value: 'enviado', text: 'Enviado'} 
			]
		});

        $(function(){
            $('.numero_guia').editable({

            });
        });


	</script>

@endsection