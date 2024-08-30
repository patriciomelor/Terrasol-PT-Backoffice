@extends('layouts.dash')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ isset($role) ? 'Editar Rol' : 'Crear Rol' }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">{{ isset($role) ? 'Editar Rol' : 'Crear Rol' }}</li>
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
                    <div class="card-body">
                        <form action="{{ isset($role) ? route('roles.update', $role) : route('roles.store') }}" method="POST">
                            @csrf
                            @if(isset($role))
                                @method('PUT')
                            @endif
                            <div class="form-group">
                                <label for="name">Nombre del Rol</label>
                                <input type="text" name="name" class="form-control" value="{{ $role->name ?? '' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="permissions">Permisos</label>
                                <select name="permissions[]" class="form-control" multiple>
                                    @foreach($permissions as $permission)
                                        <option value="{{ $permission->id }}" {{ isset($role) && $role->permissions->contains($permission->id) ? 'selected' : '' }}>
                                            {{ $permission->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-info">{{ isset($role) ? 'Actualizar' : 'Crear' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
