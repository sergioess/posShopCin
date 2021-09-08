{{-- @extends('layout') --}}
@extends('layouts.dashboard')

@section('header')

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.bootstrap4.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.css" />
@endsection

@section('content')

    {{-- {{ dd(public_path()) }} --}}

    <div class="container">
        <h1>Listado de Productos <a href="{{ route('productos.create') }}">
                <button class="btn btn-xs btn-link" data-toggle="tooltip" title="Crear Producto"><i
                        class="fas fa-plus-circle  fa-3x  text-dark" aria-hidden="true">
                    </i></button></a></h1>



        <div class="row">

            <div class="form-group two-fields">
                <div class="input-group">
                    <form class="form-inline" method="POST" action="{{ route('productos.show2') }}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="estado" class="col-xs-12 control-label">
                                <h3>Filtro Categoria</h3>
                            </label>

                            <select class="form-control" name="categoria" id="categoria" data-toggle="tooltip"
                                title="Seleccionar una Categoria">

                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->descripcion }}</option>
                                @endforeach
                            </select>

                            <input class="btn btn-success p-2" type="submit" value="Filtrar">
                        </div>
                    </form>
                </div>

            </div>
        </div>


        <div class="table-responsive">
            <table class="table table-striped" id="example">

                <thead>

                    <tr>
                        <th>#</th>
                        {{-- <th>Id</th> --}}
                        <th>Nombre</th>
                        <th>Valor</th>
                        <th>Imagen</th>
                        <th>Visible</th>
                        <th>Editar</th>
                        <th>Opciones</th>
                        <th>Borrar</th>
                    </tr>


                </thead>


                <tbody>

                    @foreach ($productos as $producto)
                        <tr>
                            <td> {{ $loop->iteration }} </td>
                            {{-- <td> {{ $producto->id }} </td> --}}

                            <td> {{ $producto->descripcion }} </td>
                            <td> {{ $producto->precio }} </td>
                            <td> <img src="{{ URL::asset("/storage/img/articulos/$producto->imagen") }}"
                                    class="card-img-top mx-auto" style="height: 66px; width: 99px;display: block;">
                            </td>

                            <td>
                                <a href="#" class="pto-habilitado" data-type="select" data-pk="{{ $producto->id }}"
                                    data-url="{{ url("/prodcat/$producto->id") }}" data-title="Visible"
                                    data-value="{{ $producto->habilitado }}" data-name="habilitado">
                                </a>
                            </td>

                            <td>
                                <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-link btn-xs"
                                    data-toggle="tooltip" title="Editar Producto">
                                    <i class="fas fa-edit  fa-1x"></i>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('modificadores.edit', $producto->id) }}" class="btn btn-link btn-xs"
                                    data-toggle="tooltip" title="Opciones del Producto">
                                    <i class="fas fa-check-double fa-1x"></i>
                                </a>
                            </td>
                            <td>
                                {{-- Elimina Producto --}}
                                <a class="tooltip-test" title="Eliminar Producto"
                                    href="{{ route('productos.delete', $producto->id) }}">
                                    <h5><i class="fas fa-trash-alt fa-1x"></i></h5>
                                </a>



                            </td>

                        </tr>
                    @endforeach
                </tbody>


            </table>
        </div>

    </div>

    </div>

@endsection


@section('scripts')
    <script src="//cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.bootstrap4.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.colVis.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js" type="text/javascript"></script>
    <script type="text/javascript" class="init">
        $(document).ready(function() {
            $('#example').DataTable({
                responsive: true,
                "processing": true,
                select: true,
                "lengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "Todos "]
                ],
                "language": {
                    "lengthMenu": "Mostrar _MENU_ filas por página   | ",
                    "zeroRecords": "Nada encontrado - cambie el filtro",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "Buscar: ",
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Siguiente"
                    }

                },

                dom: 'Blfrtip',
                buttons: ["print", 'excelHtml5', 'pdf', 'csv', 'copy'],
            }).buttons().container().appendTo('#example_wrapper col-md-6, ml-2:eq(0)');
        });
    </script>



    <script type="text/javascript">
        $.fn.editable.defaults.mode = 'inline';
        $.fn.editable.defaults.ajaxOptions = {
            type: "PUT"
        };


        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });
        $('.pto-habilitado').editable({
            source: [{
                    value: '1',
                    text: 'Mostrar'
                },
                {
                    value: '0',
                    text: 'Ocultar'
                }
            ]
        });
    </script>

@endsection
