<?php

namespace App\Http\Controllers;

use App\Models\Procedure;
use Illuminate\Http\Request;


class ProcedureController extends Controller
{

    public function getProcedures()
    {
        $procedures = Procedure::all();
        return response()->json($procedures);
    }

    public function index()
    {
        // Recuperar todos los procedimientos de la base de datos
        $procedures = Procedure::all();

        // Devolver la vista con los procedimientos
        return view('procedures.index', compact('procedures'));
    }

    public function create()
    {
        return view('procedures.create');
    }

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

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        // Buscar el procedimiento por ID
        $procedure = Procedure::findOrFail($id);

        // Devolver la vista de edición con los datos del procedimiento
        return view('procedures.edit', compact('procedure'));
    }

    public function update(Request $request, $id)
    {
        // Validar los datos del formulario, incluyendo el formato del DNI
        $request->validate([
            'type' => 'required|string',
            'dni' => ['required', 'regex:/^[0-9]{8}[A-Za-z]$/'], // Validación del DNI
            'status' => 'required|in:pending,in progress,done',
        ]);

        // Encontrar el procedimiento y actualizar los campos
        $procedure = Procedure::findOrFail($id);
        $procedure->update([
            'type' => $request->input('type'),
            'dni' => $request->input('dni'),
            'status' => $request->input('status'),
        ]);

        // Mensaje de éxito
        session()->flash('success', 'El procedimiento ha sido actualizado con éxito.');

        return redirect()->route('procedures.index');
    }


    public function destroy($id)
    {
        $procedure = Procedure::findOrFail($id);
        $procedure->delete();

        // Almacenar mensaje flash en la sesión
        session()->flash('success', 'El procedimiento ha sido eliminado con éxito.');

        // Redirigir de vuelta al índice de procedimientos
        return redirect()->route('procedures.index');
    }


    public function duplicate($id)
    {
        // Obtener el procedimiento original
        $procedure = Procedure::findOrFail($id);

        // Crear una copia del procedimiento
        $newProcedure = $procedure->replicate();
        $newProcedure->created_at = now(); // Ajustar fecha de creación
        $newProcedure->save();

        // Almacenar mensaje flash en la sesión
        session()->flash('success', 'El procedimiento ha sido duplicado con éxito.');

        // Redirigir de vuelta al índice de procedimientos
        return redirect()->route('procedures.index');
    }
}
