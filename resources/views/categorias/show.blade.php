@extends('layouts.app')


@section('tittle', 'Productos')

@section('content')
<br>
<br>
<div class="container">
          


        <div class="products ">
            <div class="text-center"><h4><strong> {{$favorito->descripcion}} </strong></h4></div>
            <br>    
            <div class="container ">
                <div class="row ">
                
                
                    @foreach ($articulos as $articulo)
                        <div class="col pb-5">
    
{{--    
                            <a href="{{ route('articulos.show',  $articulo->id) }}" class="list-group-item-action">
                  
                                        
                                <div class="container">
    
                                    <div class="row justify-content-center">
                                        <div class="imgcontainer">
                                            <img src="{{ URL::asset("/storage/img/articulos/$articulo->imagen") }}"
                                            class=" rounded-circle " style="height: 250px; width: 250px;"
                                            alt="{{ $articulo->imagen }}">
            
                                            <span class="font-weight-bold "  >
                                                <div class="centeredtext " style="background-color:{{ $empresa->footercolor }};"> {{ $articulo->descripcion }} </div>
                                            </span>
                                        </div>  
                                    </div>
                                    <div class="row justify-content-center pt-2 pb-2" align="center ">
                                            
                                            <strong>
                                                <span class="text-center ">
                                                    $ {{ number_format($articulo->precio, 0)}}
                                                </span>
                                            </strong>
        
                                            
        
                                        
                                    </div>
                                </div>
                                      
                                    
                                
                            </a> --}}
    
                            <a href="{{ route('articulos.show',  $articulo->id) }}" class="list-group-item-action">
                                <div class="card  "  style="width: 19rem;">
                                    <div class="card-header ">
                                        
                                            <div class="column p-1">
                                                
                                                    <img src="{{ URL::asset("/storage/img/articulos/$articulo->imagen") }}"
                                                    class="card-img-top mx-auto" style="height: 250px; width: 250px;display: block;"
                                                    alt="{{ $articulo->imagen }}">
        
                        
                                                
                                            </div>
                                    </div>
                                    <div class="card-body p-0" style="height: 6rem;">
                                            <div  class="capitalize text-center">
                                                <h5 class="capitalize">
                                                    {{ $articulo->descripcion }}
                                                </h5>
                                                <strong>
                                                    <span class="text-center ">
                                                        $ {{ number_format($articulo->precio, 0)}}
                                                    </span>
                                                </strong>
                                            </div>
                                        
                                    </div>
                                </div>
                                </a>
    
    
                        </div>
                    @endforeach  
    
                </div>
            </div>
            
                <div class=" text-center mt-5" >
                  
                        
                    <a class="btn btn-outline-primary  mt-2   white-text capitalize  "  style="width: 16rem;"  title="Categorias" href="{{ route('categorias.index') }}">
                        <h5><i class="fas fa-arrow-left"></i> Categorias </h5>
                    </a>
               

                </div>

                <div >
                    @if( $articulosCount>0)


                        <div class="form-group text-center p-0">
                            <br>
                            <a class="btn btn-secondary w-50 white-dark"  class="tooltip-test" title="Pedido" href="{{url('/carrito')}}">
                                <h5><i class="fas fa-shopping-cart "></i> <span class="capitalize"> Ver Carrito</span></h5>
                            </a>
                        </div>

                    
                    @endif
                </div>




        </div>




</div>


<br>
<br>










@endsection
