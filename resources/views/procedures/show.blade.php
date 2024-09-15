<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Procedimiento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">

    <style>
        .btn-lime {
            background-color: #228B22;
            color: white;
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            border: none;
            border-radius: 0.25rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s ease;
        }

        .btn-lime:hover {
            background-color: #006400;
        }

        .status-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
        }

        .card {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title mb-4">Detalles del Procedimiento</h1>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Tipo de Procedimiento:</strong> {{ $procedure->type }}</p>
                        <p><strong>Estado:</strong> 
                            <span class="status-indicator" 
                                @if($procedure->status == 'pending') style="background-color: grey;"
                                @elseif($procedure->status == 'in progress') style="background-color: yellow;"
                                @elseif($procedure->status == 'done') style="background-color: green;"
                                @endif></span>
                            {{ ucfirst($procedure->status) }}
                        </p>
                        <p><strong>DNI:</strong> {{ $procedure->dni }}</p>
                        <p><strong>Fecha de Creación:</strong> {{ $procedure->created_at ? $procedure->created_at->format('d/m/Y H:i') : '-' }}</p>
                        <p><strong>Última Actualización:</strong> {{ $procedure->updated_at ? $procedure->updated_at->format('d/m/Y H:i') : '-' }}</p>
                    </div>
                </div>

                <a href="{{ route('procedures.index') }}" class="btn btn-lime">
                    <i class="bx bx-arrow-back"></i> Volver al listado
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
