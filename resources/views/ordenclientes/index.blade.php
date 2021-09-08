@extends('layouts.app')


@section('tittle', 'Dashboard')

@section('content')



    @if(Auth::user()->claseusr == 0)


        @php
            header("Location: " . URL::to('/categoriasadmin'), true, 302);
            exit();
        @endphp


    @endif


    <div class="container ">
<br>

        <div class="article p-0 text-center">
            <a class="btn btn-primary  white-text capitalize"  class="tooltip-test" title="Nuevo Pedido" href="{{ route('home') }}">
                <h5><i class="fas fa-cart-plus"></i> Nuevo Pedido</h5>
            </a>
        </div>

        <br>
        <div class="panel panel-default p-1">

            <div class="panel-heading p-3 text-center">

                <h2>Últimos 10 Pedidos</h2>
                
                    
            </div>


                

                    {{--  {{ dd($orders) }}    --}}
                    <table class="table table-bordered">

                        <thead>
                            <tr>
                                {{-- <th>Num</th> --}}
                                <th>Fecha</th>
                                <th>Tipo</th>
                                {{-- <th>Total</th> --}}
                                <th  style="text-align:center">Status</th>
                                {{-- <th>Actualizado</th> --}}
                                {{-- <th>Detalle</th> --}}
                            </tr>
                        </thead>

                        @if(Auth::user()->claseusr == 1)
                            <tbody>
                                @foreach ($orders as $order)
                            
                                    <tr>
                                        {{-- <td>  {{ $loop->iteration }}  </td> --}}
                                        <td> {{ date('d-m-Y', strtotime($order->fecha)) }}  </td>
                                        <td> {{ $order->tipo }} </td>
                                        {{-- <td> {{ $order->total }} </td> --}}
                                        {{-- <td  style="text-align:center"> 
            
                                            <a href="#" class="select-status" data-type="select" data-pk="{{$order->id}}" 
                                                data-url="{{url("/orders/$order->id")}}" 
                                                data-title="Status"
                                                data-value="{{$order->status}}"
                                                data-name="status">
                                            </a>



                                        </td> --}}
                                        <td> {{ $order->status }} </td>
                                        {{-- <td> {{ $order->actualizado }} </td> --}}
                                    
                                        {{-- <td> 

                                            <a href="{{ route('notifications.show', $order->idShop) }}"  target="_blank"  class="btn btn-link btn-xs" data-toggle="tooltip"  title="Imprimir">
                                                <i class="fas fa-print fa-2x" ></i>
                                            </a> 


                                        </td> --}}

                                    </tr>
                                @endforeach

                            </tbody>

                        @else
                            <tr>
                                <td colspan="3" class="text-center"> 
                                    <h4>Regístrate y podrás gestionar tus pedidos y recibir notificaciones por correo.
                                        <br>
                                        Sólo usuarios registrados pueden hacer recervas.
                                    </h4>
                                </td>
                            </tr>
                            
                        @endif
                    </table>

            </div>
    
        </div>
    <div>

@endsection

{{-- 

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
				{value: 'creado', text: 'Creado'}, 
				{value: 'recibido', text: 'Recibido'}, 
				{value: 'enviado', text: 'Enviado'} 
			]
		});

        $(function(){
            $('.numero_guia').editable({

            });
        });


	</script>

@endsection --}}