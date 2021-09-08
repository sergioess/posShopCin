
@extends('layouts.dashboard')

@section('content')




    <br>
    <br>
            

    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header text-center">
                        <h2>{{$producto->descripcion}}</h2>
                    </div>

                    <div class="card-body">
                        <div class="border rounded-lg shadow-sm p-2 mb-5 bg-white">

                            {!! Form::open(['method' => 'POST', 'route' => 'modificadores.store', 'class' => 'form-inline']) !!}

                                {!! csrf_field() !!}
                                <p>
                                    <label for="descripcion" class="ml-2">
                                        Modificador

                                    </label>
                                </p>  

                                    <p>
                                        <label for="descripcion" class="ml-2">
                               
                                            <input class="form-control"  type="text" name="descripcion" size="50" value="{{ old('descripcion') }}">
                                            {!! $errors->first('descripcion','<span class=error>:message</span>') !!}
                                        </label>
                                    </p>  

                                    <input name="articulo_id" type="hidden"  value="{{$producto->id}}"  >

                            
                
                                {{--  <p><input class="btn btn-success"  type="submit" value= "Agregar" ></p>  --}}
                                <p class=" mt-1">
                                <button class="btn btn-link  no-padding " type="submit" data-toggle="tooltip"  title="Agregar Modificador">
                                    <h5><i class='fas fa-plus-square fa-2x no-padding ' style="color:rgb(6, 173, 6);margin-right: 0px;"></i></h5>
                                </button></p>

                            {!! Form::close() !!}
                        </div>
                        {{--  Copiar Modificadores de otro Articulo  --}}

                        <div class="border rounded-lg shadow-sm p-2 mb-5 bg-white">
                            {!! Form::open(['method' =>'PUT', 'route' => ['modificadores.update', $producto->id] , 'class' => 'form-inline']) !!}

                            {!! method_field('PUT') !!}
                            {!! csrf_field() !!} 

                            <div class="form-group mr-2">
                                <label ><h5>Copiar de :</h5></label>
                            </div>
                            <div class="form-group">
                                
    
                                <select class="form-control" name="adicional_articulo" id="adicional_articulo" data-toggle="tooltip"  title="Seleccionar un Producto">
    
                                    @foreach ($productos as $elproducto)
                                        <option value="{{$elproducto->id}}">{{$elproducto->descripcion}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group mt-1">
                                <button class="btn btn-link  no-padding" type="submit" data-toggle="tooltip"  title="Copiar Modificador">
                                    <h5><i class='fas fa-clone fa-2x no-padding ' style="color:rgb(6, 173, 6);margin-right: 0px;"></i></h5>
                                </button>

                            </div>
                            {!! Form::close() !!}   
                        </div>
                     
                        


                        <div class="card header">
                            <div class="table-responsive">
                                <h3 class="text-center">Opciones</h3>
                                <table class="table table-striped">
                                
                                    <thead>
                                        
                                        <tr>
                                            <th>Linea</th>
                                            <th>Modificador</th>				
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                    
                                    <tbody>
                                        
                                        @foreach ($modificadores as $modificador)
                                        <tr>
                                            <td>  {{ $loop->iteration }}  </td>             
                                            <td> {{ $modificador->descripcion }} </td>
                                            <td> 
                                                {{--  Elimina Producto  --}}
                                                <a class="tooltip-test" title="Eliminar Modificador" href="{{ route('modificadores.delete', $modificador->id) }}">
                                                    <h5><i class="fas fa-trash-alt fa-1x"></i></h5>
                                                </a>
                    
                    
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>                        
                        </div>


                    </div>

                </div>
                <br>

                <div class="card">

                    <div class="card-body">
                        <h3 class="text-center">Adicionales</h3>
                    </div>

                    <div class="card-body">


                        {!! Form::open(['method' => 'POST', 'route' => 'adicionales.store', 'class' => 'form-horizontal']) !!}

                            {!! csrf_field() !!}

        
                            <div class="form-group">
                                <label for="estado" class="col-xs-12 control-label"><h4>Seleccionar Producto</h4></label>
    
                                <select class="form-control" name="adicional_articulo" id="adicional_articulo" data-toggle="tooltip"  title="Seleccionar un Producto">
    
                                    @foreach ($productos as $elproducto)
                                        <option value="{{$elproducto->id}}">{{$elproducto->descripcion}}</option>
                                    @endforeach
                                </select>

                            </div>

                            <input name="articulo_id" type="hidden"  value="{{$producto->id}}"  >

                           
            
                            <p><input class="btn btn-success"  type="submit" value= "Agregar" ></p>
                        {!! Form::close() !!}

                        
                        
                            <div class="table-responsive">
                                
                                <table class="table table-striped">
                                
                                    <thead>
                                        
                                        <tr>
                                            <th>Linea</th>
                                            <th>Modificador</th>				
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                    
                                    <tbody>
                                        
                                        @foreach ($adicionales as $adicional)
                                        <tr>
                                            <td>  {{ $loop->iteration }}  </td>             
                                            <td> {{ $adicional->desarticulo }} </td>
                                            <td> 
                                                {{--  Elimina Producto  --}}
                                                <a class="tooltip-test" title="Eliminar Modificador" href="{{ route('adicionales.delete', $adicional->id) }}">
                                                    <h5><i class="fas fa-trash-alt fa-1x"></i></h5>
                                                </a>
                    
                    
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>                        
                        </div>


                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection
