<?php

namespace App\Http\Controllers;

use App\Models\Procedure;
use Illuminate\Http\Request;


class ProcedureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recuperar todos los procedimientos de la base de datos
        $procedures = Procedure::all();

        // Devolver la vista con los procedimientos
        return view('procedures.index', compact('procedures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('procedures.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos enviados en la solicitud.
        $request->validate([
            'type' => 'required|in:DNI renewal,Tax payment,Certificate request',
            'status' => 'required|in:pending,in progress,done',
            'dni' => 'required|string|max:255',
        ]);

        // Crear un nuevo registro en la tabla de procedimientos con los datos validados
        Procedure::create($request->all());

        // Redirigir a la lista de procedimientos con un mensaje de éxito
        return redirect()->route('procedures.index')
            ->with('success', 'Procedure created successfully.');
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
        // Buscar el procedimiento por ID
        $procedure = Procedure::findOrFail($id);

        // Devolver la vista de edición con los datos del procedimiento
        return view('procedures.edit', compact('procedure'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar el nuevo estado
        $request->validate([
            'status' => 'required|in:pending,in progress,done',
        ]);

        // Buscar el procedimiento y actualizar su estado
        $procedure = Procedure::findOrFail($id);
        $procedure->status = $request->input('status');
        $procedure->save();

        // Redirigir a la lista de procedimientos con un mensaje de éxito
        return redirect()->route('procedures.index')
            ->with('success', 'Estado del procedimiento actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
