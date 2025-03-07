<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TemaController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\EstudiantesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//Route::get('/', function () {return view('welcome');});

//autenticacion
Auth::routes();
Route::get('/', [AdminController::class, 'index'])->name('admin.index')->middleware('auth');

//inicio
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//usuarios propiedad de admin para asignar rechazar o eliminar estudiante

Route::get('/usuarios', [App\Http\Controllers\EstudiantesController::class, 'index'])->name('usuarios.index')->middleware('auth');
Route::get('/usuarios/create', [App\Http\Controllers\EstudiantesController::class, 'create'])->name('usuarios.create')->middleware('auth');
Route::post('/usuarios', [App\Http\Controllers\EstudiantesController::class, 'store'])->name('usuarios.store')->middleware('auth');
Route::get('/usuarios/{usuario}/edit', [App\Http\Controllers\EstudiantesController::class, 'edit'])->name('usuarios.edit')->middleware('auth');
Route::put('/usuarios/{usuario}', [App\Http\Controllers\EstudiantesController::class, 'update'])->name('usuarios.update')->middleware('auth');
Route::delete('/usuarios/{usuario}', [App\Http\Controllers\EstudiantesController::class, 'destroy'])->name('usuarios.destroy')->middleware('auth');

//estudiantes propio registro
Route::get('/estudiante/registro', [App\Http\Controllers\RegistroController::class, 'create'])->name('registro.create');
Route::post('/estudiante/registro', [App\Http\Controllers\RegistroController::class, 'store'])->name('registro.store');

//asignar temas

Route::get('/usuarios/asignar-tema/{id}', [EstudiantesController::class, 'asignarTema'])->name('asignar-tema');
Route::post('/usuarios/asignar-tema/{id}', [EstudiantesController::class, 'asignarTemaAction'])->name('estudiantes.asignarTemaAction');
Route::get('/usuarios/{id}/desasignar-tema', [EstudiantesController::class, 'desasignarTema'])->name('desasignar.tema');
//detalles de registro
Route::get('/usuarios/{id}/detalles-registro', [EstudiantesController::class, 'detallesRegistro'])->name('detalles.registro');


Route::resource('temas',TemaController::class)->middleware('auth');
Route::resource('docente',DocenteController::class)->middleware('auth');