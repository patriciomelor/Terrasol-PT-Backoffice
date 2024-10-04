@extends('layouts.dash')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- DataTable with Buttons -->
        <div class="card">
            <div class="card-datatable table-responsive pt-0">
                <div class="card-header">
                    <a href="{{ route('users.create') }}" class="btn btn-info">Crear Usuario</a>
                </div>
                <table id="users-table" class="datatables-basic table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Usuario</th>
                            <th>Rol</th>
                            <th>Activo</th>
                            <th>Última Modificación</th> <!-- Nueva columna -->
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td style="text-align: center;vertical-align: middle;">{{ $user->name }}</td>
                                <td style="text-align: center;vertical-align: middle;">{{ $user->email }}</td>
                                <td style="text-align: center;vertical-align: middle;">{{ $user->user_login }}</td>
                                <td style="text-align: center;vertical-align: middle;">{{ $user->role->name ?? 'Sin rol' }}
                                </td>
                                <td style="text-align: center;vertical-align: middle;"> {{ $user->is_active ? 'Sí' : 'No' }}
                                </td>
                                <td style="text-align: center;vertical-align: middle;">{{ $user->updatedBy->name ?? 'N/A' }}
                                </td>
                                <!-- Mostrar el nombre del usuario que realizó la última modificación -->
                                <td style="text-align: center;vertical-align: middle;">
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-warning"><i
                                            class="fas fa-edit" style="color: white"></i></a>
                                    <form action="{{ route('users.destroy', $user) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                    <form action="{{ route('users.toggleActive', $user) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-outline-light">
                                            @if ($user->is_active)
                                                <i class="fa-solid fa-check" style="color:green;"></i>
                                            @else
                                                <i class="fa-solid fa-x" style="color:red;"></i>
                                            @endif
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    {{-- <!-- Tu script personalizado -->
    <script>
        $(document).ready(function() {
            $('.users-table').DataTable({
                dom: '<"top"lBf>rt<"bottom"ip><"clear">',
                buttons: [{
                        text: 'Crear Usuario',
                        className: 'btn btn-primary',
                        action: function(e, dt, node, config) {
                            window.location.href = '/users/create';
                        }
                    },
                    'export'
                ],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
                }
            });
        });
    </script> --}}
@endsection
