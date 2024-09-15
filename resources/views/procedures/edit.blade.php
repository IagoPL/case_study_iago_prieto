<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Procedimiento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Editar Procedimiento</h1>
            <a href="{{ route('procedures.index') }}" class="btn btn-secondary">Volver a la lista</a>
        </div>

        <!-- Mostrar errores de validación -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario de edición -->
        <form action="{{ route('procedures.update', $procedure->id) }}" method="POST" class="p-4 border rounded bg-light">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="type" class="form-label">Tipo de Publicación</label>
                <select name="type" id="type" class="form-select">
                    <option value="DNI renewal" {{ $procedure->type == 'DNI renewal' ? 'selected' : '' }}>DNI renewal</option>
                    <option value="Tax payment" {{ $procedure->type == 'Tax payment' ? 'selected' : '' }}>Tax payment</option>
                    <option value="Certificate request" {{ $procedure->type == 'Certificate request' ? 'selected' : '' }}>Certificate request</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Estado</label>
                <select name="status" id="status" class="form-select">
                    <option value="pending" {{ $procedure->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in progress" {{ $procedure->status == 'in progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="done" {{ $procedure->status == 'done' ? 'selected' : '' }}>Done</option>
                    <option value="cancelado" {{ $procedure->status == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="dni" class="form-label">DNI</label>
                <input type="text" name="dni" id="dni" class="form-control" value="{{ $procedure->dni }}" required>
            </div>

            <button type="submit" class="btn btn-lime">
                <i class='bx bx-save'></i> Guardar Cambios
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
