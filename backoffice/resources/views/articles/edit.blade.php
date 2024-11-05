@extends('layouts.dash')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-ecommerce">
            <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1">Editar Parcela</h4>
                    </div>
                    <div class="d-flex align-content-center flex-wrap gap-4">
                        <a type="button" href="{{ route('articles.index') }}" class="btn btn-label-secondary waves-effect">Cancelar</a>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar cambios</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-8">
                        <!-- Imagen principal -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Portada del Artículo</h5>
                            </div>
                            <div class="card-body text-center">
                                @if ($article->cover_photo)
                                    <img id="main-image" src="data:image/jpeg;base64,{{ $article->cover_photo }}" width="100%" alt="Portada del Artículo">
                                @else
                                    <p>No hay portada disponible.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Miniaturas -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Fotos Adicionales</h5>
                            </div>
                            <div class="card-body d-flex flex-wrap">
                                @if (is_array($article->photos) || $article->photos)
                                    @foreach ($article->photos as $photo)
                                        <div class="product-image-thumb m-2">
                                            <img src="data:image/jpeg;base64,{{ $photo }}" class="thumb-img" style="width: 150px; height: auto;" alt="Foto del Artículo"><br>
                                            <!-- Botón para eliminar cada imagen -->
                                            <form action="{{ route('articles.delete_photo', ['id' => $article->id, 'photo' => $photo]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta imagen?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger mt-2">Eliminar</button>
                                            </form>
                                        </div>
                                    @endforeach
                                @else
                                    <p>No hay fotos disponibles.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                      <!-- Información de la parcela -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Información de la Parcela</h5>
                            </div>
                            <div class="card-body">
                                <!-- Título -->
                                <div class="mb-3">
                                    <label for="title" class="form-label">Título</label>
                                    <input type="text" name="title" value="{{ old('title', $article->title) }}" class="form-control" autofocus>
                                </div>

                                <!-- Descripción -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Descripción</label>
                                    <textarea name="description" class="form-control">{{ old('description', $article->description) }}</textarea>
                                </div>

                                <!-- Metros Cuadrados -->
                                <div class="mb-3">
                                    <label for="square_meters" class="form-label">Metros Cuadrados</label>
                                    <input type="number" name="square_meters" value="{{ old('square_meters', $article->square_meters) }}" class="form-control">
                                </div>

                                <!-- Metros Construidos -->
                                <div class="mb-3">
                                    <label for="constructed_meters" class="form-label">Metros Construidos</label>
                                    <input type="number" name="constructed_meters" value="{{ old('constructed_meters', $article->constructed_meters) }}" class="form-control">
                                </div>

                                <!-- Región -->
                                <div class="mb-3">
                                    <label for="region" class="form-label">Región</label>
                                    <input type="text" name="region" value="{{ old('region', $article->region) }}" class="form-control">
                                </div>

                                <!-- Ciudad -->
                                <div class="mb-3">
                                    <label for="city" class="form-label">Ciudad</label>
                                    <input type="text" name="city" value="{{ old('city', $article->city) }}" class="form-control">
                                </div>

                                <!-- Calle -->
                                <div class="mb-3">
                                    <label for="street" class="form-label">Calle</label>
                                    <input type="text" name="street" value="{{ old('street', $article->street) }}" class="form-control">
                                </div>

                                <!-- Venta o Arriendo -->
                                <div class="mb-3">
                                    <label for="sale_or_rent" class="form-label">Venta o Arriendo</label>
                                    <select name="sale_or_rent" class="form-control">
                                        <option value="sale" {{ old('sale_or_rent', $article->sale_or_rent) == 'sale' ? 'selected' : '' }}>Venta</option>
                                        <option value="rent" {{ old('sale_or_rent', $article->sale_or_rent) == 'rent' ? 'selected' : '' }}>Arriendo</option>
                                    </select>
                                </div>

                                <!-- Características -->
                                <div class="mb-3">
                                    <label>Características:</label>
                                    @foreach ($characteristics as $characteristic)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="characteristics[{{ $characteristic->id }}]" value="1" id="characteristic_{{ $characteristic->id }}" {{ $article->characteristics->contains($characteristic->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="characteristic_{{ $characteristic->id }}">
                                                <i class="{{ $characteristic->icon }}"></i> {{ $characteristic->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Al hacer clic en una miniatura, cambiar la imagen principal
            document.querySelectorAll('.thumb-img').forEach(function(thumb) {
                thumb.addEventListener('click', function() {
                    var mainImage = document.getElementById('main-image');
                    mainImage.src = this.src; // Cambiar la imagen principal
                });
            });
        });
    </script>
@endsection
