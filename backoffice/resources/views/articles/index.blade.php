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
                        <th style="width: 50%">Imagen</th>
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
                            @if($article->cover_photo)
                                <img src="data:image/jpeg;base64,{{ $article->cover_photo }}" width="50%" alt="Portada del Artículo">
                            @else
                                <p><i class="fa-solid fa-ban"></i></p>
                            @endif
                        </td>
                
                            <!-- Resto de tu código -->
                        <td style="text-align: center; vertical-align: middle;">{{ $article->title }}</td>
                        <td  style="text-align: center; vertical-align: middle; width:30%;" class="texto-largo"> 
                            <p>{{ $article->description }}</p>
                            <span class="texto-completo" style="display: none;">{{ $article->description }}</span>
                          </td>
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
<script>
 const textosLargos = document.querySelectorAll('.texto-largo');
const limiteCaracteres = 100; 

textosLargos.forEach(textoLargo => {
  const parrafo = textoLargo.querySelector('p');
  const textoCompleto = textoLargo.querySelector('.texto-completo');

  if (parrafo.textContent.length > limiteCaracteres) {
    const textoCortado = parrafo.textContent.substring(0, limiteCaracteres) + '...';
    parrafo.textContent = textoCortado;

    const botonLeerMas = document.createElement('button');
    botonLeerMas.textContent = 'Leer más';

    botonLeerMas.addEventListener('click', () => {
      if (botonLeerMas.textContent === 'Leer más') {
        parrafo.textContent = textoCompleto.textContent;
        botonLeerMas.textContent = 'Leer menos';
      } else {
        parrafo.textContent = textoCortado;
        botonLeerMas.textContent = 'Leer más';
      }
    });

    textoLargo.insertBefore(botonLeerMas, textoCompleto);
  }
});  </script>
@endsection
