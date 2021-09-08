@if($modificadores)

    <tr>
        <td></td>
        <td colspan="3">
                
                @foreach ($modificadores as $modificador)
                <label class="checkbox-inline">
                <form method="POST" id="{{$modificador->id}}"  action="{{ route('changestatustask.update', $articulo_id) }}">
                    {!! method_field('PUT') !!}

                    {!! csrf_field() !!}                    
                    <label class="checkbox-inline">
                        <input name="modificador"  type="hidden"  value="{{$modificador->id}}" >
                        <input type="checkbox"  name="{{$modificador->id}}" 
                            @foreach ($modarticulos as $modarticulo)
                                @if ($modificador->id == $modarticulo->modinart)
                                    checked
                                @endif
                            @endforeach 
                        
                            value="{{$modificador->id}}" data-shopid="{{ $shopping_cart_id }}" data-artid="{{ $articulo_id }}" data-modid="{{ $modificador->id }}" 
                        class='modifchecker' >
                        {{$modificador->descripcion}}
                    </label>
                </form>	
            </label>
                @endforeach 
        </td>

    </tr>  

@endif

