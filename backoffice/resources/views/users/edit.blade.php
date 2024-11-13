@extends('layouts.dash')

@section('content')

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

        <div class="form-group mb-3">
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="user_login">Nombre de Usuario:</label>
            <input type="text" name="user_login" id="user_login" class="form-control" value="{{ old('user_login', $user->user_login) }}" required>
            @error('user_login')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
      <!-- Contraseña -->
      <div class="form-group mb-3 mb-3">
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" class="form-control" required>
        @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
 <!-- Ver Contraseña -->
 <div class="form-group mb-3 mb-3">
    <input type="checkbox" id="show-password" onclick="togglePassword()"> 
    <label for="show-password">Ver Contraseña</label>
</div>

            <!-- Confirmar Contraseña -->
            <div class="form-group mb-3 mb-3">
                <label for="password_confirmation">Confirmar Contraseña:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>

            <!-- Generar Contraseña -->
            <div class="form-group mb-3 mb-3">
                <button type="button" class="btn btn-warning" onclick="generatePassword()">Generar Contraseña</button>
            </div>

        <div class="form-group mb-3">
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

        <div class="form-group mb-3">
            <input type="checkbox" name="is_active" id="is_active" {{ old('is_active', $user->is_active) ? 'checked' : '' }}>
            <label for="is_active">Activo</label>
        </div>

        <button type="submit" class="btn btn-info">Actualizar Usuario</button>
    </form>
 
<p>Última modificación realizada por: {{ $user->updatedBy->name ?? 'N/A' }}</p>

            </div>
    </div>
    </div>
    </div>
    </div>
</div>
<script>
    function generatePassword() {
        var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+";
        var passwordLength = 12;
        var password = "";
        
        for (var i = 0; i < passwordLength; i++) {
            var randomIndex = Math.floor(Math.random() * charset.length);
            password += charset[randomIndex];
        }

        // Establecer la contraseña generada en el campo de la contraseña
        document.getElementById('password').value = password;
        document.getElementById('password_confirmation').value = password; // Asegurarse que la confirmación también se complete
    }

    function togglePassword() {
        var passwordField = document.getElementById("password");
        var passwordConfirmationField = document.getElementById("password_confirmation");
        
        if (document.getElementById("show-password").checked) {
            passwordField.type = "text";
            passwordConfirmationField.type = "text";
        } else {
            passwordField.type = "password";
            passwordConfirmationField.type = "password";
        }
    }
</script>

@endsection
