@extends('layouts.dash')

@section('content')

                    <div class="card">
                        <div class="card-header border-bottom">
                            <h3 class="card-title mb-4">Roles</h3>
                            <a href="{{ route('roles.create') }}" class="btn rounded-pill btn-label-info waves-effect"><i
                                    class=" fa-solid fa-pen-to-square ti-xs me-2"></i>Crear Rol</a>
                        </div>
                        <div class="card-body">
                            <table id="roles-table" class="table">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Permisos</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                @foreach ($role->permissions as $permission)
                                                    <span class="badge rounded-pill bg-label-primary"
                                                        style="margin:5px;">{{ $permission->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('roles.edit', $role) }}" class="btn btn-warning"><i
                                                        class="fas fa-edit" style="color: white"></i></a>

                                            </td>
                                            <td>
                                                <form action="{{ route('roles.destroy', $role) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
@endsection
