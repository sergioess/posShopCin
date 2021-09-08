@extends('layouts.app')


@section('tittle', 'Articulos')

@section('content')

<div class="big-padding text-center blue-grey white-text">
    <h1>Articulos</h1>
</div>

<div class"floating">
    <a href="{{url('/articulos/create')}}" class="btn btn-primary bnt-fab">
        <i class="material-icons">add</i>
    </a>
</div>

<div class="container">

    <div class="table-responsive">
        <table class="table table-striped">
        
            <thead>
                
                <tr>
                    <th>Fila</th>
                    {{--  <th>CodArticulo</th>  --}}
                    <th>Referencia</th>				
                    <th>Descripcion</th>
                    <th>Medida</th>				
                    <th>Precio</th>
{{--                      <th>Departamento</th>				
                    <th>Seccion</th>	  --}}			
                    <th>Acciones</th>				

                </tr>


            </thead>


            <tbody>
                
                @foreach ($articulos as $articulo)
                    <tr>
                        <td>  {{ $loop->iteration }}  </td>
                        {{--  <td> {{ $articulo->codarticulo }} </td>  --}}

                        <td> {{ $articulo->referencia }} </td>
                        <td> {{ $articulo->descripcion }} </td>
                        <td> {{ $articulo->medida }} </td>
                        <td> {{ $articulo->precio }} </td>
{{--                          <td> {{ $articulo->dpto }} </td>
                        <td> {{ $articulo->seccion }} </td>  --}}

                        <td> 
                                <a href="{{ route('articulos.edit', $articulo->id) }}" data-toggle="tooltip"  title="Editar Producto">
                                  <button class="btn btn-link btn-xs">
                                  <i class="fa fa-edit  fa-2x" aria-hidden="true"></i>
                                </button>
                                </a> 
{{--                             <form style="display: inline" method="POST" action="{{ route('articulos.destroy', $articulo->id) }}">
                                {!! csrf_field() !!}
                                {!! method_field('DELETE') !!}
                                <button class="btn btn-link red-text no-padding no-margin" type="submit" data-toggle="tooltip"  title="Eliminar Producto">
                                    <i class='fa fa-minus-circle fa-1x' aria-hidden="true"  onclick="return confirm('Esta seguro de elimiar este Registro?')" ></i>
                                </button>
                            </form>    --}}    


                        </td>

                    </tr>
                @endforeach
            </tbody>


        </table>
    </div>

</div>



@endsection