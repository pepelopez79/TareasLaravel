<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('auth/login');
});

Route::get('login', [AuthController::class, 'loginFormulario'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('password', [AuthController::class, 'recuperarContrasenaFormulario'])->name('password');
Route::post('password', [AuthController::class, 'recuperarContrasena'])->name('passwordRequest');

Route::get('tareas/pdf', [PDFController::class, 'generarPDF'])->name('tareas.pdf');
Route::get('tareas/listar', [TareaController::class, 'listar'])->name('tareas.listar');
Route::get('tareas/mostrar/{id}', [TareaController::class, 'mostrar']);
Route::get('tareas/crear', [TareaController::class, 'crear']);
Route::post('tareas/guardar', [TareaController::class, 'guardar'])->name('tareas.guardar');
Route::get('tareas/editar/{id}', [TareaController::class, 'editar']);
Route::put('tareas/actualizar/{id}', [TareaController::class, 'actualizar'])->name('tareas.actualizar');
Route::get('tareas/eliminar/{id}', [TareaController::class, 'eliminar'])->name('tareas.eliminar');
Route::delete('tareas/borrar/{id}', [TareaController::class, 'borrar'])->name('tareas.borrar');
