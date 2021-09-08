{{-- @extends('layout') --}}
 @extends('layouts.dashboard')

@section('content')
	

	<br>
	<br>

	{{-- {!! $categorias !!} --}}



	<div class="container">

		<div class="row justify-content-center">
			<div class="col-md-12">
				
				<div class="card">
					<div class="card-header text-center"><h1>Listado de Categorias <a href="{{ route('categoriasadmin.create') }}">
						<button class="btn btn-xs btn-link"  data-toggle="tooltip"  title="Crear  Categoria">
							<i class="fas fa-plus-circle  fa-3x text-dark" aria-hidden="true"></i>
						</button></a></h1>
	
					   
					</div>
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-striped">
							
								<thead>
									
									<tr>
										<th>id</th>
										<th>Nombre</th>				
										<th>Visible</th>
									</tr>
										
								</thead>
					
					
								<tbody>
									
									@foreach ($categorias as $categoria)
										<tr>
											<td> {{ $categoria->id }} </td>
					
											<td> {{ $categoria->descripcion }} </td>
											{{--  <td> {{ $categoria->visibleweb }} </td>  --}}

											<td>
												<a href="#" class="cat-habilitado" data-type="select" data-pk="{{$categoria->id}}" 
													data-url="{{url("/categorias/$categoria->id")}}" 
													data-title="Visible"
													data-value="{{$categoria->visibleweb}}"
													data-name="visibleweb">
												</a>
											</td>											
											
							
											<td> 
												<div class="row">
												
												<a href="{{ route('categoriasadmin.edit', $categoria->id) }}" class="btn btn-link btn-xs" data-toggle="tooltip"  title="Editar Categoria">
													<i class="fas fa-edit  fa-1x" ></i>
												</a> 
					

					
												{{--  Elimina Categoria  --}}
												{{--  <a class="tooltip-test" title="Eliminar Categoria" href="{{ route('categoriasadmin.delete', $categoria->id) }}">
													<h5><i class="fas fa-trash-alt"></i></h5>
												</a>  --}}
					
												{{--  Crea Productos en la categoria  --}}
												<a href="{{ route('prodcat.show', $categoria->id) }}" class="btn btn-link btn-xs"  data-toggle="tooltip" title="Crear Producto en esta Categoria" >
													
														<i class="fas fa-plus-circle  fa-1x" ></i>
													
												</a> 
												{{--  Muestra Productos en la categoria  --}}

 

												  <form class="no-padding" method="POST" action="{{ route('productos.show2') }}">
													{!! csrf_field() !!}
													<input type="hidden" name="categoria" value="{{$categoria->id}}" >
													
													<button class="btn btn-link no-padding" type="submit" data-toggle="tooltip"  title="Ver Productos de la Categoria">
														<h5><i class='fas fa-cubes no-padding text-dark'  ></i></h5>
													</button>
												</form>	 
												</div>	    

											</td>
					
										</tr>
									@endforeach
								</tbody>
					
					
							</table>
						</div>	
					</div>
					<div class="card-footer  text-center" style="background-color: white;">

	
					</div>
	
				</div>
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
		$('.cat-habilitado').editable({
			source: [
				{value: 'T', text: 'Mostrar'}, 
				{value: 'F', text: 'Ocultar'}
			]
		});  



	</script>

@endsection