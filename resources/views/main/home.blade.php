
@extends('layouts.app')


@section('tittle', 'Productos')

@section('content')
<br>
<br>
<div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{--  <div class="card">
                <div class="card-header text-center">
                    

                    <div class="row">
                        
                        <div class="col-xs-6 img-centrada">

                            <table  class="img-centrada" >
                                <tr>
                                    <td>
                                        <img src="{{ URL::asset("/img/logo.jpg") }}" alt="Sample Image" class="img-centrada">
                                        
                                    </td>
                                </tr>

                            </table>


                       
                        </div>
                        <div class="col-xs-6 img-centrada">
                            <div class="box ">
                                
                                <img src="{{ URL::asset("/img/inicio.jpg") }}" class="img-fluid img-responsive" >
                            </div>

                        </div>
                    </div>

                    <hr>
                </div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @else
                    <div class="text-center">
                  
                        
                        <a href="{{ route('login') }}" class="btn btn-primary nav-link">Inicia Sesión</a>

    

                    </div>
                    @endif

                    
                </div>
            </div>  --}}





            {{--  <div class="card "  style="background-color:{{ $empresa->fodocolor }};">
                <div class="card-header text-center">  --}}
            <div class=" "  style="background-color:{{ $empresa->fodocolor }};">
                <div class=" text-center">                    

                    <div class="row">
                        
                        <div class="column  p-1 img-centrada card-block">
                            {{--  <p><h4>{{ $empresa->nombre }}</h4></p>  --}}

                                        {{--  <img src="{{ URL::asset("/img/logo.png") }}" alt="Sample Image" class="img-centrada">
                                        
                            <p>{{ $empresa->direccion }}</p>
                            <p>Teléfono: {{ $empresa->telefono }}</p>
                            <p>{{ $empresa->barrio }}</p>
                            <p>{{ $empresa->ciudad }} - {{ $empresa->departamento }}</p>
                            
                            <p>{{ $empresa->email }}</p>
  --}}

                            <img src="{{ URL::asset("/img/izq.png") }}" class="img-fluid" style="width:313px;">
                        </div>
                        <div class="column  p-2 img-centrada card-block ">
                            {{--  <div class="box" >
                                
                                <img src="{{ URL::asset("/img/inicio.jpg") }}" class="img-fluid" style="width:313px;">
                            </div>  --}}
                            <img src="{{ URL::asset("/img/der.png") }}" class="img-fluid" style="width:313px;">
                        </div>
                    </div>

                    <hr>
                </div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @else

                        @if(!Auth::check())
                            {{--  <div class="text-center">
                        
                                @if ($empresa->estado == 1)
                                    <a href="{{ route('login') }}" class="btn btn-primary nav-link">Inicia Sesión</a>
                                @else
                                    <h2>En el momento no estamos dando Servivio</h2>
                                @endif
            

                            </div>
                        
                            <div class="text-center">
                        
                                @if ($empresa->estado == 1)

                                    <a href="{{ route('register') }}" class="btn btn-info nav-link">Registro</a>
                                @else
                                    <h2>En el momento no estamos dando Servivio</h2>
                                @endif
            

                            </div>     
                            
                            <div class="text-center p-1">
                    
                                @if ($empresa->estado == 1)
                                
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <input name="email" type="hidden"  value="miguel_rueda@gmail.com" >
                                        <input name="password" type="hidden"  value="12345678" >
        
                                        <input type="submit" value="Iniciar como Invitado" class="btn btn-light capitalize btn-block" >
                                    </form>
        
                                    
                                @else
                                    <h2>En el momento no estamos dando Servivio</h2>
                                @endif
            
        
                            </div>          
  --}}

                            <div class="text-center p-1">
                    
                                @if ($empresa->estado == 1)
                                
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <input name="email" type="hidden"  value="miguel_rueda@gmail.com" >
                                        <input name="password" type="hidden"  value="12345678" >
        
                                        <input type="submit" value="Ver la carta" class="btn btn-primary btn-block" >
                                    </form>
        
                                    
                                @else
                                    <h2>En el momento no estamos dando Servivio</h2>
                                @endif
            
        
                            </div>    

                        @else
                            <div class="row d-flex align-items-center justify-content-center">
                                <div class="col-sm-12 col-md-10  align-self-center text-center" >
                                    
                
                                    <a href="{{ url('/categorias') }}" class="btn-sm nav-link btn-block p-0 text-dark text-capitalize "  style="background-color: white;">
                                        
                                        <strong class="p-0">
                                            <h6 class ="p-3">Seguir Comprando</h6>
                                                
                                            
                                        </strong>
                                    </a>

                

                                </div>
                            </div>
                        @endif                

                    @endif

                    
                </div>
            </div>

        </div>
    </div>
</div>
<br>
<br>
<br>

@endsection
