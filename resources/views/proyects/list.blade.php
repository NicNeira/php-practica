@extends('layouts.app')

@section('title', 'Landing Page')

@section('content')
<div class="container">
    <h1>Mantenedor de Proyectos</h1>

    <div class="d-flex justify-content-between mb-3">
        <div>
            <label for="entries">Show</label>
            <select id="entries" class="form-select d-inline-block w-auto">
                <option>10</option>
                <option>25</option>
                <option>50</option>
                <option>100</option>
            </select>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
            + Nuevo Proyecto
        </button>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <!-- <th>ID</th> -->
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Imagen</th>
                <th>Creado por</th>
                <th>Última actualización por</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proyectos as $proyecto)
            <tr>
                <!-- <td>{{ $proyecto->id }}</td> -->
                <td>{{ $proyecto->nombre }}</td>
                <td>{{ $proyecto->descripcion }}</td>
                <td>
                    @if($proyecto->imagen)
                    <img src="{{ asset('storage/' . $proyecto->imagen) }}" alt="Imagen del proyecto" style="width: 50px; height: auto;">
                    @else
                    Sin imagen
                    @endif
                </td>
                <td>{{ $proyecto->user_id_create }}</td>
                <td>{{ $proyecto->user_id_last_update }}</td>
                <td>
                    <span class="badge bg-{{ $proyecto->activo ? 'success' : 'danger' }}">
                        {{ $proyecto->active ? 'Activo' : 'Inactivo' }}
                    </span>
                </td>
                <td>
                    <!-- Ver Proyecto -->
                    <button class="btn btn-sm btn-info view-project" data-id="{{ $proyecto->id }}" title="Ver" data-bs-toggle="modal" data-bs-target="#viewModal">
                        <i class="bi bi-eye" aria-hidden="true"></i>
                    </button>

                    <!-- Editar Proyecto -->
                    <button class="btn btn-sm btn-warning edit-project" data-id="{{ $proyecto->id }}" title="Editar" data-bs-toggle="modal" data-bs-target="#editModal">
                        <i class="bi bi-pencil" aria-hidden="true"></i>
                    </button>

                    <!-- Cambiar Estado -->
                    <button class="btn btn-sm toggle-status {{ $proyecto->activo ? 'btn-danger' : 'btn-success' }}" data-id="{{ $proyecto->id }}" title="Cambiar estado">

                        <i class="bi bi-arrow-repeat" aria-hidden="true"></i>
                    </button>

                    <!-- Eliminar Proyecto -->
                    <button class="btn btn-sm btn-danger delete-project" data-id="{{ $proyecto->id }}" title="Eliminar" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <i class="bi bi-trash" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal para crear proyecto -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="createForm" method="POST" action="{{ route('proyects.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Crear Nuevo Proyecto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Campo de nombre -->
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>

                    <!-- Campo de descripción -->
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                    </div>

                    <!-- Campo de imagen -->
                    <div class="mb-3">
                        <label for="imagen" class="form-label">Imagen</label>
                        <input type="file" class="form-control" id="imagen" name="imagen">
                    </div>

                    <!-- Campo de estado (activo/inactivo) -->
                    <div class="mb-3">
                        <label for="activo" class="form-label">Estado</label>
                        <select id="activo" name="activo" class="form-select">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                </div>

                <!-- Botón para enviar el formulario -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Proyecto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Para indicarle a Laravel que es una actualización -->
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="edit_name" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Descripción</label>
                        <textarea class="form-control" id="edit_description" name="descripcion" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_image" class="form-label">Imagen</label>
                        <input type="file" class="form-control" id="edit_image" name="imagen">
                        <img id="edit_image_preview" src="" alt="Imagen del proyecto" style="width: 100px; height: auto;">
                    </div>
                    <div class="mb-3">
                        <label for="edit_active" class="form-label">Estado</label>
                        <select id="edit_active" name="activo" class="form-select">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal para ver proyecto -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Detalles del Proyecto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">ID</label>
                    <p id="view_id" class="form-control-plaintext"></p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <p id="view_name" class="form-control-plaintext"></p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <p id="view_description" class="form-control-plaintext"></p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Imagen</label>
                    <img id="view_image" src="" alt="Imagen del proyecto" style="width: 100%; height: auto;">
                </div>
                <div class="mb-3">
                    <label class="form-label">Creado por</label>
                    <p id="view_user_create" class="form-control-plaintext"></p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Última actualización por</label>
                    <p id="view_user_update" class="form-control-plaintext"></p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Estado</label>
                    <p id="view_active" class="form-control-plaintext"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal para eliminar proyecto -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Eliminar Proyecto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar este proyecto?</p>
                <p class="text-danger">Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" id="confirmDelete" class="btn btn-danger">Eliminar</button>
            </div>
        </div>
    </div>
</div>

