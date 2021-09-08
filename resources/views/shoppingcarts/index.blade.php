

@if( $articulosCount=0)
    return redirect('categorias.index');
@else

    @extends('layouts.app')





    @section('content')

        @if($StatusPasarela=="APPROVED")
             {{ $StatusPasarela }}  

            <script type="text/javascript">

            

                window.onload=function(){
                    var auto = setTimeout(function(){ autoRefresh(); }, 100);
            
                    function submitform(){
                      
                      document.forms["theForm"].submit();
                    }
            
                    function autoRefresh(){
                       clearTimeout(auto);
                       auto = setTimeout(function(){ submitform(); autoRefresh(); }, 1000);
                    }
                }             

            </script>

        @endif

        <div class="container ">
            <br>
            <br>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card p-0">
                        <div class="card-header text-center"><h2>Tu Pedido para {{ $shopping_cart->tipo }}</h2>
        
                        
                        </div>
                        <div class="card-body p-2">
                            <div class="table-responsive mb-0 mt-0">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <td>Cant</td>
                                            <td>Artículo</td>
                                            <td>Precio</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         {{--  {{ dd($articulos) }}    --}}
                                        @foreach ($articulos as $articulo)
                
                                            <tr >
                                                <td class="p-0"> 

                                                    <form method="POST" id="{{$articulo->innshop_id}}"  action="{{ route('in_shopping_carts.update', $articulo->innshop_id) }}">
                                                        {!! method_field('PUT') !!}
    
                                                        {!! csrf_field() !!} 
                                                        <div class="form-group align-middle ">
                                                            
                                                            <select class=' form-control-sm modifcant align-middle' value="{{ $articulo->cantidad }}" name="cantidad" id="exampleFormControlSelect1" data-artidcan="{{ $articulo->innshop_id }}">
                                                                @for ($i = 1; $i < 11; $i++)
                                                                    @if ($i == $articulo->cantidad)
                                                                        <option value="{{$i}}" selected>{{$i}}</option>
                                                                    
                                                                    @else
                                                                    
                                                                        <option value="{{$i}}">{{$i}}</option>
                                                                    @endif
                                                                    
                                                                @endfor

 
                                                            </select>
                                                        
                                                        </div>
                                                    </form>	
                                                </td>
                                                <td class="p-1"> {{ $articulo->descripcion }} </td>
                                                <td class="p-1" style="text-align:right"> $ {{ number_format($articulo->precio * $articulo->cantidad, 0) }} </td>
                                                <td  class="p-1" style="text-align:right">


                                                    <a class=" "  class="tooltip-test" title="Eliminar del Pedido" href="{{ route('in_shopping_carts.delete', $articulo->cod) }}">
                                                        <h5><i class="fas fa-trash-alt" style="color:orange;margin-right: 0px;"></i></h5>
                                                    </a>
                                                </td>
                                            </tr>
                                    
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" >

                                            {{--  @widget('muestraModificadores', ['articulo_id' => $articulo->artid  , 'shopping_cart' => $shopping_cart->id ] )   --}}
                                            @widget('muestramodificador', ['articulo_id' => $articulo->artid  , 'shopping_cart' => $shopping_cart->id ] ) 

                                        @endforeach
                                        <tr >

                                            <td colspan="4">
                                                <div class="row  p-0">
                                                    <div class="col float-left" style=" height: auto;">
                                                        
                                                        <h3 class="text-center">Total</h3>
                                                    </div>
                                                    <div  class="col float-right">
                                                        <h4 class="text-right" style="margin-right: 5px;">$ {{ number_format($total, 0) }}</h4>
                                                    </div>

                                                </div>
                                            </td>

                                        </tr> 
                                        
                                    </tbody> 
                                </table>
                            </div>
                        </div>
                        
                        {{--  Articulos Adicionales  --}}
                        <div class="mb-0 p-3 mt-0">
                             
                            <h5 class="text-center border rounded-lg " style="background-color:{{ $empresa->navvar }};">
                                <div class="p-2" style="color:{{ $empresa->colletraenca }};">
                                    Sugerencias para ti
                                </div>
 
                            </h5>
                            
                        </div>
                        <br>
                        @foreach ($articulosAdicionaes as $articuloAdicional)
                            
                            <form  action="{{ url('/in_shopping_carts') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{ $articuloAdicional->id }}" id="id" name="articulo_id">

                                <input type="hidden" value="1" id="quantity" name="quantity">
                                <input type="hidden" value="1" id="quantity" name="cantidad">
                                <input type="hidden" value="{{ $articuloAdicional->precio }}" id="price" name="price">
                                <input type="hidden" value="1" id="quantity" name="shopp">

                                <div class="container-fluid p-0" style="margin-left: 15px;">
                                
                                    <div class="row container-fluid p-0">
                                        <div class="col float-left" style=" height: auto;">
                                            
                                            <img src="{{ URL::asset("/storage/img/articulos/$articuloAdicional->imagen") }}"
                                            class="card-img-top mx-auto" style="height: 67px; width: 100px;display: block;"
                                            alt="{{ $articuloAdicional->imagen }}">

                                            
                                        </div>
                                        <div  class="col-7 float-right">
                                            <h6>
                                                {{ ucfirst($articuloAdicional->descripcion) }}
                                            </h6>
                                            <p>$ {{ number_format($articuloAdicional->precio, 0) }}</p>
                                        </div>
                                        <div class="col float-right p-2 text-center" >
                                            
                                            <button class="btn btn-link btn-sm p-0"  class="tooltip-test" title="Agregar al Carrito" style="color:orange;margin-right: 0px;">
                                                <h5><i class="fas fa-cart-plus " style="color:orange;margin-right: 0px;"></i> </h5>
                                            </button>
                                        </div>
                                    </div>
            
                                </div>
                            </form>
                            <hr class="p-0">
                        @endforeach


                        <br>


                        <div class="container">
                            <div class="row justify-content-center">
                                
                                    <div class="col-xs col-sm-10 col-md-8 ">

                                            <a class="btn btn-primary btn-block p-2 text-capitalize "  href="{{ url('inicia') }}">
                                                <h5> Continuar <i class="fas fa-hand-point-right"></i></h5>
                                            </a>
                                        
                                            <br>
                                    </div>
                                
                            </div>
                        </div>

                        


                        <div class="container">
                            
                            <div class="row align-items-center justify-content-center mb-2">
                                
                                <div class="col col-sm-10 col-md-8 ">
                                    <a class="btn btn-outline-primary  btn-block  white-text capitalize"  class="tooltip-test" title="Categorias" href="{{ route('categorias.index') }}">
                                        <h5><i class="fas fa-arrow-left"></i> Categorias</h5>
                                    </a>
                                </div>
                            
                            </div>                                

                        </div>
                    </div>
                </div>
            </div>  

            


        </div>
        <br>
        <br>




        

    @endsection

    @section('scripts')
    
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          
        $(".modifchecker").on("change", function() {
            
            var shopId = $(this).attr("data-shopid"); // gets task ID of clicked checkbox
            var artId = $(this).attr("data-artid"); // gets task ID of clicked checkbox
            var modId = $(this).attr("data-modid");
 
            var ides = '#'+modId;
            //alert(ides);

            $(ides).submit();
        });

        $(".modifcant").on("change", function() {
            

            var modId = $(this).attr("data-artidcan");
 
            var ides = '#'+modId;
            //alert(ides);

            $(ides).submit();
        });

        

    </script>


    @endsection

@endif
