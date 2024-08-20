@extends('layouts.dash')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Usuarios</a></li>
              <li class="breadcrumb-item active">Editar</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
        <div class="card-body">
            <h1>Editar Usuario</h1>
            <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="user_login">Nombre de Usuario:</label>
            <input type="text" name="user_login" id="user_login" class="form-control" value="{{ old('user_login', $user->user_login) }}" required>
            @error('user_login')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" class="form-control">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmar Contraseña:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>

        <div class="form-group">
            <label for="role">Rol:</label>
            <select name="role" id="role" class="form-control" required>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ $role->id == old('role', $user->role_id) ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
            @error('role')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <input type="checkbox" name="is_active" id="is_active" {{ old('is_active', $user->is_active) ? 'checked' : '' }}>
            <label for="is_active">Activo</label>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
    </form>
 
<p>Última modificación realizada por: {{ $user->updatedBy->name ?? 'N/A' }}</p>

            </div>
    </div>
    </div>
    </div>
    </div>
</div>
@endsection
