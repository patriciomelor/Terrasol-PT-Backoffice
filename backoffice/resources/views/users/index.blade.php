@extends('layouts.dash')

@section('content')
    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-header border-bottom">
            <h3 class="card-title mb-4">Usuarios</h3>
            <a href="{{ route('users.create') }}" class="btn rounded-pill btn-label-info waves-effect"><i
                    class=" fa-solid fa-pen-to-square ti-xs me-2"></i>Crear Usuario</a>
        </div>
        <table id="users-table" class="table">
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
                        <td style="text-align: center;vertical-align: middle;">   <form action="{{ route('users.toggleActive', $user) }}" method="POST" style="display:inline;">
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
                        <td style="text-align: center;vertical-align: middle;">{{ $user->updatedBy->name ?? 'N/A' }}
                        </td>
                        <!-- Mostrar el nombre del usuario que realizó la última modificación -->
                        <td style="text-align: center;vertical-align: middle;">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                                  <i class="ti ti-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" style="">
                                  <li><a class="dropdown-item waves-effect" href="{{ route('users.edit', $user) }}">Editar</a></li>
                                  <li>
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"class="dropdown-item waves-effect">Eliminar</button>
                                    </form>
                                    
                                    </li>
                              </ul>
                              </div>

                           
                          
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
