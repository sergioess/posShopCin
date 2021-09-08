{{-- @extends('layout') --}}
 @extends('layouts.dashboard')

@section('content')

	{{--  {{ dd(public_path()) }}  --}}

	<div class="container">
		<h1>Listado de Productos <a href="{{ route('productos.create') }}">
			<button class="btn btn-xs btn-link"  data-toggle="tooltip"  title="Crear Producto"><i class="fas fa-plus-circle  fa-3x  text-dark" aria-hidden="true">
				</i></button></a></h1>


		
		<div class="row">

			<div class="form-group two-fields">
				<div class="input-group">
					<form class="form-inline" method="POST" action="{{ route('productos.show2') }}">
						{!! csrf_field() !!}
						<div class="form-group">
							<label for="estado" class="col-xs-12 control-label"><h3>Filtro Categoria</h3></label>

							<select class="form-control" name="categoria" id="categoria" data-toggle="tooltip"  title="Seleccionar una Categoria">

								@foreach ($categorias as $categoria)
									<option value="{{$categoria->id}}">{{$categoria->descripcion}}</option>
								@endforeach
							</select>

							<input class="btn btn-success p-2"  type="submit" value= "Filtrar" >
						</div>
					</form>
				</div>

			</div>
		</div>


		<div class="table-responsive">
			<table class="table table-striped">
			
				<thead>
					
					<tr>
						<th>#</th>
						{{--  <th>Id</th>  --}}
						<th>Nombre</th>				
						<th>Valor</th>
						<th>Imagen</th>				
						<th>Visible</th>
						<th>Editar</th>			
						<th>Opciones</th>	
						<th>Borrar</th>	
					</tr>
	
	
				</thead>
	
	
				<tbody>
					
					@foreach ($productos as $producto)
					<tr>
						<td>  {{ $loop->iteration }}  </td>
						{{--  <td> {{ $producto->id }} </td>  --}}
	
						<td> {{ $producto->descripcion }} </td>
						<td> {{ $producto->precio }} </td>
						<td> <img src="{{ URL::asset("/storage/img/articulos/$producto->imagen") }}"
							class="card-img-top mx-auto"
							style="height: 66px; width: 99px;display: block;">  
						</td>
						
						<td>
							<a href="#" class="pto-habilitado" data-type="select" data-pk="{{$producto->id}}" 
								data-url="{{url("/prodcat/$producto->id")}}" 
								data-title="Visible"
								data-value="{{$producto->habilitado}}"
								data-name="habilitado">
							</a>
						</td>
	
						<td> 
							<a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-link btn-xs" data-toggle="tooltip"  title="Editar Producto">
								<i class="fas fa-edit  fa-1x" ></i>
							</a> 
						</td>
						<td> 
							<a href="{{ route('modificadores.edit', $producto->id) }}" class="btn btn-link btn-xs" data-toggle="tooltip"  title="Opciones del Producto">
								<i class="fas fa-check-double fa-1x" ></i>
							</a> 
						</td>						
						<td> 
							{{--  Elimina Producto  --}}
							<a class="tooltip-test" title="Eliminar Producto" href="{{ route('productos.delete', $producto->id) }}">
								<h5><i class="fas fa-trash-alt fa-1x"></i></h5>
							</a>


							
						</td>
	
					</tr>
				@endforeach
				</tbody>
	
	
			</table>
		</div>
	
	</div>

</div>

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
		$('.pto-habilitado').editable({
			source: [
				{value: '1', text: 'Mostrar'}, 
				{value: '0', text: 'Ocultar'}
			]
		});



	</script>

@endsection