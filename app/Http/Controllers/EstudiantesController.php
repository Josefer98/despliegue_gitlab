<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\Temas;
use Carbon\Carbon;

class EstudiantesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estudiantes = Estudiante::all(); // Obtener todos los estudiantes
        $temas = Temas::where('id_tema', 2)->get();
        return view('admin.usuarios.index', compact('estudiantes', 'temas')); // Pasar la variable $estudiantes a la vista

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
            'email' => 'required|string|email|max:255|unique:estudiantes',
            'password' => 'required|string|min:8',
            'curso' => 'required|integer|between:1,9', // Restricción del curso
            'cu' => 'required|string|regex:/^\d{3}-\d{2}$/' // Restricción del carnet universitario
        ]);

        // Crear un nuevo estudiante
        $estudiante = new Estudiante([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Recuerda cifrar la contraseña
            'curso' => $request->curso,
            'cu' => $request->cu
        ]);

        // Guardar el estudiante en la base de datos
        $estudiante->save();

        // Redireccionar a la lista de estudiantes
        return redirect()->route('usuarios.index')->with('success', 'Estudiante creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Estudiante $estudiante)
    {
        #return view('admin.estudiantes.show', compact('estudiante'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $estudiante = Estudiante::findOrFail($id);
        return view('admin.usuarios.edit', compact('estudiante'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:estudiantes,email,' . $id,
            'password' => 'nullable|string|min:8',
            'curso' => 'required|integer|between:1,9', // Restricción del curso
            'cu' => 'required|string|regex:/^\d{3}-\d{2}$/' // Restricción del carnet universitario
        ]);
        $estudiante = Estudiante::findOrFail($id);
        $estudiante->name = $request->name;
        $estudiante->email = $request->email;
        if ($request->has('password')) {
            $estudiante->password = bcrypt($request->password);
        }
        $estudiante->curso = $request->curso;
        $estudiante->cu = $request->cu;
        $estudiante->save();

        return redirect()->route('usuarios.index')->with('success', 'Estudiante actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $estudiante = Estudiante::findOrFail($id);
        $estudiante->delete();

        return redirect()->route('usuarios.index')->with('success', 'Estudiante eliminado correctamente.');
    }

    public function asignarTema($id)
    {
        // Simulamos una consulta para obtener el usuario por su ID
        $estudiante = Estudiante::find($id);

        // Obtener todos los temas disponibles
        $temasDisponibles = Temas::where('estado', 'libre')->get();

        // Retornar vista con datos necesarios
        return view('admin.usuarios.asignar-tema', compact('estudiante', 'temasDisponibles'));

    }

    // Método para asignar el tema seleccionado al usuario
    public function asignarTemaAction(Request $request, string $id)
    {
        //dd($request->all())
        // Validar los datos del formulario
        $request->validate([
            'tema_id' => 'required|integer',
        ]);

        // Obtener el estudiante por su ID
        $estudiante = Estudiante::findOrFail($id);
        $temas = $request->input('tema_id');

        // Verificar si el tema está siendo asignado
        if ($estudiante->tema_asignado !== $temas) {
            // Establecer la fecha de asignación como la fecha y hora actual
            $estudiante->fecha_asignacion = Carbon::now();
        }

        // Actualizar el tema asignado al estudiante
        $estudiante->tema_asignado = $temas;
        $estado = Temas::where('id_tema', $temas)->first();
        $estado->estado = 'asignado';
        $estudiante->save();
        $estado->save();
        $titulo = Temas::findOrFail($temas);

        // Redirigir al usuario a la lista de estudiantes con un mensaje de éxito
        return redirect()->route('usuarios.index')->with('success', 'Tema asignado correctamente.');

    }


    // Método para desasignar el tema actual del usuario
    public function desasignarTema($id)
    {
        // Obtener el estudiante por su ID
        $estudiante = Estudiante::find($id);
    
        // Verificar si el estudiante tiene un tema asignado
        if ($estudiante->tema_asignado !== null) {
            // Obtener el estado del tema asignado al estudiante
            $estado = Temas::where('id_tema', $estudiante->tema_asignado)->first();
    
            // Marcar el tema como "libre"
            $estado->estado = 'libre';
            $estado->save();
    
            // Actualizar la fecha de desasignación del estudiante
            $estudiante->fecha_desasignacion = Carbon::now();
            $estudiante->save();
            
            // Desasignar el tema del estudiante
            $estudiante->tema_asignado = null;
            $estudiante->save();
        }
    
        // Redirigir al usuario a la lista de estudiantes
        return redirect()->route('usuarios.index')->with('success', 'Tema desasignado correctamente.');
    }

    public function detallesRegistro($id)
    {
        // Obtener el estudiante por su ID
        $estudiante = Estudiante::findOrFail($id);
    
        // Obtener todos los estudiantes
    
        // Devolver la vista con los detalles del registro del estudiante y la lista de todos los estudiantes
        return view('admin.usuarios.detalles-registro', compact('estudiante'));
    }
    
    

}
