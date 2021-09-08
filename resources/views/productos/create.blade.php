
@extends('layouts.dashboard')

@section('content')

<div class="container">

<br>
<br>

	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card large-padding p-2">
	<h1>Productos</h1>



	
    {!! Form::open(['method' => 'POST', 'route' => 'productos.store', 'class' => 'form-horizontal', 'files' => true]) !!}

				{!! csrf_field() !!}

				<p><label for="Categoria">
	                <select class="form-control" name="categoria" id="categoria">

	                    @foreach ($categorias as $categoria)
	                        <option value="{{$categoria->id}}">{{$categoria->descripcion}}</option>
	                    @endforeach
	                </select>
	             </label></p>				

 				<p><label for="nombre">
					Nombre
					<input class="form-control"  type="text" name="nombre" value="{{ old('nombre') }}">
					{!! $errors->first('nombre','<span class=error>:message</span>') !!}
				</label></p>  

				<p><label for="descripcion">
					Descripción
					<input class="form-control"  type="text" name="descripcion" value="{{ old('descripcion') }}">
					{!! $errors->first('descripcion','<span class=error>:message</span>') !!}
				</label></p>  

 				<p><label for="valor">
					Valor
					<input class="form-control"  type="text" name="valor" value="{{ old('valor') }}">
					{!! $errors->first('valor','<span class=error>:message</span>') !!}
				
				</label></p>

				<div class="form-group">
					<p><label for="imagen">
						Imagen
                		{!! Form::file('imagen', array('class' => 'form-control')) !!}
                
                		<small class="text-danger">{{ $errors->first('imagen') }}</small>
					</label></p>
				</div>
				{{--  <p><label for="Visible">
					Visible
					<input class="form-control"  type="text" name="Link" value="{{ old('Link') }}">
					{!! $errors->first('Link','<span class=error>:message</span>') !!}
				
				</label></p>  --}}



				<p><label for="Medida">
	                <select class="form-control" name="idmedia" id="idmedia">

	                    @foreach ($medidas as $medida)
	                        <option value="{{$medida->id}}">{{$medida->nombre}}</option>
	                    @endforeach
	                </select>
	             </label></p>
						
				<input type="hidden" name="minimo" value="0" >	
				{{-- <input type="hidden" name="_token" value="{{ $cat }}" >	 --}}

				<button class="btn btn-success " type="submit" ><i class='far fa-check-square fa-1x mr-1' aria-hidden="true"   ></i>Guardar</button>
		{!! Form::close() !!}
	
	</div>
</div>
</div>



</div>

@endsection
