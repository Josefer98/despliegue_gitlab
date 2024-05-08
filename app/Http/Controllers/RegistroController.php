<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;

class RegistroController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:estudiantes,email',
            'password' => 'required|string|min:8',
            'curso' => 'required|integer|between:1,9', // Restricción del curso
            'cu' => 'required|string|regex:/^\d{3}-\d{2}$/|unique:estudiantes,cu', // Restricción del carnet universitario
        ]);

        // Crear el estudiante en la base de datos
        Estudiante::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'curso' => $request->curso,
            'cu' => $request->cu,
        ]);

        // Redirigir a la página de inicio o a donde desees
        return redirect()->route('home')->with('success', 'Registro exitoso. ¡Bienvenido!');
    }

    public function create()
    {
        return view('estudiante.registro');
    }

}
