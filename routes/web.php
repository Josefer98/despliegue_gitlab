<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TemaController;
use App\Http\Controllers\DocenteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//Route::get('/', function () {return view('welcome');});

//autenticacion
Auth::routes();
Route::get('/', [AdminController::class, 'index'])->name('admin.index')->middleware('auth');

//inicio
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//usuarios propiedad de admin
Route::get('/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->name('usuarios.index')->middleware('auth');
Route::get('/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'create'])->name('usuarios.create')->middleware('auth');
Route::post('/admin/usuarios', [App\Http\Controllers\UsuarioController::class, 'store'])->name('usuarios.store')->middleware('auth');
Route::get('/usuarios/{usuario}/edit', [App\Http\Controllers\UsuarioController::class, 'edit'])->name('usuarios.edit')->middleware('auth');
Route::put('/usuarios/{usuario}', [App\Http\Controllers\UsuarioController::class, 'update'])->name('usuarios.update')->middleware('auth');
Route::delete('/usuarios/{usuario}', [App\Http\Controllers\UsuarioController::class, 'destroy'])->name('usuarios.destroy')->middleware('auth');
//estudiantes propio registro
Route::get('/estudiante/registro', [App\Http\Controllers\RegistroController::class, 'create'])->name('registro.create');
Route::post('/estudiante/registro', [App\Http\Controllers\RegistroController::class, 'store'])->name('registro.store');
//asignar tema
Route::get('/usuarios/{id}/asignar-tema', [UsuarioController::class, 'asignarTema'])->name('asignar-tema');

Route::post('/usuarios/{id}/asignar-tema', [UsuarioController::class, 'asignarTema'])->name('usuarios.asignar-tema');

Route::post('/usuarios/{id}/asignar-tema-action', [UsuarioController::class, 'asignarTemaAction'])->name('usuarios.asignar-tema-action');

Route::get('/usuarios/{usuario}/desasignar-tema', [UsuarioController::class, 'desasignarTema'])->name('desasignar.tema');
Route::get('/usuarios/{usuario}/detalles-registro', [UsuarioController::class, 'detallesRegistro'])->name('detalles.registro');


Route::resource('temas',TemaController::class)->middleware('auth');
Route::resource('docente',DocenteController::class)->middleware('auth');