
@extends('layouts.app')

@section('content')
	<div class="big-padding text-center blue-grey white-text">
		<h1>Editar Articulos</h1>
	</div>


	<div class="container white">



		@include('articulos.form', ['articulo' => $articulo, 'url' => '/articulos/'.$articulo->id, 'method' => 'PATCH']);
				
	</div>
@endsection
