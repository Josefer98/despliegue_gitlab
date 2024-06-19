<?php

namespace App\Http\Controllers;

use App\Models\Reporte_temas;
use App\Models\Temas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ReporteTemasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $temas= Temas::create($request->all());
                // Registrar la acción
                Reporte_temas::create([
                    'action' => 'create',
                    'tema_id' => $temas->id,
                    'user_id' => Auth::id()
                ]);
        
                return view('Reporte_temas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reporte_temas $reporte_temas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reporte_temas $reporte_temas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reporte_temas $id)
    {
        // Validar y actualizar el tema
        $tema = Temas::findOrFail($id);
        $tema->update($request->all());

        // Registrar la acción
        Reporte_temas::create([
            'action' => 'update',
            'tema_id' => $tema->id,
            'user_id' => Auth::id()
        ]);

        return view('Reporte_temas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reporte_temas $id)
    {
       // Eliminar el tema
       $tema = Temas::findOrFail($id);
       $tema->delete();

       // Registrar la acción
       Reporte_temas::create([
           'action' => 'delete',
           'tema_id' => $tema->id,
           'user_id' => Auth::id()
       ]);

       return view('Reporte_temas.index');
    }
}
