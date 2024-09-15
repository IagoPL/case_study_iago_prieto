<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Procedimiento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">

    <style>
        .container {
            margin-top: 50px;
        }

        .card {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border: none;
        }

        .btn-back,
        .btn-primary {
            margin-right: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0069d9;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .form-label {
            font-weight: bold;
        }

        .button-container {
            display: flex;
            justify-content: flex-start;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card-body">
            <h2 class="card-title">Editar Procedimiento</h2>

            <form action="{{ route('procedures.update', $procedure->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="type" class="form-label">Tipo de Procedimiento</label>
                    <select class="form-select" id="type" name="type" required>
                        <option value="DNI renewal" {{ $procedure->type == 'DNI renewal' ? 'selected' : '' }}>DNI renewal</option>
                        <option value="Tax payment" {{ $procedure->type == 'Tax payment' ? 'selected' : '' }}>Tax payment</option>
                        <option value="Certificate request" {{ $procedure->type == 'Certificate request' ? 'selected' : '' }}>Certificate request</option>
                    </select>
                    @error('type')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Estado</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="pending" {{ $procedure->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in progress" {{ $procedure->status == 'in progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="done" {{ $procedure->status == 'done' ? 'selected' : '' }}>Done</option>
                    </select>
                    @error('status')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="dni" class="form-label">DNI</label>
                    <input type="text" class="form-control" id="dni" name="dni" value="{{ $procedure->dni }}" required>
                    @error('dni')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Contenedor para los botones -->
                <div class="button-container">
                    <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> Guardar Cambios</button>
                    <a href="{{ route('procedures.index') }}" class="btn btn-secondary">Volver a la lista</a>
                </div>
            </form>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>