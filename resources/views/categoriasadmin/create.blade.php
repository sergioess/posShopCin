@extends('layouts.dashboard')
{{-- @extends('layouts.app') --}}

@section('content')



<div class="container">

	<div class="row justify-content-center">
		<div class="col-md-8">

			<div class="card">
				<div class="card-header text-center">
					<h2>Categorias</h2>
				</div>
				<div class="card-body">



					{!! Form::open(['method' => 'POST', 'route' => 'categoriasadmin.store', 'class' => 'form-horizontal', 'files' => true]) !!}

						{!! csrf_field() !!}
		
		
						<p><label for="descripcion">
							Nombre
							<input class="form-control"  type="text" name="descripcion" value="{{ old('descripcion') }}">
							{!! $errors->first('descripcion','<span class=error>:message</span>') !!}
						</label></p>  
		
						{{--  <p><label for="visibleweb">
							Visible (T/F)
							<input class="form-control"  type="text" name="visibleweb" value="{{ old('visibleweb') }}">
							{!! $errors->first('visibleweb','<span class=error>:message</span>') !!}
						
						</label></p>  --}}
						{{--  <div class="form-group">
							<p><label for="imagen">
								Imagen
								{!! Form::file('imagen', array('class' => 'form-control')) !!}
						
								<small class="text-danger">{{ $errors->first('imagen') }}</small>
							</label></p>
						</div>  --}}
							
						<br>
					
					
						<button class="btn btn-success " type="submit" ><i class='far fa-check-square fa-1x' aria-hidden="true"   ></i> Guardar</button>
		
					{!! Form::close() !!}



				</div>
				<div class="card-footer  text-center" style="background-color: white;">


				</div>

			</div>
		</div>
	</div>
</div>
	

			

@stop
