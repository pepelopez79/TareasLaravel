@extends('layouts.plantilla')

@section('titulo', 'Listado de Tareas')

@section('contenido')
    <div class="botones">
        <a href="{{ url('tareas/crear') }}" class="boton boton-nuevo">Nuevo</a>
        <div class="buscador">
            <form id="filterForm" action="{{ route('tareas.listar') }}" method="GET">
                <select name="estado" class="input-busqueda" id="estadoSelect">
                    <option value="" selected disabled>Seleccionar estado</option>
                    <option value="Pendiente" {{ request('estado') == "Pendiente" ? "selected" : "" }}>Pendientes</option>
                    <option value="En Proceso" {{ request('estado') == "En Proceso" ? "selected" : "" }}>En Proceso</option>
                    <option value="Completada" {{ request('estado') == "Completada" ? "selected" : "" }}>Completadas</option>
                </select>
                <input type="text" name="fecha" placeholder="Introduce una fecha" value="{{ request('fecha') }}" class="input-busqueda datepicker" id="fechaInput">
                <a href="{{ route('tareas.listar') }}" class="boton-quitar-filtros">Quitar Filtros</a>
            </form>
        </div>
        @if ($tareas->lastPage() > 1)
            <ul class="pagination">
                @for ($i = 1; $i <= $tareas->lastPage(); $i++)
                    <li class="page-item {{ $i == $tareas->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $tareas->url($i) . '&' . http_build_query(request()->except('page')) }}">{{ $i }}</a>
                    </li>
                @endfor
            </ul>
        @endif
        <a href="{{ route('tareas.pdf') }}" class="boton boton-imprimir">Imprimir</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Contenido</th>
                <th>Imagen</th>
                <th>Categoría</th>
                <th>Prioridad</th>
                <th>Lugar</th>
                <th>Estado</th>
                <th>
                    Fecha de Creación
                    @if ($orden == 'asc')
                        <a href="{{ route('tareas.listar', array_merge(request()->all(), ['orden' => 'desc'])) }}" class="sort-icon desc"></a>
                    @else
                        <a href="{{ route('tareas.listar', array_merge(request()->all(), ['orden' => 'asc'])) }}" class="sort-icon asc"></a>
                    @endif
                </th>
                <th>Operaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tareas as $tarea)
                <tr>
                    <td>{{ $tarea->titulo }}</td>
                    <td>{!! $tarea->contenido !!}</td>
                    <td><img src="{{ asset('images/' . $tarea->imagen) }}" class="image"></td>
                    <td>{{ $tarea->categoria->nombre }}</td>
                    <td>{{ $tarea->prioridad }}</td>
                    <td>{{ $tarea->lugar }}</td>
                    <td>{{ $tarea->estado }}</td>
                    <td>{{ $tarea->created_at }}</td>
                    <td>
                        <div>
                            <a href="{{ url('tareas/mostrar/' . $tarea->id) }}">Detalle</a>
                        </div>
                        <div>
                            <a href="{{ url('tareas/editar/' . $tarea->id) . '?' . http_build_query(request()->except('page')) }}">Editar</a>
                        </div>
                        <div>
                            <a href="{{ url('tareas/eliminar/' . $tarea->id) . '?' . http_build_query(request()->except('page')) }}">Eliminar</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        document.getElementById('estadoSelect').addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });

        document.getElementById('fechaInput').addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
    </script>
@endsection
