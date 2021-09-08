
@extends('layouts.dashboard')

@section('content')
<br>
<br>



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="panel p-3">
                <div class="panel-heading">

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel  bg-secondary">
                                    <div class="panel-heading p-2 text-white">
                                        <h5><strong>Datos de la Empresa</strong></h5>
                                    </div>
                                   
                                    <div class="panel-body p-3 white">
                                        {!! Form::open(['method' =>'PATCH', 'route' => ['empresas.update', $empresa->id] , 'class' => 'form-horizontal']) !!}

                                        {!! csrf_field() !!}

                                         {{--  //Nombre        --}}
                                         <div class="form-group row">
                                            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                            <div class="col-md-6">
                                                <input id="nombre" type="text" disabled class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ $empresa->nombre }}" >

                                                @error('nombre')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>                                     
                                        


                                        {{--  //Nombre Fiscal        --}}
                                        <div class="form-group row">
                                            <label for="nombre_fiscal" class="col-md-4 col-form-label text-md-right">{{ __('Nombre Fiscal') }}</label>

                                            <div class="col-md-6">
                                                <input id="nombre_fiscal" type="text" disabled class="form-control @error('nombre_fiscal') is-invalid @enderror" name="nombre_fiscal" value="{{ $empresa->nombre_fiscal }}" >

                                                @error('nombre_fiscal')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>  


                                        {{--  //documento        --}}
                                        <div class="form-group row">
                                            <label for="documento" class="col-md-4 col-form-label text-md-right">{{ __('NIT') }}</label>

                                            <div class="col-md-6">
                                                <input id="documento" type="text" disabled class="form-control @error('documento') is-invalid @enderror" name="documento" value="{{ $empresa->nit }}" >

                                                @error('documento')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>                                          

                                        {{--  //Email        --}}
                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo Electrónico') }}</label>
                
                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $empresa->email }}" required autocomplete="email">
                
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>                                        

                                        {{--  //Telefono  --}}
                                        <div class="form-group row">
                                            <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('Teléfono') }}</label>

                                            <div class="col-md-6">
                                                <input id="telefono" type="tel" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ $empresa->telefono }}" required autocomplete="telefono">

                                                @error('telefono')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>                                      
                                    




                                        {{--  //direccion  --}}
                                        <div class="form-group row">
                                            <label for="direccion" class="col-md-4 col-form-label text-md-right">{{ __('Dirección') }}</label>

                                            <div class="col-md-6">
                                                <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ $empresa->direccion }}" required autocomplete="direccion">

                                                @error('direccion')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>     
                                        {{--  //Barrio        --}}
                                        <div class="form-group row">
                                            <label for="barrio" class="col-md-4 col-form-label text-md-right">{{ __('Barrio') }}</label>

                                            <div class="col-md-6">
                                                <input id="barrio" type="text" class="form-control @error('barrio') is-invalid @enderror" name="barrio" value="{{ $empresa->barrio }}" >

                                                @error('barrio')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>    
                                        {{--  //Barrio        --}}
                                        <div class="form-group row">
                                            <label for="ciudad" class="col-md-4 col-form-label text-md-right">{{ __('Ciudad') }}</label>

                                            <div class="col-md-6">
                                                <input id="ciudad" type="text" class="form-control @error('ciudad') is-invalid @enderror" name="ciudad" value="{{ $empresa->ciudad }}" >

                                                @error('ciudad')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>                                                                      
                                        
                                        {{--  //Departamento        --}}
                                        <div class="form-group row">
                                            <label for="departamento" class="col-md-4 col-form-label text-md-right">{{ __('Departamento') }}</label>

                                            <div class="col-md-6">
                                                <input id="departamento" type="text" class="form-control @error('departamento') is-invalid @enderror" name="departamento" value="{{ $empresa->departamento }}" >

                                                @error('departamento')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div> 

                                        {{--  //Pais        --}}
                                        <div class="form-group row">
                                            <label for="pais" class="col-md-4 col-form-label text-md-right">{{ __('Pais') }}</label>

                                            <div class="col-md-6">
                                                <input id="pais" type="text" class="form-control @error('pais') is-invalid @enderror" name="pais" value="{{ $empresa->pais }}" >

                                                @error('pais')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>                                         
                                        
                                    
                                        <div class="form-group text-right">
                                            <a href="{{url('/empresas')}}"> Regresar</a>
                                            <input type="submit" value="Enviar" class="btn btn-success ">
                                        </div>
                                    
                                    
                                            
                                    {!! Form::close() !!}
                                    </div>



                                </div>
                            </div>
                            
                        </div>
            
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
