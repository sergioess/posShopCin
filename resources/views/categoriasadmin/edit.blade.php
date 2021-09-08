@extends('layouts.dashboard')
{{-- @extends('layouts.app') --}}

@section('content')
	


	<br>
	<br>
			

	<div class="container">

		<div class="row justify-content-center">
			<div class="col-md-8">

				<div class="card">
					<div class="card-header text-center">
						<h2>Categorias</h2>
					</div>
					<div class="card-body">



						<form method="POST" action="{{ route('categoriasadmin.update', $categoria->id) }}">



							{!! method_field('PUT') !!}
							{!! csrf_field() !!} 
			
							<p><label for="nombre">
								Nombre
								<input class="form-control"  type="text" name="nombre" size="50" value="{{ $categoria->descripcion }}">
								{!! $errors->first('nombre','<span class=error>:message</span>') !!}
							</label></p>  
			
							{{--  <p><label for="Visible">
								Visible
								<input class="form-control"  type="text" name="tipo" value="{{ $categoria->visibleweb }}">
								{!! $errors->first('tipo','<span class=error>:message</span>') !!}
							
							</label></p>
			
							<p><label for="imagen">
								Imagen
								<input class="form-control"  type="text" name="imagen" value="{{ $categoria->imagen }}">
								{!! $errors->first('imagen','<span class=error>:message</span>') !!}
							
							</label></p>  --}}
						
			
			
							<button class="btn btn-success " type="submit" ><i class='fas fa-check-square fa-1x mr-1' aria-hidden="true"   ></i>Guardar</button>
			
						</form>	 


					</div>
					<div class="card-footer  text-center" style="background-color: white;">

	
					</div>
	
				</div>
			</div>
		</div>
	</div>
		
		
@endsection
