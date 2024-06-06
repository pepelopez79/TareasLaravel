@extends('layouts.plantilla')

@section('titulo', 'Eliminar Tarea')

@section('contenido')
    <div class="contenedor-eliminar">
        <h1>Eliminar Tarea</h1>
        <p>¿Estás seguro de que deseas eliminar la tarea "{{ $tarea->titulo }}"?</p>
        <form method="POST" action="{{ route('tareas.borrar', $tarea->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="boton" style="margin-right: 20px">Eliminar</button>
            <a href="{{ route('tareas.listar') }}" class="boton boton-cancelar">Cancelar</a>
        </form>        
    </div>
@endsection
