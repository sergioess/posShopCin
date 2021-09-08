
@if( $articulosCount=0)
return redirect('categorias.index');
@else

    @extends('layouts.app')


    @section('content')
        <div class="col-12 text-center " >
            <h5 class="d-inline text-white pr-4 pl-4 pb-1 " style="border-bottom-left-radius: 20px 20px;border-bottom-right-radius: 20px 20px; background-color:#AB4A19;"><span >{{ $nombreEmpresa }}</span></h5>
        </div>

        @includeIf('components.mensajes')

        <div class="container ">
            <br>
            <br>

            @if($shopping_cart->enviado == 0)

                {{--  <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card p-0">
                             <div class="card-header text-center  pb-4">
                                
                                <h5>Selecciona cómo desea pagar el pedido </h6> {{ $shopping_cart->id }} 
                                    <h5>Total : $ {{ $total }}</h5>

                            </div>  

                            <div class="card-body text-center  pb-4" id="toggler">

                                <div class="form-group">

                                    <div class="btn-group btn-group-toggle " data-toggle="buttons">
                                        
                                                
                                            
                                                    
                                        <label class="btn  btn-info  p-2 "
                                            data-target="#Credibanco-Collapse"
                                            data-toggle="collapse"
                                        >
                                            <input type="radio" name="plataforma" value="1">
                                            <i class="far fa-credit-card fa-5x"></i>
                                            <h5>Tarjeta</h5>
                                        </label>
                                        
                                    
                                        <label class="m-3"></label>

                                    
                                        <label class="btn btn-info p-2 "
                                            data-target="#efectivo-Collapse"
                                            data-toggle="collapse"
                                        >
                                            <input type="radio" name="plataforma" value="2">
                                            <i class="fas fa-wallet fa-5x"></i>
                                            <h5>Efectivo</h5>
                                        </label>
                                      
                                                        
         
                                            

                                    </div>
                                </div>       


                                <div class="row  justify-content-center">
                                            
                                    <div
                                    id="Credibanco-Collapse"
                                    class="collapse"
                                    data-parent="#toggler"
                                    >
                                        @includeIf('components.credibanco-collapse')
                                    </div>

                                    <div
                                    id="efectivo-Collapse"
                                    class="collapse"
                                    data-parent="#toggler"
                                    >
                                        @includeIf('components.efectivo-collapse')
                                    </div>

                                </div>   
                                
            


                            </div>  
                        </div>
                    </div> 

                </div>

                <br>
                <br>  --}}
            @else
                <h6>Pago Recibido </h6>
            @endif

            

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card p-0">
                        {{--  Datos de envio  --}}
                        <br>
                        <div class="card">
                            <div class="card-header text-center  pb-4">
                                <div class="text-left">


                                
                                    <div class="text-center">
                                        <h5>Datos de Entrega:</h5>
                                    </div>

                                    {!! Form::open(['method' => 'POST', 'route' => 'enviapedido.store', 'id'=>'theForm' ,'class' => 'form-horizontal', 'autocomplete' => 'off', 'files' => true]) !!} 


                                    

                                        <input name="shopping_cart"    type="hidden"  value="{{ $shopping_cart->id }}"   >
                                        <input name="empresa_id"    type="hidden"  value="{{ $shopping_cart->empresa_id }}"   >
                                        <input name="userName"    type="hidden"  value="CINNAMON_GOURMET-api"   >
                                        <input name="password"    type="hidden"  value="b0tondepagos=48"   >

                                        <input name="amount"        type="hidden"  value="{{ $total }}" >



                                        
                                        <hr>
                                        @if($shopping_cart->tipo == 'Mesa')
                                            @if($empresa->preguntavajilla == 1)
                                                <div class="form-group ">
                                                    Servicio en : 
                                                    <p>
                                                        <input type="radio" id="0" checked name="respuestavajilla" value="0">
                                                        <label for="0">En Vajilla</label>
                                                        <input type="radio" id="1"  name="respuestavajilla" value="1">
                                                        <label for="1">En Desechable</label>
                                                    </p>
                                                </div>  
                                            @else 
                                                <input name="respuestavajilla" type="hidden"  value="0" > 
                                            @endif
                                        @else     
                                            <input name="respuestavajilla" type="hidden"  value="0" >                   
                                        @endif         

                                        <div class="form-group ">
                                            Observaciones: 
                                            <p>
                                                <textarea class="form-control" name="line1" rows="3"></textarea>
                                            </p>
                                        </div>                                        

                                        @if ($shopping_cart->tipo == "Mesa")


                                            <p><label for="mesa">
                                                Número de Mesa: 
                                                <input class="form-control"  type="text" name="mesa" value="{{ old('mesa') }}">
                                                {!! $errors->first('mesa','<span class=error>:message</span>') !!}
                                            
                                            </label></p>
                                            <input name="buyerName"    type="hidden"  value="{{ auth()->user()->name }}" >
                                            <input name="shippinAddress" type="hidden"  value="0"  >
                                            <input name="shippinBarrio" type="hidden"  value="0"  >
                                            <input name="shippinPhone" type="hidden"  value="1234567"  >
                                            <input name="buyerEmail" type="hidden"  value="{{ auth()->user()->email }}"  >
                                            <input name="shippinCity"    type="hidden"  value="{{ auth()->user()->ciudad }}" >


                            
                                        @else
                                            <input name="mesa" type="hidden"  value="0"  >
                                            
                                            @if(Auth::user()->claseusr <> 4)
                                                
                                                <div class="form-group ">
                                                    Quién Recibe: 
                                                    <input name="buyerName"  class="btn-block"  type="text"  value="{{ old('buyerName') }}" >
                                                    {!! $errors->first('buyerName','<span class=error>:message</span>') !!}
                                                </div>
                                                <div class="form-group ">
                                                    Correo Electrónico: 
                                                    <p>
                                                        <input name="buyerEmail"  class="btn-block"  type="text"  value="{{ old('buyerEmail') }}" >
                                                    </p>
                                                </div>     
                                                <div class="form-group ">
                                                    Dirección: 
                                                    <input name="shippinAddress"  class="btn-block"  type="text"  value="{{ old('shippinAddress') }}" >
                                                    {!! $errors->first('shippinAddress','<span class=error>:message</span>') !!}
                                                </div>
        
                                                <div class="form-group">
                                                    Barrio:
                                                    <input name="shippinBarrio"  class="btn-block"   type="text"  value="{{ old('shippinBarrio') }}" >
                                                    {!! $errors->first('shippinBarrio','<span class=error>:message</span>') !!}
                                                </div>
                                                <div class="form-group">
                                                    Teléfono:
                                                    <input name="shippinPhone" class="btn-block" type="text"  value="{{ old('shippinPhone') }}" >
                                                    {!! $errors->first('shippinPhone','<span class=error>:message</span>') !!}
                                                </div>
                                                <div class="form-group">
                                                    Ciudad:
                                                    <input name="shippinCity" class="btn-block" type="text"  value="{{ old('shippinCity') }}" >
                                                    {!! $errors->first('shippinCity','<span class=error>:message</span>') !!}
                                                </div>
                                            @else
                                            

                                                <div class="form-group ">
                                                    Nombre: 
                                                    <input name="buyerName"  class="btn-block"  type="text"  value="{{ old('buyerName') }}" >
                                                    {!! $errors->first('buyerName','<span class=error>:message</span>') !!}
                                                </div>

                                                <div class="form-group ">
                                                    Correo Electrónico: 
                                                    <p>
                                                        <input name="buyerEmail"  class="btn-block"  type="text"  value="{{ old('buyerEmail') }}" >
                                                    </p>
                                                </div>                                                    

                                                <div class="form-group ">
                                                    Dirección: 
                                                    <input name="shippinAddress"  class="btn-block"  type="text"  value="{{ old('shippinAddress') }}" >
                                                    {!! $errors->first('shippinAddress','<span class=error>:message</span>') !!}
                                                </div>

        
                                                <div class="form-group">
                                                    Barrio:
                                                    <input name="shippinBarrio"  class="btn-block"   type="text"  value="{{ old('shippinBarrio') }}" >
                                                    {!! $errors->first('shippinBarrio','<span class=error>:message</span>') !!}
                                                </div>
                                                <div class="form-group">
                                                    Teléfono:
                                                    <input name="shippinPhone" class="btn-block" type="text"  value="{{ old('shippinPhone') }}" >
                                                    {!! $errors->first('shippinPhone','<span class=error>:message</span>') !!}
                                                </div>
                                                <div class="form-group">
                                                    Ciudad:
                                                    <input name="shippinCity" class="btn-block" type="text"  value="{{ old('shippinCity') }}" >
                                                    {!! $errors->first('shippinCity','<span class=error>:message</span>') !!}
                                                </div>

                                                
                                            @endif

                                        @endif
                                        
                                        <input name="shippinCountry"    type="hidden"  value="{{ auth()->user()->pais }}" >
                                        
                                        <input name="shippinState"    type="hidden"  value="{{ auth()->user()->departamento }}" >


                                        {{--  Pregunta el medio de pago  --}}

                                        <div class="card-header text-center  pb-4">
                                
                                            <h5>Selecciona cómo desea pagar el pedido </h6> 
                                                {{--  {{ $shopping_cart->id }}   --}}
                                                <h5>Total : $ {{ $total }}</h5>
            
                                        </div>

                                        {{--  medios de pago  --}}

                                        <div class="card-body text-center  pb-4" id="toggler">

                                            <div class="form-group">
            
                                                <div class="btn-group btn-group-toggle " data-toggle="buttons">
                                                    
                                                            
                                                        
                                                                
                                                    <label class="btn  btn-info  p-2 "
                                                        data-target="#Credibanco-Collapse"
                                                        data-toggle="collapse">
                                                        <input type="radio" name="plataforma" value="2">
                                                        <i class="far fa-credit-card fa-5x"></i>
                                                        <h5>Tarjeta</h5>
                                                    </label>
                                                    
                                                
                                                    <label class="m-3"></label>
            
                                                
                                                    <label class="btn btn-info p-2 "
                                                        data-target="#efectivo-Collapse"
                                                        data-toggle="collapse">
                                                        <input type="radio" name="plataforma" value="1">
                                                        <i class="fas fa-wallet fa-5x"></i>
                                                        <h5>Efectivo</h5>
                                                    </label>
                                                  
                                                                    
                     
                                                        
            
                                                </div>
                                            </div>       
            
            
                                            <div class="row  justify-content-center">
                                                        
                                                <div
                                                id="Credibanco-Collapse"
                                                class="collapse"
                                                data-parent="#toggler"
                                                >
                                                    @includeIf('components.credibanco-collapse')
                                                </div>
            
                                                <div
                                                id="efectivo-Collapse"
                                                class="collapse"
                                                data-parent="#toggler"
                                                >
                                                    @includeIf('components.efectivo-collapse')
                                                </div>
            
                                            </div>   
                                            
                        
            
            
                                        </div>
                                        
                                        <div class="row justify-content-center">
                                    
                                                <div class="col-6 ">
                                                    <button type="submit" class="btn btn-primary btn-block text-capitalize">
                                                        <i class="fas fa-carrot"></i> Enviar Pedido
                                                    </button>
                                                </div>
                                            
                                        </div>
                                

                                    {{--  <div class="text-center">
                                        <h5>
                                            <input type="submit" value="Enviar Pedido" class="btn btn-primary btn-block  p-3  text-capitalize input-lg" >
                                            
                                            
                                        </h5>
                                        
                                        
                                    </div>  --}}




                                        
                                    {!! Form::close() !!}           
                                </div>
                                
                            </div>            
                        </div>

                        <div class="card pt-2">
                            <div class="card-header text-center p-4">
                            
                                <div class="row justify-content-center">
                                    
                                    <div class="col-9">
                                        <a class="btn btn-outline-primary  pb-0 btn-block  white-text capitalize"  class="tooltip-test" title="Categorias" href="{{ route('categorias.index') }}">
                                            <h6><i class="fas fa-arrow-left"></i> Sigue comprando</h6>
                                        </a>
                                    </div>
                                
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



    @endsection

@endif
