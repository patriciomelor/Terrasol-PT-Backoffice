@extends('layouts.dash')

@section('content')
<div class="container">
    <h1>Crear Usuario</h1>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="role">Rol</label>
            <select class="form-control" id="role" name="role" required>
                @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="is_active" name="is_active">
            <label class="form-check-label" for="is_active">Activo</label>
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
</div>
@endsection
