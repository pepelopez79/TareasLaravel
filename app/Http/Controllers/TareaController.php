<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;
use App\Models\Categoria;
use App\Models\User;

class TareaController extends Controller
{
    public function listar(Request $request)
    {
        $estado = $request->input('estado');
        $fecha = $request->input('fecha');
        $orden = $request->input('orden', 'asc');
        $userId = session('user_id');
        $usuario = User::find($userId);

        $tareasQuery = Tarea::query();

        if ($usuario && $usuario->rol === 'admin') {
            if ($estado) {
                $tareasQuery->where('estado', $estado);
            }
            if ($fecha) {
                $tareasQuery->whereDate('created_at', $fecha);
            }
        } elseif ($usuario) {
            $tareasQuery->where('usuario_id', $userId);
            if ($estado) {
                $tareasQuery->where('estado', $estado);
            }
            if ($fecha) {
                $tareasQuery->whereDate('created_at', $fecha);
            }
        } else {
            abort(404, 'Usuario no encontrado');
        }

        $tareasQuery->orderBy('created_at', $orden);
        $tareas = $tareasQuery->paginate(4)->appends($request->except('page'));

        return view('tareas.listar', compact('tareas', 'estado', 'fecha', 'orden'));
    }

    public function mostrar($id)
    {
        $tarea = Tarea::find($id);

        if (!$tarea) {
            abort(404);
        }

        return view('tareas.mostrar', compact('tarea'));
    }   

    public function crear()
    {
        $categorias = Categoria::all();
        return view('tareas.crear', compact('categorias'));
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'contenido' => 'required',
            'categoria_id' => 'required',
            'prioridad' => 'required',
            'lugar' => 'required',
            'estado' => 'required',
        ], [
            'titulo.required' => 'El campo título es obligatorio.',
            'contenido.required' => 'El campo contenido es obligatorio.',
            'categoria_id.required' => 'Debes seleccionar una categoría.',
            'prioridad.required' => 'El campo prioridad es obligatorio.',
            'lugar.required' => 'El campo lugar es obligatorio.',
            'estado.required' => 'El campo estado es obligatorio.',
        ]);

        $tarea = new Tarea();
        
        $tarea->titulo = $request->input('titulo');
        $tarea->contenido = $request->input('contenido');
        $tarea->categoria_id = $request->input('categoria_id');
        $tarea->prioridad = $request->input('prioridad');
        $tarea->lugar = $request->input('lugar');
        $tarea->estado = $request->input('estado');
        $tarea->usuario_id = $request->input('usuario_id');

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombre_original = $imagen->getClientOriginalName();
            $extension = $imagen->getClientOriginalExtension();
            $nombre_imagen = time() . '_' . pathinfo($nombre_original, PATHINFO_FILENAME) . '.' . $extension;
            $imagen->move(public_path('images'), $nombre_imagen);
            $tarea->imagen = $nombre_imagen;
        }        
        
        $tarea->save();

        return redirect()->route('tareas.listar')->with('success', 'tarea creada correctamente');
    }     

    public function editar($id)
    {
        $tarea = Tarea::findOrFail($id);
        $categorias = Categoria::all();
        return view('tareas.editar', compact('tarea', 'categorias'));
    }

    public function actualizar(Request $request, $id)
{
    $request->validate([
        'titulo' => 'required',
        'contenido' => 'required',
        'categoria_id' => 'required',
        'prioridad' => 'required',
        'lugar' => 'required',
        'estado' => 'required',
    ], [
        'titulo.required' => 'El campo título es obligatorio.',
        'contenido.required' => 'El campo contenido es obligatorio.',
        'categoria_id.required' => 'Debes seleccionar una categoría.',
        'prioridad.required' => 'El campo prioridad es obligatorio.',
        'lugar.required' => 'El campo lugar es obligatorio.',
        'estado.required' => 'El campo estado es obligatorio.',
    ]);

    $tarea = Tarea::findOrFail($id);
    
    $tarea->titulo = $request->input('titulo');
    $tarea->contenido = $request->input('contenido');
    $tarea->categoria_id = $request->input('categoria_id');
    $tarea->prioridad = $request->input('prioridad');
    $tarea->lugar = $request->input('lugar');
    $tarea->estado = $request->input('estado');

    if ($request->hasFile('imagen')) {
        $imagen = $request->file('imagen');
        $nombre_original = $imagen->getClientOriginalName();
        $extension = $imagen->getClientOriginalExtension();
        $nombre_imagen = time() . '_' . pathinfo($nombre_original, PATHINFO_FILENAME) . '.' . $extension;
        $imagen->move(public_path('images'), $nombre_imagen);
        $tarea->imagen = $nombre_imagen;
    } 
    
    $tarea->save();

    return redirect()->route('tareas.listar')->with('success', 'Tarea actualizada correctamente');
}


    public function eliminar($id)
    {
        $tarea = Tarea::findOrFail($id);
        return view('tareas.eliminar', compact('tarea'));
    }

    public function borrar($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->delete();
        
        return redirect()->route('tareas.listar')->with('success', 'tarea eliminada correctamente');
    }
}

