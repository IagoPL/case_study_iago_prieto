<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procedimientos y Pagos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">

    <style>
        .table-responsive {
            width: 100%;
            margin: 0;
        }

        .table th, .table td {
            text-align: left;
            vertical-align: middle;
        }

        .btn-sky {
            background-color: #87ceeb;
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

        .btn-sky:hover {
            background-color: #87aeeb;
        }
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

        .btn-orange {
            background-color: #CD853F;
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

        .btn-orange:hover {
            background-color: #A0522D;
        }

        .btn-red {
            background-color: #B22222;
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

        .btn-red:hover {
            background-color: #8B0000;
        }

        .status-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
        }

        .toast-container {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 1050;
        }
    </style>
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
            <div class="col-md-4 position-relative">
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
                        <th scope="col">DNI</th>
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
                            <td>{{ $procedure->dni }}</td>
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
                                <!-- Botón Ver -->
                                <a href="{{ route('procedures.show', $procedure->id) }}" class="btn btn-sky btn-sm">
                                    <i class='bx bx-show'></i> Ver
                                </a>

                                <!-- Botón Editar -->
                                <a href="{{ route('procedures.edit', $procedure->id) }}" class="btn btn-lime btn-sm">
                                    <i class='bx bx-edit-alt'></i> Editar
                                </a>

                                <!-- Botón Duplicar -->
                                <a href="{{ route('procedures.duplicate', $procedure->id) }}" class="btn btn-orange btn-sm">
                                    <i class='bx bx-copy'></i> Duplicar
                                </a>

                                <!-- Botón Eliminar -->
                                <form action="{{ route('procedures.destroy', $procedure->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-red btn-sm">
                                        <i class='bx bx-trash'></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Toasts Notifications -->
        <div class="toast-container" id="toast-container">
            <!-- Toast template -->
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" id="notificationToast" data-bs-delay="20000">
                <div class="toast-header">
                    <strong class="me-auto">Notificación</strong>
                    <small>Justo ahora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" id="toastMessage">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const table = document.getElementById('proceduresTable');
            const rows = table.getElementsByTagName('tr');
            const toastEl = document.getElementById('notificationToast');
            const toastContainer = new bootstrap.Toast(toastEl, { delay: 20000 });

            // Filtro de búsqueda en la tabla
            searchInput.addEventListener('keyup', function(e) {
                const term = e.target.value.toLowerCase();
                for (let i = 1; i < rows.length; i++) {
                    const row = rows[i];
                    const rowData = row.textContent.toLowerCase();
                    row.style.display = rowData.indexOf(term) > -1 ? '' : 'none';
                }
            });

            // Mostrar toast automáticamente si hay un mensaje flash en la sesión
            if (toastContainer) {
                const toast = new bootstrap.Toast(toastContainer);
                toast.show();
            }
        });
    </script>
</body>
</html>
