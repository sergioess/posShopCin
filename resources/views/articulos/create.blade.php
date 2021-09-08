
@extends('layouts.app')

@section('content')
	<div class="big-padding text-center blue-grey white-text">
		<h1>Crear Articulos</h1>
	</div>


	<div class="container white">



		@include('articulos.form', ['articulo' => $articulo, 'url' => '/articulos','method' => 'PATCH']);
				
	</div>
@endsection
