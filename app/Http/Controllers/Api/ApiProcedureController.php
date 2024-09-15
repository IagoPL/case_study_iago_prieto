<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Procedure;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ApiProcedureController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type');
        $status = $request->query('status');
        $dni = $request->query('dni');

        $query = Procedure::query();

        if ($type) {
            $query->where('type', $type);
        }

        if ($status) {
            $query->where('status', $status);
        }

        if ($dni) {
            $query->where('dni', $dni);
        }
        // Paginación de 10 elementos por página
        $procedures = $query->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $procedures,
            'total' => $procedures->total(),
            'current_page' => $procedures->currentPage(),
            'last_page' => $procedures->lastPage(),
        ], 200);
    }

    public function store(Request $request)
    {
        try {
            // Validar los datos de la solicitud
            $validatedData = $request->validate([
                'type' => 'required|string|in:DNI renewal,Tax payment,Certificate request',
                'status' => 'required|string|in:pending,in progress,done',
                'dni' => [
                    'required',
                    'string',
                    'regex:/^[0-9]{8}[A-Za-z]{1}$/',
                    function ($attribute, $value, $fail) {
                        if (!$this->validDNI($value)) {
                            $fail('El DNI ingresado no es válido.');
                        }
                    }
                ],
            ]);

            // Crear un nuevo procedimiento
            $procedure = Procedure::create($validatedData);

            return response()->json([
                'success' => true,
                'data' => $procedure,
                'message' => 'Procedimiento creado exitosamente',
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Los datos proporcionados no son válidos.',
                'errors' => $e->errors(), // Mostrar los mensajes de error específicos
            ], 422);
        }
    }

    private function validDNI($dni)
    {
        $letter = strtoupper(substr($dni, -1));
        $numbers = substr($dni, 0, -1);

        // Array de letras para la validación
        $validLetters = "TRWAGMYFPDXBNJZSQVHLCKE";

        // Verifica que la letras sea correcta
        if ($letter == $validLetters[intval($numbers) % 23]) {
            return true;
        }

        return false;
    }
}
