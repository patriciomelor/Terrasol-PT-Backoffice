@extends('layouts.dash')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Usuarios</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Usuarios</li>
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
                        <div class="card-header">
                            <a href="{{ route('users.create') }}" class="btn btn-info">Crear Usuario</a>
                        </div>
                        <div class="card-body">
                            <table id="users-table" class="table table-striped table-light table-hover">
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
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->user_login }}</td>
                                            <td>{{ $user->role->name ?? 'Sin rol' }}</td>
                                            <td>{{ $user->is_active ? 'Sí' : 'No' }}</td>
                                            <td>{{ $user->updatedBy->name ?? 'N/A' }}</td>
                                            <!-- Mostrar el nombre del usuario que realizó la última modificación -->
                                            <td>
                                                <a href="{{ route('users.edit', $user) }}"
                                                    class="btn btn-outline-success"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('users.destroy', $user) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                                                </form>
                                                <form action="{{ route('users.toggleActive', $user) }}" method="POST" style="display:inline;">
                                                  @csrf
                                                  @method('PATCH')
                                                  <button type="submit" class="btn btn-outline-light">
                                                      @if($user->is_active)
                                                          <i class="fa-solid fa-check" style="color:green;"></i>
                                                      @else
                                                          <i class="fa-solid fa-x" style="color:red;"></i>
                                                      @endif
                                                  </button>
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