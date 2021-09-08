<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" href="{{ URL::asset("/img/iconop.png") }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />

    <!-- Fonts -->
    {{--  <link rel="dns-prefetch" href="//fonts.gstatic.com">  --}}


    <!-- Google Fonts -->

    {{--  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;1,300&display=swap" rel="stylesheet">  --}}

    <link href="https://fonts.googleapis.com/css2?family=Kodchasan:wght@200&display=swap" rel="stylesheet">





    <!-- X-editable -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jqueryui-editable/css/jqueryui-editable.css" rel="stylesheet"/>
    
    <!-- Datepicker Files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    
    <!-- Bootstrap Togle Files -->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">    

     <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


  
    @yield('estilo')
    


</head>
<body style="background-color:{{ $empresa->fodocolor }};">
    <div id="app" >
        <nav class="navbar navbar-expand-md navbar-light shadow-sm  sticky-top" style="background-color:{{ $empresa->navvar }};">
            <div class="container">
                <a class="navbar-brand nav-link text-white" href="{{ url('/') }}">


                    <img src="{{ URL::asset("/img/logo.png") }}" alt="..." class=" rounded-circle d-inline" style="width:40px;height:40px;">
                    <h3 class="d-inline  p-0 "><span style="color:{{ $empresa->colletraenca }}; font-size:1rem;">{{ $nombreEmpresa }}</span></h3>
                    
                    
                </a>


                  <button class="navbar-toggler  d-md-none collapsed p-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>                  


                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="{{ activeMenu('categorias*') }}" >
                            @if (auth()->check())
                                @if(Auth::user()->empresa_id > 0)     
                                    {{--  <a href="" class="nav-link text-white" >{{ Auth::user()->empresa_id }}</a>  --}}
                                @endif
                            @endif
                        </li>

                        @if (auth()->check()) 

                            @if(auth()->user()->claseusr == 0) 
                                
                                 @if(Auth::user()->empresa_id > 0 and Auth::user()->empresa_id == 50000)  
                                    <li class="{{ activeMenu('categorias*') }}" >
                                        
                                        <a href="{{ url('/categoriasadmin') }}" class="nav-link"  style="color:{{ $empresa->colletramenu }};">Categorias</a>

                                    </li>

                                    
                                    <li class="{{ activeMenu('productos*') }}" >
                                        
                                        <a href="{{ url('/productos') }}" class="nav-link " style="color:{{ $empresa->colletramenu }};">Productos</a>
                                    </li>
                                    <li class="{{ activeMenu('pedidos*') }}" >
                                        
                                        <a href="{{ url('/orders') }}" class="nav-link" style="color:{{ $empresa->colletramenu }};">Pedidos</a>
                                    </li>
                                    <li class="{{ activeMenu('reservas*') }}" >
                                        
                                        <a href="{{ url('/reservas') }}" class="nav-link" style="color:{{ $empresa->colletramenu }};">Reservas</a>
                                    </li>
                                @endif                                  
                                @if(Auth::user()->empresa_id > 0)  

                                        @if( Auth::user()->empresa_id == 50000) 
                                            <li class="{{ activeMenu('users*') }}" >
                                                
                                                <a href="{{ url('/empresas') }}" class="nav-link" style="color:{{ $empresa->colletramenu }};">Empresa</a>
                                            </li>
                                        @endif
                                        <li >
                                            
                                            <a href="#" class="estado-emp nav-link " data-type="select" data-pk="{{ Auth::user()->empresa_id }}" 
                                                data-url="{{ url("/empresasestado/".Auth::user()->empresa_id) }}" 
                                                data-title="estado"
                                                data-value="{{ $estado }}"
                                                data-name="estado" style="color:{{ $empresa->colletramenu }};">
                                            </a>
                                            
                                        </li>
                                        <li class="{{ activeMenu('users*') }} inline" >

                                            <a href="{{ url('/notifications') }}" class="nav-link" style="color:{{ $empresa->colletramenu }};">Nuevo Pedido 

                                                 <span id="notif" class="no-padding">

                                                 </span>
    
                                            </a>
                                        </li>                                        
                                @endif                                  
                            @endif

                        @endif 

                        @guest

                            {{--  @if ($estado == 1)
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ route('login') }}" style="color:{{ $empresa->colletramenu }};">{{ __('Iniciar Sesión') }}</a>
                                </li>

                            @endif


                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ route('register') }}" style="color:{{ $empresa->colletramenu }};">{{ __('Registrar') }}</a>
                                </li>
                            @endif  --}}
                        @else

                        @if (auth()->check()) 

                            @if(auth()->user()->claseusr > 0)       


                                <li class="nav-item dropdown collapsed" id="navbarDropdown">

                                    @if( $tipoCarrito <> 'Reserva')
                                    
                                        @if( $articulosCount>0)
                                            {{-- <a id="beep" href="{{ URL::asset("/storage/song.mp3") }}">Play Song</a> --}}
                                            @if( $estadoOrd <> "Aprobado")
                                                <h4>
                                                    <a href="{{url('/carrito')}}" class="nav-link text-white" >
                                                        {{--  Mi Carrito  --}}
                                                        <i class="fas fa-shopping-cart text-white"></i>
                                                        <span class="badge badge-secondary badge-pill bg-light text-dark">
                                                            {{ $articulosCount }}
                                                        </span>
                                                    </a>
                                                </h4>
                                            @endif
                                        @else
                                            <h4>
                                                <i class="fas fa-shopping-cart text-white"></i>
                                                
                                                <span class="badge badge-secondary badge-pill bg-light text-dark">
                                                    {{ $articulosCount }}
                                                </span>
                                            </h4>
                                        @endif
                                    @endif
                                   
                                </li>  
                            @endif
                        @endif
                            @if( $estadoOrd <> "Aprobado")
                                <li class="nav-item ml-2 mt-1">
                                
                 
                                    <a class="pt-0" style="color:{{ $empresa->colletramenu }};" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();" style="color:{{ $empresa->colletramenu }};">
                                         Cancelar Pedido
                                     </a>
                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            @endif
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main >
           

            
            @yield('content')




            <header>

                <?php function activeMenu($url){
                        return request()->is($url) ? 'active' : '';
                        alert("hey");
                    }
                ?>

                <br>

            </header>
        </main>






        <footer class="page-footer  fixed-bottom ">

            <div style="background-color: {{ $empresa->footercolor }};">
              
                <div class="row justify-content-center align-items-center">
                    <div class="col-md text-center ">
                        <img src="{{ URL::asset("/img/letrero.jpg") }}"  >
                    </div>
        

                    <div class="col-md text-center">
                        Dirección: {{ $empresa->direccion }}
                    </div>
                    <div class="col-md text-center">
                        Teléfono: {{ $empresa->telefono }}
                    </div>
                </div>
            </div>

        </footer>
        <!-- Footer -->
        


    </div>

      <script type="text/javascript">
        
        var auto_refresh = setInterval(
            function(){
                $("#notif").load("<?php echo url('notificador'); ?>").fadeIn("slow"); 
                
            },1000);


    </script>  



    <script src="{{ asset('js/app.js') }}"></script>

<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/js/material.min.js"></script>

<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>



<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/js/ripples.min.js"></script>

<!-- Bootstrap Togle Files --> 
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<!-- Datepicker Files -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>

<!-- X-editable -->
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jqueryui-editable/js/jqueryui-editable.min.js"></script>


<!-- Play Sound  <script type="text/javascript" src="http://mediaplayer.yahoo.com/js"></script>  -->






@yield('scripts')



<script type="text/javascript">
    $.fn.editable.defaults.mode = 'inline';
    $.fn.editable.defaults.ajaxOptions = {type: "PUT"};


    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });
    $('.estado-emp').editable({
        source: [
            {value: '1', text: 'Activo'}, 
            {value: '0', text: 'Inactivo'}
        ]
    });    
 



</script>


</body>
</html>
