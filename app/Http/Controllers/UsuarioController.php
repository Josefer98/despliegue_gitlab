<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\User;

use App\Models\Temas;


class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::all();
        return view("admin.usuarios.index", ['usuarios' => $usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Crear un nuevo usuario
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Recuerda cifrar la contraseña
        ]);

        // Guardar el usuario en la base de datos
        $user->save();

        // Redireccionar a la lista de usuarios
        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $usuario = User::findOrFail($id);
        return view('admin.usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }

    public function asignarTema($id)
    {
        // Simulamos una consulta para obtener el usuario por su ID
        $usuario = User::find($id);

        // Obtener todos los temas disponibles
        $temasDisponibles = Temas::where('estado', 'libre')->get();

        // Retornar vista con datos necesarios
        return view('admin.usuarios.asignar-tema', compact('usuario', 'temasDisponibles'));

    }

    // Método para asignar el tema seleccionado al usuario
    public function asignarTemaAction(Request $request, $id)
    {
        // Simulamos una consulta para obtener el usuario por su ID
// Simulamos una consulta para obtener el usuario por su ID
        $usuario = User::find($id);

        // Asignamos el tema seleccionado al usuario
        $usuario->tema_asignado = $request->tema_id;


        // Guardamos los cambios en el usuario
        $usuario->save();

        // Redirigimos al usuario a la lista de estudiantes
        return redirect()->route('usuarios.index')->with('success', 'Tema asignado correctamente.');
    }


    // Método para desasignar el tema actual del usuario
    public function desasignarTema($id)
    {
        // Simulamos una consulta para obtener el usuario por su ID
        $usuario = User::find($id);

        // Desasignamos el tema actual del usuario
        $usuario->tema_asignado = null;

        // Guardamos los cambios en el usuario
        $usuario->save();

        // Redirigimos al usuario a la lista de estudiantes
        return redirect()->route('usuarios.index')->with('success', 'Tema desasignado correctamente.');
    }


    public function detallesRegistro($id)
    {
        // Simulamos una consulta para obtener el usuario por su ID
        $usuario = User::find($id);

        // Obtener registros detallados almacenados en la sesión
        $registros = Session::get('registros', []);

        // Retornar vista con datos necesarios
        return view('admin.usuarios.detalles-registro', compact('usuario', 'registros'));
    }
}
