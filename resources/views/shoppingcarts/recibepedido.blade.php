
@if( $articulosCount=0)
return redirect('categorias.index');
@else

@extends('layouts.app')

@section('content')

    <div class="col-12 text-center " >
        <h5 class="d-inline text-white pr-4 pl-4 pb-1 " style="border-bottom-left-radius: 20px 20px;border-bottom-right-radius: 20px 20px; background-color:#AB4A19;"><span >{{ $nombreEmpresa }}</span></h5>
    </div>
    <div class="container ">
        <br>
        <br>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-0">
                    {{--  Datos de envio  --}}
                    <br>
                    <div class="card">
                        <div class="card-header text-center  pb-4">
                            <div class="text-left">
                            
                                <div class="text-center">
                                    <h5>Cuando deseas recibir tu pedido</h5>
                                </div>

                               {!! Form::open(['method' => 'GET', 'url' => 'datosentrega', 'id'=>'theForm' ,'class' => 'form-horizontal', 'autocomplete' => 'off', 'files' => true]) !!} 

                                   


                                    <div class="form-group ">
                                        Dia: 
                                        <br>
                                        {{ Form::radio('dia', 'Martes' , false) }} Martes<br>
                                        {{ Form::radio('dia', 'Miercoles' , false) }} Miercoles<br>
                                        {{ Form::radio('dia', 'Jueves' , false) }} Jueves<br>
                                        {{ Form::radio('dia', 'Viernes' , false) }} Viernes<br>
                                        {{ Form::radio('dia', 'Sabado' , false) }} Sabado<br>
                                        {{ Form::radio('dia', 'Domingo' , false) }} Domingo<br>
                                    </div>
                                    <div class="form-group ">
                                        Hora: 
                                        <br>
                                        {{ Form::radio('hora', '8-12am' , false) }} 8-12am<br>
                                        {{ Form::radio('hora', '12-2pm' , false) }} 12-2pm<br>
                                        {{ Form::radio('hora', '2-6pm' , false) }} 2-6pm<br>
                                    </div>


                                    <div class="row justify-content-center">
                                
                                        <div class="col-6 ">
                                            <button type="submit" class="btn btn-primary btn-block  p-2 text-capitalize">
                                                 Continuar <i class="fas fa-hand-point-right"></i>
                                            </button>
                                        </div>
                                    
                                    </div>

                                    
                                {!! Form::close() !!}           
                            </div>
                            
                        </div>            
                    </div>

                    <div class="card pt-2">
                        <div class="card-header text-center p-4">
                        
                            <div class="row justify-content-center">
                                
                                <div class="col-9">
                                    <a class="btn btn-outline-primary  btn-block pb-0 white-text capitalize "  class="tooltip-test" title="Categorias" href="{{ route('categorias.index') }}">
                                        <h6><i class="fas fa-arrow-left"></i>  Sigue comprando</h6>
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
