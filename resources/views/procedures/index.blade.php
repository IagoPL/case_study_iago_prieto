<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procedimientos y Pagos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>



    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Procedimientos y pagos</h1>
            <div>
                <a href="{{ route('procedures.create') }}" class="btn btn-dark">Nueva publicación</a>
            </div>
        </div>

        <!-- Filtros -->
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text" id="searchInput" class="form-control" placeholder="Buscar por DNI">
            </div>
            <div class="col-md-4">
                <select class="form-select">
                    <option selected>Todos los estados</option>
                    <option value="activo">Activo</option>
                    <option value="borrador">Borrador</option>
                    <option value="cancelado">Cancelado</option>
                    <option value="programado">Programado</option>
                </select>
            </div>
            <div class="col-md-4">
                <select class="form-select">
                    <option selected>Todas las publicaciones</option>
                    <option value="evento">Evento</option>
                    <option value="inscripcion">Inscripción</option>
                </select>
            </div>
        </div>

        <!-- Tabla de Procedimientos -->
        <div class="table-responsive">
            <table class="table table-hover" id="proceduresTable">
                <thead>
                    <tr>
                        <th scope="col"><input type="checkbox"></th>
                        <th scope="col">Tipo publicación</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Creado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($procedures as $procedure)
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>{{ $procedure->type }}</td>
                        <td>
                            <span class="status-indicator"
                                @if($procedure->status == 'pending') style="background-color: grey;"
                                @elseif($procedure->status == 'in progress') style="background-color: yellow;"
                                @elseif($procedure->status == 'done') style="background-color: green;"
                                @elseif($procedure->status == 'cancelado') style="background-color: red;"
                                @endif></span>
                            {{ ucfirst($procedure->status) }}
                        </td>
                        <td>{{ $procedure->created_at ? $procedure->created_at->format('Y-m-d') : '-' }}</td>
                        <td>
                            <a href="{{ route('procedures.edit', $procedure->id) }}" class="btn btn-lime btn-sm">
                                <i class='bx bx-edit-alt'></i> Editar
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>