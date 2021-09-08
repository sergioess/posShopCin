
@extends('layouts.dashboard')

@section('content')




<br>
<br>
		

<div class="container">

	<div class="row justify-content-center">
		<div class="col-md-12">

			<div class="card">
				<div class="card-header text-center">
					<h2>Productos</h2>
				</div>
				<div class="card-body">



					<form method="POST" action="{{ route('productos.update', $producto->id) }}"  enctype="multipart/form-data">
						

 

						{!! method_field('PUT') !!}
					   {!! csrf_field() !!} 
	   
						<p><label for="nombre">
						   Nombre
						   <input class="form-control"  type="text" name="nombre" size="50" value="{{ $producto->descripcion }}">
						   {!! $errors->first('nombre','<span class=error>:message</span>') !!}
					   </label></p>  
	   
						<p><label for="valor">
						   Valor
						   <input class="form-control"  type="text" name="valor" value="{{ $producto->precio }}">
						   {!! $errors->first('valor','<span class=error>:message</span>') !!}
					   
					   </label></p>
	   
					   {{--  <p><label for="imagen">
						   Imagen
						   <input class="form-control"  type="text" name="imagen" value="{{ $producto->imagen }}">
						   {!! $errors->first('imagen','<span class=error>:message</span>') !!}
					   
					   </label></p>  --}}


						<div class="form-group">
							<p>
								<label for="imagen">
									Imagen
									{!! Form::file('imagen', array('class' => 'form-control')) !!}

									<small class="text-danger">{{ $errors->first('imagen') }}</small>
								</label>
							</p>
						</div>


					   <p><label for="Link">
						   Link
						   <input class="form-control"  type="text" name="Link" value="{{ $producto->habilitado }}">
						   {!! $errors->first('Link','<span class=error>:message</span>') !!}
					   
					   </label></p>	 			
	   
	   
				   
	   
					   <p><input class="btn btn-primary"  type="submit" value= "Enviar" ></p>
				   </form>	 


				</div>
				<div class="card-footer  text-center" style="background-color: white;">


				</div>

			</div>
		</div>
	</div>
</div>






@endsection
