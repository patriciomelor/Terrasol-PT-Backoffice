@extends('layouts.dash')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Crear Usuario</h4>
                    </div>
                    <div class="card-body">
                        <form class="form-group mb-3" method="POST" action="{{ route('users.store') }}">
                            @csrf

                            <!-- Nombre -->
                            <div class="form-group mb-3">
                                <label for="name">Nombre:</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="form-group mb-3">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Nombre de Usuario -->
                            <div class="form-group mb-3">
                                <label for="user_login">Nombre de Usuario:</label>
                                <input type="text" name="user_login" id="user_login" class="form-control" value="{{ old('user_login') }}" required>
                                @error('user_login')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Contraseña -->
                            <div class="form-group mb-3">
                                <label for="password">Contraseña:</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Confirmar Contraseña -->
                            <div class="form-group mb-3">
                                <label for="password_confirmation">Confirmar Contraseña:</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                            </div>

                            <!-- Rol -->
                            <div class="col-6 form-group mb-3">
                                <label for="role">Rol:</label>
                                <select name="role" id="role" class="form-control" required>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Activo -->
                            <div class="col-6 form-group mb-3 form-check">
                                <input type="checkbox" name="is_active" id="is_active" class="form-check-input" checked>
                                <label for="is_active" class="form-check-label">Activo</label>
                            </div>

                            <!-- Botón -->
                            <button type="submit" class="btn btn-info">Crear Usuario</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
