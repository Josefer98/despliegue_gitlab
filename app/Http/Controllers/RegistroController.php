<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegistroController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Agrega la validación para el campo de correo electrónico
            'password' => 'required|string|min:8',
        ]);

        // Crear el usuario en la base de datos
        User::create([
            'name' => $request->name,
            'email' => $request->email, // Incluye el campo de correo electrónico
            'password' => bcrypt($request->password), // Recuerda cifrar la contraseña
        ]);

        // Redirigir a la página de inicio o a donde desees
        return redirect()->route('home')->with('success', 'Registro exitoso. Bienvenido!');
    }



    public function create()
    {
        return view('estudiante.registro');
    }



}
