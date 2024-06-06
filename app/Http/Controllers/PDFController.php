<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use App\Models\Tarea;
use App\Models\User;

class PDFController extends Controller
{
    public function generarPDF(Request $request)
    {
        $userId = $request->session()->get('user_id');

        $usuario = User::find($userId);

        if ($usuario && $usuario->rol === 'admin') {
            $tareas = Tarea::all();
        } elseif ($usuario) {
            $tareas = Tarea::where('usuario_id', $userId)->get();
        } else {
            abort(404, 'Usuario no encontrado');
        }
        
        $html = view('tareas.pdf', compact('tareas'))->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream('tareas.pdf');
    }
}
