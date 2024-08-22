@extends('layouts.dash')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Parcelas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Parcelas</li>
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
            <a href="{{ route('articles.create') }}" class="btn btn-primary mb-3">Agregar Nueva Parcela</a>
          </div>
          <div class="card-body">
            <table id="users-table" class="table table-striped table-primary table-hover">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Metros Cuadrados</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                        <tr>
                            <td><img src="{{ asset('storage/' . $article->cover_photo) }}" alt="Portada del Artículo" style="width: 150px; height: auto;">
                            </td>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->description }}</td>
                            <td>{{ $article->square_meters }}</td>
                            <td>
                                <a href="{{ route('articles.show', $article->id) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                
                                <!-- Formulario para eliminar -->
                                <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este artículo?');">Eliminar</button>
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

