@extends('layouts.app')


@section('tittle', 'Productos')

@section('content')
<br>
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center"><h2>{{$favorito->descripcion}}</h2>

                   
                </div>
                <div class="card-body">


                    @foreach ($articulos as $articulo)
                    <a href="{{ route('articulos.show',  $articulo->id) }}" class="list-group-item-action">
                        <div class="card mt-3 ">
                            <div class="card-body ">
                                <div class="row ">
                                    <div class="column p-1">
                                        
                                            <img src="{{ URL::asset("/storage/img/articulos/$articulo->imagen") }}"
                                            class="card-img-top mx-auto" style="height: 200px; width: 200px;display: block;"
                                            alt="{{ $articulo->imagen }}">

                  
                                        
                                    </div>
                                    <div  class="capitalize">
                                        <h5>
                                            {{ ucfirst($articulo->descripcion) }}
                                        </h5>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                        <br>
                    @endforeach

                </div>
                <div class="card-footer  text-center" style="background-color: white;">
                  
                        
                        <a class="btn btn-outline-primary  btn-block  white-text capitalize  "   title="Categorias" href="{{ route('categorias.index') }}">
                            <h5><i class="fas fa-arrow-left"></i> Categorias </h5>
                        </a>
                   

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