<!-- Toast Notification -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="toast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                Acción realizada correctamente.
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>


@endsection

@push('scripts')

<script>
    $(document).ready(function() {

        // Toast Notification
        function showToast(message, isSuccess = true) {
            var toastElement = document.getElementById('toast');
            var toastBody = toastElement.querySelector('.toast-body');
            var toast = new bootstrap.Toast(toastElement);

            // Cambiar el color del Toast según el éxito o fallo
            if (isSuccess) {
                toastElement.classList.remove('bg-danger');
                toastElement.classList.add('bg-success');
            } else {
                toastElement.classList.remove('bg-success');
                toastElement.classList.add('bg-danger');
            }

            // Establecer el mensaje
            toastBody.textContent = message;

            // Mostrar el Toast
            toast.show();
        }


        // Create Project
        $('#submitCreate').click(function() {
            $('#createForm').submit(function(e) {
                e.preventDefault(); // Evitar la recarga de la página

                $.post($(this).attr('action'), $(this).serialize(), function(data) {
                    $('#createModal').modal('hide'); // Cerrar el modal
                    showToast('Proyecto creado exitosamente.', true); // Mostrar Toast de éxito
                }).fail(function() {
                    showToast('Error al crear el proyecto.', false); // Mostrar Toast de error
                });
            });
        });

        // Editar Proyecto
        $('.edit-project').click(function() {
            var projectId = $(this).data('id');
            $.get('/proyects/' + projectId + '/edit', function(data) {
                $('#editForm').attr('action', '/proyects/' + projectId); // Cambia la acción del formulario
                $('#edit_name').val(data.nombre); // Rellena el campo nombre
                $('#edit_description').val(data.descripcion); // Rellena el campo descripción
                $('#edit_image_preview').attr('src', '/storage/' + data.imagen); // Muestra la imagen actual
                $('#edit_active').val(data.activo); // Cambia el estado
                $('#editModal').modal('show'); // Muestra el modal de edición
            }).fail(function() {
                showToast('Error al cargar el proyecto para editar.', false);
            });
        });

        $('#submitEdit').click(function() {
            $('#editForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: $('#editForm').attr('action'),
                    type: 'POST',
                    data: $('#editForm').serialize(),
                    success: function(data) {
                        $('#editModal').modal('hide'); // Cerrar el modal
                        showToast('Proyecto actualizado exitosamente.', true); // Mostrar Toast de éxito
                    },
                    error: function() {
                        showToast('Error al actualizar el proyecto.', false); // Mostrar Toast de error
                    }
                });
            });
        });

        // Ver Proyecto desde la tabla
        $('.view-project').click(function() {
            var projectId = $(this).data('id'); // Capturamos el ID del proyecto desde el botón

            // Hacemos una solicitud AJAX para obtener los datos del proyecto
            $.get('/proyects/' + projectId, function(data) {
                // Colocamos los datos en los campos del modal
                $('#view_id').text(data.id);
                $('#view_name').text(data.nombre);
                $('#view_description').text(data.descripcion);

                // Verificamos si hay una imagen y la mostramos
                if (data.imagen) {
                    $('#view_image').attr('src', '/storage/' + data.imagen).show(); // Muestra la imagen actual
                } else {
                    $('#view_image').hide(); // Si no hay imagen, ocultamos el campo
                }

                $('#view_user_create').text(data.user_id_create);
                $('#view_user_update').text(data.user_id_last_update);
                $('#view_active').text(data.activo ? 'Activo' : 'Inactivo');

                // Mostramos el modal
                $('#viewModal').modal('show');
                showToast('Proyecto cargado correctamente.', true);
            }).fail(function() {
                showToast('Error al cargar el proyecto.', false);
            });
        });

        // Cambiar el estado del proyecto (activo/inactivo)
        $('.toggle-status').click(function() {
            var projectId = $(this).data('id');
            $.post('/proyects/' + projectId + '/toggle-status', {
                _token: '{{ csrf_token() }}'
            }, function(data) {
                if (data.success) {
                    location.reload(); // Recargar la página para actualizar el estado
                    showToast('Estado del proyecto actualizado correctamente.', true); // Mostrar Toast de éxito
                }
            }).fail(function() {
                showToast('Error al cambiar el estado del proyecto.', false);
            });
        });

        // Delete Project
        var deleteId;
        $('.delete-project').click(function() {
            deleteId = $(this).data('id');
            $('#deleteModal').modal('show');
        });

        $('#confirmDelete').click(function() {
            $.ajax({
                url: '/proyects/' + deleteId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(result) {
                    location.reload(); // Recargar la página después de eliminar
                    showToast('Proyecto eliminado exitosamente.', true); // Mostrar Toast de éxito
                },
                error: function() {
                    showToast('Error al eliminar el proyecto.', false); // Mostrar Toast de error
                }
            });
        });
    });
</script>
@endpush