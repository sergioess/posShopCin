
@extends('layouts.app')

@section('content')
<br>
<br>


	<div class="container text-center">

  

        

  
        

        <div class="row justify-content-center ">
            <div class="col-md-8">
                <div class="row ">
                    
                        <div class=" text-center product">





                            <div class="card " style="margin-bottom: 20px; height: auto;">
                                @if(Auth::check())
                                    @if(auth()->user()->claseusr == 0) 
                                        <div class="absolute actions"> 
                                            <a href="{{ route('articulos.edit', $articulo->id) }}" data-toggle="tooltip"  title="Editar Producto">
                                                {{--  <i class="btn btn-link btn-xs fa fa-edit  fa-2x" aria-hidden="true"></i>  --}}
                                                Editar
                                            </a> 
                            
                                        </div>
                                    @endif
                                @endif
                                <br>

                                <div class="card-header">
                                    <a href=""><h6 class="card-title">{{ $articulo->descripcion }}</h6></a>
                                </div>
                                <br>
                                <img src="{{ URL::asset("/storage/img/articulos/$articulo->imagen") }}"
                                class="card-img-top mx-auto"
                                style="height: 170px; width: 255px;display: block;"
                                alt="{{ $articulo->imagen }}">    



                                <div class="card-body">
                                    <form action="{{ url('/in_shopping_carts') }}" method="POST">



                                        <table class="table ">

                                            <tr>
                                                <th class="p-1"> Precio </td>
                                                <td class="p-1"> <span class="text-left">$ {{ number_format($articulo->precio, 0) }}</span> </td>
                                            </tr>
                                            <tr class="p-1">
                                                <th class="p-1"> Cantidad </td>
                                                <td class="p-1"> 
                                                    <div class="col-md-auto d-print-inline">
                                                        <select class="form-control-sm "  name="cantidad" id="exampleFormControlSelect1" data-artidcan="{{ $articulo->innshop_id }}">
                                                            @for ($i = 1; $i < 11; $i++)
                                                                    <option value="{{$i}}">{{$i}}</option>
                                                            @endfor
        
                                                        </select>
                                                    </div>                                                    
                                                </td>
                                            </tr>

                                        </table>

                                                                         
                                    
                                    
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $articulo->id }}" id="id" name="articulo_id">
                                        <input type="hidden" value="{{ $articulo->referencia }}" id="name" name="name">
                                        <input type="hidden" value="{{ $articulo->precio }}" id="price" name="price">
                                        <input type="hidden" value="{{ $articulo->medida }}" id="img" name="img">
                                        <input type="hidden" value="{{ $articulo->departamento }}" id="slug" name="slug">
                                        <input type="hidden" value="1" id="quantity" name="quantity">
                                        
                                        <input type="hidden" value="0" id="quantity" name="shopp">
                                        
                                        <div class="card-footer  text-center" style="background-color: white;">
                                            <div class="form-group text-center">
                                                <br>
                                                <button class="btn btn-secondary btn-sm white-text capitalize" class="tooltip-test" title="Agregar al Carrito">
                                                    <h5><i class="fas fa-shopping-cart "></i> Agregar al Carrito</h5>
                                                </button>
                                            </div>

                                        </div>
                                        <div class="card-footer  " style="background-color: white;">
                                           
                                             
                                                <a class="btn btn-outline-primary  btn-block  white-text capitalize"  class="tooltip-test" title="Categorias" href="{{ route('categorias.index') }}">
                                                    <h5><i class="fas fa-arrow-left"></i> Categorias</h5>
                                                </a>
                                            

                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    
                    
                </div>
            </div>
        </div>


    </div>
    <br>
    <br>
    <br>
    
@endsection
