@extends('layouts.dash')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Servicios y Característica</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Servicios y Característica</li>
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
          <a href="{{ route('characteristics.create') }}" class="btn btn-primary">Agregar Característica</a>
  </div>
    <div class="card-body">
   
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Icono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($characteristics as $characteristic)
                <tr>
                    <td>{{ $characteristic->name }}</td>
                    <td>
                        @if(isset($characteristic->icon))
                            <i class="fas {{ $characteristic->icon }}" style="font-size: 24px;"></i>
                        @endif

                    </td>
                    <td>
                        <a href="{{ route('characteristics.edit', $characteristic->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('characteristics.destroy', $characteristic->id) }}" method="POST" style="display:inline;">
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
