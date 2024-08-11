@extends('layouts.dash')

@section('content')
<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
<section class="content-header mx-10">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar Perfil</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Editar Perfil</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    </section>

<div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Datos de Cuenta</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body" style="display: block;">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password (Leave blank to keep current password)</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>
            </div>
            <!-- /.card-body -->
 </div>
 <div class="card card-warning">
            <div class="card-header">
              <h3 class="card-title">Perfil</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body" style="display: block;">
            <div class="mb-3">
            <label for="avatar" class="form-label">Avatar</label>
            <input type="file" class="form-control" id="avatar" name="avatar">
        </div>

        @if ($user->profile_photo_path)
            <div class="mb-3">
                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Avatar" width="100">
            </div>
        @endif

        <div class="form-group">
            <label for="role">{{ __('Role') }}</label>
            <select name="role" id="role" class="form-control">
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>
            </div>
            <!-- /.card-body -->
 </div>
 


        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection