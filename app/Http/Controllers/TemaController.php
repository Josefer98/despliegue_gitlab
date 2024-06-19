<?php

namespace App\Http\Controllers;

use App\Models\Temas;
use App\Models\Estudiante;
use App\Models\Docente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TemaController extends Controller
{
    public function index(Request $request)
    {
        $busqueda = $request->busqueda;

        $temas = Temas::query();

        if ($busqueda) {
            // Buscar tutor en la tabla Docentes
            $tutor = Docente::where('nombre', 'LIKE', '%' . $busqueda . '%')
                            ->orWhere('apellidos','LIKE', '%' . $busqueda . '%')
                            ->where('rol', 'tutor')
                            ->first();;
            // Si se encontró un tutor, filtrar por el ID del tutor
            if ($tutor) {
                $temas->where('docente_id', $tutor->id_docente);
            }else{
                // Filtrar por palabras clave, título o estado
                $temas->where('palabras_clave', 'LIKE', '%' . $busqueda . '%')
                        ->orWhere('titulo', 'LIKE', '%' . $busqueda . '%')
                        ->orWhere('estado', $busqueda);
            }
        }

        $temas = $temas->get();

        if ($temas->isEmpty()) {
            $temas = Temas::all();
        }

        return view('temas.index', compact('temas'));
    }

    public function create()
    {
        // Obtener todos los docentes con rol de "tutor"
        $docentesTutor = Docente::where('rol', 'tutor')->get();
        return view('temas.create', compact('docentesTutor'));
    }

    public function store(Request $request)
    {
        // Obtener el valor de docente_id del formulario
        $pdfPath = ' '; // Inicializar la variable de ruta del PDF
        $docenteId = $request->input('docente_id');
        $request->validate([
            'titulo'=>'required|string',
            'area'=>'required|string',
            'palabras_clave'=>'string',
            'docente_id'=>'required|integer|min:1',
            'estado'=>'required|in:libre,asignado,terminado',
            'descripcion'=>'string',
            'pdfFile' => 'file|mimes:pdf'
            
        ]);

        // Verificar si hay un nuevo archivo PDF
        if ($request->hasFile('pdfFile')) {
            // Eliminar el archivo PDF existente si hay uno
            // Storage::delete($tema->pdf_file);

            // Subir el nuevo archivo PDF
            $pdf = $request->file('pdfFile');
            $pdfPath = $pdf->store('public/pdfs');
            $pdfPath = Storage::url($pdfPath);
        }

        // Temas::create($request->all());
        // Crear un nuevo objeto Tema con los datos del formulario y guardarlo en la base de datos
        Temas::create([
            'titulo' => $request->titulo,
            'area' => $request->area,
            'palabras_clave' => $request->palabras_clave,
            'docente_id' => $docenteId,
            'estado' => $request->estado,
            'descripcion' => $request->descripcion,
            'pdf_file' => $pdfPath,
        ]);

        return redirect()->route('temas.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $tema = Temas::findOrFail($id);

        // Obtener todos los docentes con rol de "tutor"
        $docentesTutor = Docente::where('rol', 'tutor')->get();

        return view('temas.edit', compact('tema', 'docentesTutor'));
    }

    public function update(Request $request, string $id)
    {
        // Obtener el valor de docente_id del formulario
        $docenteId = $request->input('docente_id');
        $request->validate([
            'titulo'=>'required|string',
            'palabras_clave'=>'string',
            'docente_id'=>'required|integer|min:1',
            'estado'=>'required|in:libre,asignado,terminado',
            'descripcion'=>'string',
            'pdfFile' => 'file|mimes:pdf'       
        ]);
        
        // Encontrar el tema existente
        $tema = Temas::findOrFail($id);

        // Definir una variable para almacenar la ruta del nuevo archivo PDF
        $pdfPath = $tema->pdf_file;

        // Verificar si hay un nuevo archivo PDF
        if ($request->hasFile('pdfFile')) {
            if ($tema->pdf_file) {
                $filePath = public_path($tema->pdf_file);
                if (file_exists($filePath)) {
                    unlink($filePath); // Elimina el archivo del sistema de archivos
                }
            }

            // Subir el nuevo archivo PDF
            $pdf = $request->file('pdfFile');
            $pdfPath = $pdf->store('public/pdfs');
            $pdfPath = Storage::url($pdfPath);
        }else{
            $pdfPath = $tema->pdf_file;
        }

        $tema->update([
            'titulo' => $request->titulo,
            'palabras_clave' => $request->palabras_clave,
            'docente_id' => $docenteId,
            'estado' => $request->estado,
            'descripcion' => $request->descripcion,
            'pdf_file' => $pdfPath,
        ]);

        return redirect()->route('temas.index');
    }

    public function destroy(string $id)
    {
        $tema = Temas::findOrFail($id);
        $tema->delete();

        return redirect()->route('temas.index');
    }

    public function informacion($tema){
        $temas = Temas::findOrFail($tema);
        return view('temas.info', compact('temas'));
    }
     
    public function asesor(Request $request)
    {
        $busqueda = $request->busqueda;

        $temas = Temas::query();

        if ($busqueda) {
            // Buscar tutor en la tabla Docentes
            $tutor = Docente::where('nombre', 'LIKE', '%' . $busqueda . '%')
                            ->orWhere('apellidos','LIKE', '%' . $busqueda . '%')
                            ->where('rol', 'tutor')
                            ->first();;
            // Si se encontró un tutor, filtrar por el ID del tutor
            if ($tutor) {
                $temas->where('docente_id', $tutor->id_docente);
            }else{
                // Filtrar por palabras clave, título o estado
                $temas->where('palabras_clave', 'LIKE', '%' . $busqueda . '%')
                        ->orWhere('titulo', 'LIKE', '%' . $busqueda . '%')
                        ->orWhere('estado', $busqueda);
            }
        }

        $temas = $temas->get();

        if ($temas->isEmpty()) {
            $temas = Temas::all();
        }

        return view('temas.asesor', compact('temas'));
    }
}
