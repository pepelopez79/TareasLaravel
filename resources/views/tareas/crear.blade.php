@extends('layouts.plantilla')

@section('titulo', 'Crear Tareas')

@section('contenido')
    <div class="container">
        <div class="contenedor-edicion">
            <h1>Nueva Tarea</h1>
            <div class="formulario-edicion">
                <form method="POST" action="{{ route('tareas.guardar') }}" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="titulo">Título:</label>
                        <input type="text" id="titulo" name="titulo" value="{{ old('titulo') }}">
                        @error('titulo')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="contenido">Contenido:</label>
                        <textarea id="contenido" name="contenido">{{ old('contenido') }}</textarea>
                        @error('contenido')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="categoria">Categoría:</label>
                        <select id="categoria" name="categoria_id">
                            <option value="">Seleccione una categoría</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                        @error('categoria_id')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="prioridad">Prioridad:</label>
                        <select id="prioridad" name="prioridad">
                            <option value="Baja">Baja</option>
                            <option value="Media">Media</option>
                            <option value="Alta">Alta</option>
                        </select>
                        @error('prioridad')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="lugar">Lugar:</label>
                        <input type="text" id="lugar" name="lugar" value="{{ old('lugar') }}">
                        @error('lugar')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="estado">Estado:</label>
                        <select id="estado" name="estado">
                            <option value="Pendiente">Pendiente</option>
                            <option value="En Proceso">En Proceso</option>
                            <option value="Completada">Completada</option>
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
                        <input type="hidden" name="usuario_id" value="{{ session('user_id') }}">
                    </div>
                    <div>
                        <button type="submit">Guardar</button>
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
