@extends('layouts.plantilla')

@section('titulo', 'Editar Tarea')

@section('contenido')
    <div class="container">
        <div class="contenedor-edicion">
            <h1>Editar Tarea</h1>
            <div class="formulario-edicion">
                <form method="POST" action="{{ route('tareas.actualizar', $tarea->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="titulo">Título:</label>
                        <input type="text" id="titulo" name="titulo" value="{{ old('titulo', $tarea->titulo) }}">
                        @error('titulo')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="contenido">Contenido:</label>
                        <textarea id="contenido" name="contenido">{{ old('contenido', $tarea->contenido) }}</textarea>
                        @error('contenido')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="categoria">Categoría:</label>
                        <select id="categoria" name="categoria_id">
                            <option value="">Seleccione una categoría</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ old('categoria_id', $tarea->categoria_id) == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                        @error('categoria_id')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="prioridad">Prioridad:</label>
                        <select id="prioridad" name="prioridad">
                            <option value="Baja" {{ old('prioridad', $tarea->prioridad) == 'Baja' ? 'selected' : '' }}>Baja</option>
                            <option value="Media" {{ old('prioridad', $tarea->prioridad) == 'Media' ? 'selected' : '' }}>Media</option>
                            <option value="Alta" {{ old('prioridad', $tarea->prioridad) == 'Alta' ? 'selected' : '' }}>Alta</option>
                        </select>
                        @error('prioridad')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="lugar">Lugar:</label>
                        <input type="text" id="lugar" name="lugar" value="{{ old('lugar', $tarea->lugar) }}">
                        @error('lugar')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="estado">Estado:</label>
                        <select id="estado" name="estado">
                            <option value="Pendiente" {{ old('estado', $tarea->estado) == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="En Proceso" {{ old('estado', $tarea->estado) == 'En Proceso' ? 'selected' : '' }}>En Proceso</option>
                            <option value="Completada" {{ old('estado', $tarea->estado) == 'Completada' ? 'selected' : '' }}>Completada</option>
                        </select>
                        @error('estado')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="imagen">Imagen:</label>
                        <input type="file" id="imagen" name="imagen">
                        @error('imagen')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <button type="submit">Guardar Cambios</button>
                        <a href="{{ route('tareas.listar') }}" class="boton boton-volver">Volver</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#contenido'))
            .catch(error => {
                console.error(error);
            });
    </script>    
@endsection
