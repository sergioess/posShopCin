
        
{!! Form::open(['method' => $method, 'url' => $url, 'class' => 'form-horizontal']) !!}

    {!! csrf_field() !!}



    <div class="form-group">
        {{ Form::text('codarticulo',$articulo->codarticulo,['class' => 'form-control', 'placeholder' => 'Codigo del Artículo']) }}
    </div>

    <div class="form-group">
        {{ Form::text('referencia',$articulo->referencia,['class' => 'form-control', 'placeholder' => 'Referencia del Artículo']) }}
    </div>

    <div class="form-group">
        {{ Form::text('descripcion',$articulo->descripcion,['class' => 'form-control', 'placeholder' => 'Descripción del Artículo']) }}
    </div>

    <div class="form-group ">
        Descipcion: 
        <p>
            <textarea class="form-control" name="descripcion2" rows="3"></textarea>
        </p>
    </div>  

    <div class="form-group">
        {{ Form::text('precio',$articulo->precio,['class' => 'form-control', 'placeholder' => 'Precio de Venta']) }}
    </div>
    
    

    <div class="form-group text-right">
        <a href="{{url('/articulos')}}"> Regresar</a>
        <input type="submit" value="Enviar" class="btn btn-success btn-sm">
    </div>


        
{!! Form::close() !!}