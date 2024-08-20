@extends('layouts.dash')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Roles</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Roles</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('roles.create') }}" class="btn btn-primary">Crear Rol</a>
                    </div>
                    <div class="card-body">
                        <table id="roles-table" class="table table-striped table-primary table-hover">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Permisos</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @foreach($role->permissions as $permission)
                                            <span class="badge badge-info">{{ $permission->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('roles.edit', $role) }}" class="btn btn-warning">Editar</a>
                                        <form action="{{ route('roles.destroy', $role) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
