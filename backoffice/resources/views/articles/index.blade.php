@extends('layouts.dash')

@section('content')
    <div class="card">

        <div class="card-header border-bottom">
            <h3 class="card-title mb-4">Parcelas</h3>

            <a href="{{ route('articles.create') }}" class="btn rounded-pill btn-label-info waves-effect"><i
                    class=" fa-solid fa-pen-to-square ti-xs me-2"></i>Agregar Nueva Parcela</a>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered" width="100%">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Metros Cuadrados</th>
                        <th>Metros Construidos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($articles as $article)
                    <tr>
                        <td style="text-align: center; vertical-align: middle;">
                            <img id="main-image" src="data:image/jpeg;base64,{{ $article->cover_photo }}" width="100%" alt="Portada del Artículo">
                        </td>
                        <td style="text-align: center; vertical-align: middle;">{{ $article->title }}</td>
                        <td style="text-align: left; vertical-align: middle; width:30%;">{{ $article->description }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $article->square_meters }} Metros Cuadrados</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $article->constructed_meters }} Metros Construidos</td>
                        <td style="text-align: center; vertical-align: middle;">
                            <div class="btn-group" id="dropdown-icon-demo">
                                <button type="button" class="btn btn-label-primary dropdown-toggle waves-effect waves-light"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-menu-2 ti-xs me-1"></i> Acciones
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center waves-effect"
                                           href="{{ route('articles.show', $article->id) }}">
                                            <i class="fa-regular fa-eye"></i> Ver
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center waves-effect"
                                           href="{{ route('articles.edit', $article->id) }}">
                                            <i class="fa-regular fa-edit"></i> Editar
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item d-flex align-items-center waves-effect"
                                                    onclick="return confirm('¿Estás seguro de que deseas eliminar este artículo?');">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
                
                </tbody>
            </table>
        </div>
    </div>
@endsection
