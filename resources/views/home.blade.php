

@extends('layouts.app')

@section('content')
<br>
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ Cookie::get('namecompany') }}

                    <div class="row">
                        <div class="table-responsive">
                            <table class="table ">
                                <tbody>
                                    <tr style="background-color:#FEF7F1">
                                        <td>
                                            <div class="text-center">

                                                
                                                <img src="{{ URL::asset("/img/logo.png") }}" class="img-fluid" alt="">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
                    <div class="row">

                        <hr>
{{--                         <div class="col-md-4">
                            <a href="{{url('/domicilios')}}" class="btn nav-link btn-outline-primary">Domicilio</a>
                        </div> --}}


                        @if(Auth::user()->claseusr == 0)
                            {{--  <div class="col-md-12  text-center">
                                <form method="POST" action="{{ route('domicilio.update', '0') }}">
                                    {!! method_field('PUT') !!}
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="empresa_id" value="{{  $_COOKIE["idcompany"] }}">
                                
        
                                    <button class="btn nav-link btn-outline-primary btn-block  btn-lg" type="submit" >Iniciar</button>
                                    
                            
                                </form>

                            </div>  --}}

                            @php
                                header("Location: " . URL::to('/categoriasadmin'), true, 302);
                                exit();
                            @endphp

                            {{--  <script>window.location = "{{ route('categoriasadmin.index') }}";</script>
                            <?php exit; ?>  --}}
                        @else

                            {{-- <div class="col-md-4  text-center mt-2"> --}}
                            @if(Auth::user()->claseusr <> 4)
                                <div class="col-md-4 text-center mt-2">
                            @else
                                <div class="col-md-6 text-center mt-2">
                            @endif                                
                                <form method="POST" action="{{ route('domicilio.update', '1') }}">
                                    {!! method_field('PUT') !!}
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="empresa_id" value="{{  $_COOKIE["idcompany"] }}">
                                
        
                                    <button class="btn nav-link btn-outline-primary btn-block  btn-lg" type="submit" >Domicilio</button>
                                    
                            
                                </form>
    
                            </div>
    
                            @if(Auth::user()->claseusr <> 4)
                                <div class="col-md-4 text-center mt-2">
                            @else
                                <div class="col-md-6 text-center mt-2">
                            @endif
                                {{-- <a href="{{url('/enmesa')}}" class="btn nav-link btn-outline-secondary">En Mesa</a> --}}
                                <form method="POST" action="{{ route('enmesa.update', '1') }}">
                                    {!! method_field('PUT') !!}
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="empresa_id" value="{{  $_COOKIE["idcompany"] }}">
                                
        
                                    <button class="btn  btn-outline-secondary btn-block btn-lg" type="submit" >Mesa</button>
                                    
                            
                                </form>                            
                            </div>
                            @if(Auth::user()->claseusr <> 4)
                                <div class="col-md-4 mt-2">
                                    {{-- <a href="{{url('/reserva')}}" class="btn nav-link btn-outline-dark">Reserva</a> --}}
                                    <form method="POST" action="{{ route('reserva.update', '1') }}">
                                        {!! method_field('PUT') !!}
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="empresa_id" value="{{  $_COOKIE["idcompany"] }}">
                                    
            
                                        <button class="btn btn-outline-dark btn-block  btn-lg" type="submit" >Reserva</button>
                                        
                                
                                    </form>                              
                                </div>                        
                            @endif
                        @endif
                    



                    </div>
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
