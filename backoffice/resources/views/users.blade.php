@extends('layouts.dash')

@section('content')
<div class="container">
    <h1>Usuarios</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary">Crear Usuario</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Activo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->is_active ? 'Sí' : 'No' }}</td>
                <td>
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                    <form action="{{ route('users.toggleActive', $user) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-secondary">
                            {{ $user->is_active ? 'Desactivar' : 'Activar' }}
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
