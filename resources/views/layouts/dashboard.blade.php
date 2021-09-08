<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">


    <!-- Google Fonts -->

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;1,300&display=swap" rel="stylesheet">



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


  

    


</head>
<body>
    <div id="app" >

        <nav class="navbar navbar-dark sticky-top navbar-expand-md  p-0 flex-md-nowrap" style="background-color:{{ $empresa->navvar }};">
            <a class="navbar-brand nav-link text-white " href="{{ url('/') }}">

              <img src="{{ URL::asset("/img/logo.jpg") }}" alt="..." class="border border-dark rounded-circle d-inline" style="width:50px;height:50px;">
              <h2 class="d-inline"><span style="color:{{ $empresa->colletraenca }};">{{ $nombreEmpresa }}</span></h2>
              
              
          </a>
          <button class="navbar-toggler  d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

                <ul class="navbar-nav ml-auto ">

                        <!-- Authentication Links -->
                        <li class="{{ activeMenu('categorias*') }} text-nowrap" >
                            @if (auth()->check())
                                @if(Auth::user()->empresa_id > 0)     
                                    
                                @endif
                            @endif
                        </li>

                        @if (auth()->check()) 

                            @if(auth()->user()->claseusr == 0) 

                                 
                                @if(Auth::user()->empresa_id > 0)  

 
                                        <li class="text-right mr-3">
                                            
                                            <a href="#" class="estado-emp nav-link " data-type="select" data-pk="{{ Auth::user()->empresa_id }}" 
                                                data-url="{{ url("/empresasestado/".Auth::user()->empresa_id) }}" 
                                                data-title="estado"
                                                data-value="{{ $estado }}"
                                                data-name="estado" style="color:{{ $empresa->colletramenu }};">
                                            </a>
                                            
                                        </li>
                                        <li class="{{ activeMenu('users*') }} inline text-right mr-3" >

                                            <a href="{{ url('/notifications') }}" class="nav-link" style="color:{{ $empresa->colletramenu }};">Nuevo Pedido 

                                                 <span id="notif" class="no-padding">

                                                 </span>
    
                                            </a>
                                        </li>                                        
                                @endif                                  
                            @endif

                        @endif 



            
                @guest

                    @if ($estado == 1)
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('login') }}" style="color:{{ $empresa->colletramenu }};">{{ __('Iniciar Sesión') }}</a>
                        </li>

                    @endif


                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('register') }}" style="color:{{ $empresa->colletramenu }};">{{ __('Registrar') }}</a>
                        </li>
                    @endif
                @else
                
                <li class="nav-item dropdown  text-right mr-3">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre  style="color:{{ $empresa->colletramenu }};">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="background-color:{{ $empresa->navvar }};">
                        <a class="dropdown-item " style="color:{{ $empresa->colletramenu }};" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();" style="color:{{ $empresa->colletramenu }};">
                            {{ __('Cerrar Sessión') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
              


                
            @endguest
            
                </ul>
          </nav>  
       
{{-- 
        <nav class="navbar navbar-expand-md navbar-light sticky-top p-0 flex-md-nowrap shadow" style="background-color:{{ $empresa->navvar }};">
            <div class="container">
                <a class="navbar-brand nav-link text-white " href="{{ url('/') }}">


                    <img src="{{ URL::asset("/img/logo.jpg") }}" alt="..." class="border border-dark rounded-circle d-inline" style="width:50px;height:50px;">
                    <h2 class="d-inline"><span style="color:{{ $empresa->colletraenca }};">{{ $nombreEmpresa }}</span></h2>
                    
                    
                </a>



                <button class="navbar-toggler  d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                     <ul class="navbar-nav mr-auto">

                    </ul>  

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto ">
                        <!-- Authentication Links -->
                        <li class="{{ activeMenu('categorias*') }} text-nowrap" >
                            @if (auth()->check())
                                @if(Auth::user()->empresa_id > 0)     
                                   
                                @endif
                            @endif
                        </li>

                        @if (auth()->check()) 

                            @if(auth()->user()->claseusr == 0) 

                                 
                                @if(Auth::user()->empresa_id > 0)  

 
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

                            @if ($estado == 1)
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ route('login') }}" style="color:{{ $empresa->colletramenu }};">{{ __('Iniciar Sesión') }}</a>
                                </li>

                            @endif


                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ route('register') }}" style="color:{{ $empresa->colletramenu }};">{{ __('Registrar') }}</a>
                                </li>
                            @endif
                        @else
                            
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre  style="color:{{ $empresa->colletramenu }};">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="background-color:{{ $empresa->navvar }};">
                                    <a class="dropdown-item " style="color:{{ $empresa->colletramenu }};" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();" style="color:{{ $empresa->colletramenu }};">
                                        {{ __('Cerrar Sessión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                          
 

                            
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}


        <div class="container-fluid ">
            <div class="row">
              <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse shadow">
                <div class="sidebar-sticky pt-3">
                  <ul class="nav flex-column">

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

                             @if(Auth::user()->empresa_id > 0 and Auth::user()->empresa_id < 50000)  
                                <li class="{{ activeMenu('categorias*') }}" >
                                    
                                    <a href="{{ url('/categoriasadmin') }}" class="nav-link text-dark" >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-package"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>

                                        Categorias
                                    </a>

                                </li>

                                
                                <li class="{{ activeMenu('productos*') }}" >
                                    
                                    <a href="{{ url('/productos') }}" class="nav-link text-dark ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                        Productos
                                    </a>
                                </li>
                                <li class="{{ activeMenu('pedidos*') }}" >
                                    
                                    <a href="{{ url('/orders') }}" class="nav-link text-dark">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                                        Pedidos
                                    </a>
                                </li>
                                <li class="{{ activeMenu('reservas*') }}" >
                                    
                                    <a href="{{ url('/reservas') }}" class="nav-link text-dark " >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                                        Reservas
                                    </a>
                                </li>
                            @endif                                  
                            @if(Auth::user()->empresa_id > 0)  

                                    <li class="{{ activeMenu('users*') }}" >
                                        
                                        <a href="{{ url('/empresas') }}" class="nav-link text-dark"> 
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                            Empresa
                                        </a>
                                    </li>
                                     
                            @endif                                  
                        @endif

                    @endif 

                    @guest

                        @if ($estado == 1)
                            <li class="nav-item">
                                <a class="nav-link " href="{{ route('login') }}" style="color:{{ $empresa->colletramenu }};">{{ __('Iniciar Sesión') }}</a>
                            </li>

                        @endif


                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link " href="{{ route('register') }}" style="color:{{ $empresa->colletramenu }};">{{ __('Registrar') }}</a>
                            </li>
                        @endif
                    @else

                        @if (auth()->check()) 

                            @if(auth()->user()->claseusr > 0)       


                                <li>
                                    <h2>
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
                                                <svg class="bi" width="32" height="32" fill="currentColor">
                                                    <use xlink:href="bootstrap-icons.svg#cart3"/>
                                                </svg>
                                                <span class="badge badge-secondary badge-pill bg-light text-dark">
                                                    {{ $articulosCount }}
                                                </span>
                                            </h4>
                                        @endif
                                    </h2>
                                </li>  
                            @endif
                        @endif


                    @endguest


                  </ul>
                </div>
              </nav>
          
              <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 addScroll">

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
            </div>
          </div>


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
