<?php

namespace App\Http\Controllers;
use App\Models\Docente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocenteController extends Controller
{
    public function index()
    {
        $docente = Docente::all();
        return view('docente.index',compact('docente'));
    }

    public function create()
    {
        return view('docente.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>'required|string',
            'apellidos'=>'string',
            'email'=>'string',
            'telefono'=>'string',
            'rol'=>'required|in:tutor,asesor',       
        ]);
        Docente::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'rol' => $request->rol,
        ]);

        return redirect()->route('docente.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $docente = Docente::findOrFail($id);
        return view('docente.edit', compact('docente'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre'=>'required|string',
            'apellidos'=>'string',
            'email'=>'string',
            'telefono'=>'string',
            'rol'=>'required|in:tutor,asesor',       
        ]);
        
        // Encontrar el docente existente
        $docente = Docente::findOrFail($id);
        // Verificar si hay un nuevo archivo PDF
        $docente->update([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'rol' => $request->rol,
        ]);

        return redirect()->route('docente.index');
    }

    public function destroy(string $id)
    {
        $docente = Docente::findOrFail($id);
        $docente->delete();

        return redirect()->route('docente.index');
    }
}
