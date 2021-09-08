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

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;1,300&display=swap" rel="stylesheet">

        
        <!-- Bootstrap Togle Files -->
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

        <!-- Material Design Bootstrap -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">    

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    </head>
    <body style="background-color:{{ $empresa->navvar }};">
        

        <main >
            <div class="container">
                <br>
                <br>
                <div class="row justify-content-center">

                    {!! Form::open(['method' => 'POST', 'route' => 'encuesta.store', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}

                        {!! csrf_field() !!}


                        <div class="col-md-10">
                        
                            
                            <div class="card rounded px-3 bg-white" >
                                <div class="card-header text-center mt-3 ">
                                    <h3>Encuesta Estado de Salud</h3> 
                                </div>
                                <br>



                                <div class="form-group row">
                                    <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                    <div class="col-md-6">
                                        <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" >

                                        @error('nombre')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>  
                            
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo Electrónico') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="encuesta px-3 d-block " style="background-color:{{ $empresa->colletraenca }};">
                                    <br>
                                    <div class="panel p-2 bg-white" >
                                        <div class="">
                                            <p class="">¿Has estado en contacto estrecho (cercano), sin usar elementos de protección, por más de 15 minutos con una 
                                                persona con diagnóstico confirmado de COVID-19? o ¿has estado compartiendo el mismo lugar por más de 120 
                                                minutos con una persona con diagnóstico confirmado de COVID-19?
                                            </p>
                                        </div>

                                    <br>
                                        <div class="col-sm  text-center ">
                                            <input type="radio" id="si" name="contacto" value="si">
                                            <label for="si">Si</label>
                                            <input type="radio" id="no" checked name="contacto" value="no">
                                            <label for="no">No</label>
                                        </div>
                                    </div>
                                

                                    <div class="">
                                        
                                        <div class="row p-0 mt-3">
                                            <div  class="col px-md-6 ">
                                                <div  class="encuesta p-1  ">
                                                    <div class="row d-inline w-100 ml-0">
                                                        <div class="col-sm  text-center">
                                                            <label>Fiebre de 37.5°C o más</label>
                                                        </div>
                                                        <div class="col-sm  text-center">
                                                            <input type="radio" id="si" name="fiebre" value="si">
                                                            <label for="si">Si</label>
                                                            <input type="radio" id="no" checked name="fiebre" value="no">
                                                            <label for="no">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div  class="col px-md-6 ">
                                                <div  class="encuesta p-1  ">
                                                    <div class="row d-inline w-100 ml-0">
                                                        <div class="col-sm  text-center">
                                                            <label>Tos</label>
                                                        </div>
                                                        <div class="col-sm  text-center">
                                                            <input type="radio" id="si" name="tos" value="si">
                                                            <label for="si">Si</label>
                                                            <input type="radio" id="no" checked name="tos" value="no">
                                                            <label for="no">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>
                                        <div class="row p-0  mt-3">

                                            <div  class="col px-md-6 ">
                                                <div  class="encuesta p-1  ">
                                                    <div class="row d-inline w-100 ml-0">
                                                        <div class="col-sm  text-center">
                                                            <label>Dificultad para respirar</label>
                                                        </div>
                                                        <div class="col-sm  text-center">
                                                            <input type="radio" id="si" name="dificultad" value="si">
                                                            <label for="si">Si</label>
                                                            <input type="radio" id="no" checked name="dificultad" value="no">
                                                            <label for="no">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div  class="col px-md-6 ">
                                                <div  class="encuesta p-1  ">
                                                    <div class="row d-inline w-100 ml-0">
                                                        <div class="col-sm  text-center">
                                                            <label>Fatiga o decaimiento</label>
                                                        </div>
                                                        <div class="col-sm  text-center">
                                                            <input type="radio" id="si" name="fatiga" value="si">
                                                            <label for="si">Si</label>
                                                            <input type="radio" id="no" checked name="fatiga" value="no">
                                                            <label for="no">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
            


                                        </div>
                                        <div class="row p-0  mt-3 mb-3">



                                            <div  class="col px-md-6 ">
                                                <div  class="encuesta p-1  ">
                                                    <div class="row d-inline w-100 ml-0">
                                                        <div class="col-sm  text-center">
                                                            <label>Dolor de garganta</label>
                                                        </div>
                                                        <div class="col-sm  text-center">
                                                            <input type="radio" id="si" name="dolor" value="si">
                                                            <label for="si">Si</label>
                                                            <input type="radio" id="no" checked name="dolor" value="no">
                                                            <label for="no">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div  class="col px-md-6 ">
                                                <div  class="encuesta p-1  ">
                                                    <div class="row d-inline w-100 ml-0">
                                                        <div class="col-sm  text-center">
                                                            <label>Disminución del sentido del gusto</label>
                                                        </div>
                                                        <div class="col-sm  text-center">
                                                            <input type="radio" id="si" name="gusto" value="si">
                                                            <label for="si">Si</label>
                                                            <input type="radio" id="no" checked name="gusto" value="no">
                                                            <label for="no">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
            


                                        </div>
                                                                                        
            
                                    </div>
                                </div>
                                <br>
                                <input type="hidden" value="{{ $empresa->id }}"  name="empresa_id">
                                <div class="form-group ">
                                    <input type="submit" value="Enviar" class="btn  btn-block text-white" style="background-color:{{ $empresa->navvar }};">
                                </div>
                            </div>

                        </div>


                    {!! Form::close() !!}
                </div>
            </div>
        </main>
        <br>
        <br>


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

    </body>
</html>
