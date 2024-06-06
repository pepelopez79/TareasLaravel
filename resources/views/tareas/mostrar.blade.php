@extends('layouts.plantilla')

@section('titulo', 'Detalle de Tarea')

@section('contenido')
    <div class="container">
        <div class="entrada">
            <div class="contenido-entrada">
                <h2 class="subtitulo-entrada">{{ $tarea->titulo }}</h2>
                <p class="texto-entrada">{!! $tarea->contenido !!}</p><br>
                <p class="info-entrada"><strong>Categoría:</strong> {{ $tarea->categoria->nombre }}</p>
                <p class="info-entrada"><strong>Prioridad:</strong> {{ $tarea->prioridad }}</p> 
                <p class="info-entrada"><strong>Lugar:</strong> {{ $tarea->lugar }}</p>
                <p class="info-entrada"><strong>Estado:</strong> {{ $tarea->estado }}</p>
                <p class="info-entrada"><strong>Fecha de Creación:</strong> {{ $tarea->created_at }}</p>
                <a href="{{ route('tareas.listar') }}" class="boton boton-volver" style="float: right; margin-top: 80px; margin-right: 30px; width: 100px;">Volver</a>
            </div>
            <div class="imagen-entrada">
                <img src="{{ asset('images/' . $tarea->imagen) }}" alt="Imagen de la tarea" class="imagen">
            </div>
        </div>
    </div>
@endsection
