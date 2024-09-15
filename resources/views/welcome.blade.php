<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Procedimientos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet"> <!-- Archivo CSS separado -->
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title mb-4">Lista de Procedimientos</h1>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="search-box">
                            <i class='bx bx-search'></i>
                            <input type="text" id="searchInput" class="form-control" placeholder="Buscar procedimientos...">
                        </div>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <a href="{{ route('procedures.create') }}" class="btn btn-primary">
                            <i class='bx bx-plus-circle'></i> Crear nuevo procedimiento
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover" id="proceduresTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tipo</th>
                                <th>Estado</th>
                                <th>DNI</th>
                                <th>Fecha de Creación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($procedures as $procedure)
                                <tr>
                                    <td>{{ $procedure->id }}</td>
                                    <td>{{ $procedure->type }}</td>
                                    <td>
                                        <span class="badge rounded-pill status-badge 
                                            @if($procedure->status == 'Completado') bg-success
                                            @elseif($procedure->status == 'En proceso') bg-warning
                                            @else bg-secondary
                                            @endif">
                                            {{ $procedure->status }}
                                        </span>
                                    </td>
                                    <td>{{ $procedure->dni }}</td>
                                    <td>{{ $procedure->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('procedures.edit', $procedure->id) }}" class="btn btn-outline-primary btn-action">
                                            <i class='bx bx-edit-alt'></i> Editar
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script> <!-- Archivo JS separado -->
</body>
</html>
