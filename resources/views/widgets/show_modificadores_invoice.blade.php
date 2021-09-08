@if($modificadores)

    <tr>
        <td></td>
        <td colspan="3">

                @foreach ($modificadores as $modificador)
      
                    @foreach ($modarticulos as $modarticulo)
                        @if ($modificador->id == $modarticulo->modinart)
                            <label class="checkbox-inline">
                                {{$modificador->descripcion}}
                            </label>
                        @endif
                    @endforeach 

                @endforeach 
        </td>

    </tr>  

@endif