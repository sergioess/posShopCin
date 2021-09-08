@if(Auth::user()->claseusr == 0)

    @php
        header("Location: " . URL::to('/categoriasadmin'), true, 302);
        exit();
    @endphp

@endif



@extends('layouts.app')


@section('tittle', 'Productos')

@section('content')
<br>
<br>
<div class="container">
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card rounded">
                <div class="card-header text-center"><h2>Categorias</h2>

                   
                </div>
                <div class="card-body progress-bar-striped progress-bar-animated bg-light">
                        <nav class="nav nav-pills flex-column ">
                            @foreach ($favoritos as $favorito)
                                <span class="p-2 ">
                                    <div class=" rounded   ">
                                    
                                        
                                        <a href="{{ route('categorias.show', $favorito->codfavorito) }}" class="list-group-item list-group-item-action big-link">
                                            <div >
                                            <i class="fas fa-utensils"></i> {{ $favorito->descripcion }}
                                        </div>
                                        </a>
                                        
                                    
                                    </div>
                                </span>
                            @endforeach
                         
                        </nav>
                </div>

                <div class="card footer">
                    @if( $articulosCount>0)


                        <div class="form-group text-center p-3">
                            <br>
                            <a class="btn btn-secondary  btn-block  white-dark"  class="tooltip-test" title="Pedido" href="{{url('/carrito')}}">
                                <h5><i class="fas fa-shopping-cart "></i> <span class="capitalize"> Ver Carrito</span></h5>
                            </a>
                        </div>

                    
                    @endif
                </div>




            </div>

        </div>
    </div> --}}


    <div class="products ">

        <div class="row justify-content-center p-2" style="background-color:{{ $empresa->navvar }};">
            <span class="  text-white text-center btn-block p-0"><h4>Selecciona una Categoria</h4></span>
            
        </div>

        <div class="row justify-content-center">

            

            @foreach ($favoritos as $favorito)
                <div class="col-lg-4 col-md-6 col-sm-12 p-2 ">


                
                <a href="{{ route('categorias.show', $favorito->id) }}" class="list-group-item-action">
                    <div class="  "  style="">
                        <div class=" ">
                            
                                <div class="column p-1">
                                    
                                        <img src="{{ URL::asset("/storage/img/categorias/$favorito->imagen") }}"
                                        class="card-img-top mx-auto d-block" style="height: 400px; width: 400px;display: block;"
                                        alt="{{ $favorito->imagen }}">

            
                                    
                                </div>
                        </div>

                    </div>
                    </a>
                </div>
            @endforeach  

        </div>
            <div class=" text-center" >
              
                    
                <a class="btn btn-outline-primary    white-text capitalize  "  style="width: 16rem;"  title="Categorias" href="{{ route('categorias.index') }}">
                    <h5><i class="fas fa-arrow-left"></i> Categorias </h5>
                </a>
           

            </div>

            <div >
                @if( $articulosCount>0)


                    <div class="form-group text-center p-3">
                        <br>
                        <a class="btn btn-secondary w-50  white-dark"  class="tooltip-test" title="Pedido" href="{{url('/carrito')}}">
                            <h5><i class="fas fa-shopping-cart "></i> <span class="capitalize"> Ver Carrito</span></h5>
                        </a>
                    </div>

                
                @endif
            </div>




    </div>




</div>
<br>
<br>
<br>

@endsection
