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

            <form action="{{ isset($article) ? route('articles.update', $article->id) : route('articles.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($article))
                    @method('PUT')
                @endif

                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1">{{ isset($article) ? 'Editar' : 'Crear' }} Parcela</h4>
                    </div>
                    <div class="d-flex align-content-center flex-wrap gap-4">
                        <div class="d-flex gap-4">
                            <a type="button" href="{{ route('articles.index') }}"
                                class="btn btn-label-secondary waves-effect">Cancelar</a>
                        </div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Publicar parcela</button>
                    </div>
                </div>

                <div class="row">
                    <!-- Información del Producto -->
                    <div class="col-12 col-lg-8">
                        <div class="card mb-6">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Información del Producto</h5>
                            </div>
                            <div class="card-body">
                                <!-- Título -->
                                <div class="mb-6">
                                    <label class="form-label" for="title">Título</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" value="{{ old('title', $article->title ?? '') }}"
                                        required>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Descripción -->
                                <div class="mb-6">
                                    <label for="description" class="form-label">Descripción</label>
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $article->description ?? '') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Contenido -->
                                <div class="mb-6">
                                    <label for="content" class="form-label">Contenido</label>
                                    <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" required>{{ old('content', $article->content ?? '') }}</textarea>
                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <!-- Imágenes del Producto -->
                        <div class="card mb-6">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 card-title">Imágenes del Terreno</h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-6">
                                    <div class="col">
                                        <label for="cover_photo">Foto de Portada</label>
                                        <input type="file"
                                            class="form-control @error('cover_photo') is-invalid @enderror"
                                            name="cover_photo" id="cover_photo">
                                        @error('cover_photo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        @if (isset($article->cover_photo))
                                            <img src="data:image/jpeg;base64,{{ $article->cover_photo }}" alt="Cover Photo"
                                                style="width: 150px; height: auto;">
                                        @endif
                                    </div>
                                    <div class="col">
                                        <label for="photos">Fotos Adicionales</label>
                                        <input type="file" class="form-control @error('photos.*') is-invalid @enderror"
                                            name="photos[]" id="photos" multiple>
                                        @error('photos.*')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        @if (isset($article->photos))
                                            @foreach (json_decode($article->photos) as $photo)
                                                <img src="data:image/jpeg;base64,{{ $photo }}"
                                                    alt="Additional Photo" style="width: 100px; height: auto;">
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- caracter Section -->
                    <div class="col-12 col-lg-4">
                        <!-- Características Section -->
                        <div class="card mb-6">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Características</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Características:</label>
                                    <div class="characteristics-container">
                                        @foreach ($characteristics as $characteristic)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="characteristics[]"
                                                    value="{{ $characteristic->id }}"
                                                    id="characteristic_{{ $characteristic->id }}"
                                                    {{ isset($article) && $article->characteristics->contains($characteristic->id) ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="characteristic_{{ $characteristic->id }}">
                                                    <i class="fa {{ $characteristic->icon }}"
                                                        style="margin-right:5px!important;"></i>
                                                    {{ $characteristic->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('characteristics.*')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- MTc Section -->
                        <div class="card mb-6">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Metros Construidos</h5>
                            </div>

                            <div class="card-body">
                                <!-- Metros Cuadrados -->
                                <div class="mb-6">
                                    <label for="square_meters" class="form-label">Metros Cuadrados de la Parcela</label>
                                    <input type="number"
                                        class="form-control @error('square_meters') is-invalid @enderror"
                                        id="square_meters" name="square_meters"
                                        value="{{ old('square_meters', $article->square_meters ?? '') }}" required>
                                    @error('square_meters')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Metros Construidos -->
                                <div class="mb-6">
                                    <label for="constructed_meters" class="form-label">Metros Construidos</label>
                                    <input type="number"
                                        class="form-control @error('constructed_meters') is-invalid @enderror"
                                        id="constructed_meters" name="constructed_meters"
                                        value="{{ old('constructed_meters', $article->constructed_meters ?? '') }}">
                                    @error('constructed_meters')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- MTc Section -->
                        <div class="card mb-6">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Ubicación</h5>
                            </div>

                            <div class="card-body">

                                  <!-- Región y Ciudad con select2 -->
                                  <div class="mb-6">
                                    <label for="region" class="form-label">Región</label>
                                    <select id="region-select" class="form-control" name="region">
                                        <option value="">Selecciona una región</option>
                                    </select>
                                    @error('region')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-6">
                                    <label for="city" class="form-label">Ciudad</label>
                                    <select id="city-select" class="form-control" name="city">
                                        <option value="">Selecciona una comuna</option>
                                    </select>
                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
    $(document).ready(function() {
        $('#region-select').select2({
            placeholder: "Selecciona una región",
            ajax: {
                url: '/api/regions',
                processResults: function(data) {
                    return {
                        results: data.map(region => ({ id: region.codigo, text: region.nombre }))
                    };
                }
            }
        });

        $('#region-select').on('change', function() {
            const regionId = $(this).val();
            $('#city-select').empty().trigger('change'); 

            $('#city-select').select2({
                placeholder: "Selecciona una comuna",
                ajax: {
                    url: `/api/regions/${regionId}/communes`,
                    processResults: function(data) {
                        return {
                            results: data.map(commune => ({ id: commune.codigo, text: commune.nombre }))
                        };
                    }
                }
            });
        });
    });
</script>
@endsection