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
                                    <input type="text" class="form-control" name="title"
                                        value="{{ old('title') }}"required>
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
                        <div class="row">
                            <!-- MTc Section -->
                            <div class="col-xl-6 col-sm-6">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Detalles de los Metros</h5>
                                    </div>

                                    <div class="card-body">
                                        <!-- Metros Cuadrados -->
                                        <div class="mb-3">
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
                                        <div class="mb-3">
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
                            </div>
                            <!-- MTc Section -->
                            <div class="col-xl-6 col-sm-6">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Ubicación</h5>
                                    </div>

                                    <div class="card-body">
                                        <!-- Región -->
                                        <div class="mb-6">
                                            <label for="region" class="form-label">Región</label>
                                            <select id="region-select" name="region"
                                                class="select2 form-select form-select-lg">
                                                <option value="">Selecciona una región</option>
                                            </select>
                                            @error('region')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Comuna -->
                                        <div class="mb-6">
                                            <label for="city" class="form-label">Comuna</label>
                                            <select id="city-select" name="city"
                                                class="select2 form-select form-select-lg">
                                                <option value="">Selecciona una comuna</option>
                                            </select>
                                            @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-6">
                                            <label for="street">Calle:</label>
                                            <input type="text" name="street" id="street"
                                                class="form-select form-select-lg @error('street') is-invalid @enderror"
                                                value="{{ old('street') }}" autofocus>
                                            @error('street')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
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


                        <div class="card mb-6">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Estado de Terreno</h5>
                            </div>
                            <div class="card-body">

                                <div class="mb-6 ">
                                    <label for="sale_or_rent">Venta o Arriendo:</label>
                                    <select name="sale_or_rent" id="sale_or_rent"
                                        class="form-control @error('sale_or_rent') is-invalid @enderror">
                                        <option value="sale" {{ old('sale_or_rent') == 'sale' ? 'selected' : '' }}>Venta
                                        </option>
                                        <option value="rent" {{ old('sale_or_rent') == 'rent' ? 'selected' : '' }}>
                                            Arriendo
                                        </option>
                                    </select>
                                    @error('sale_or_rent')
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            console.log("Iniciando carga de regiones...");

            // Cargar las regiones al cargar la página
            $.ajax({
                url: '{{ url('/api/regions') }}',
                method: 'GET',
                success: function(data) {
                    console.log("Regiones recibidas:", data);
                    data.forEach(function(region) {
                        $('#region-select').append(new Option(region.nombre, region.id));
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error al cargar las regiones:", error);
                    console.log("Detalles:", xhr.responseText);
                }
            });

            // Cargar las comunas según la región seleccionada
            $('#region-select').on('change', function() {
                var regionId = $(this).val();
                console.log("Región seleccionada:", regionId);
                $('#city-select').empty().append(new Option("Selecciona una comuna", ""));

                if (regionId) {
                    $.ajax({
                        url: '{{ url('/api/regions') }}/' + regionId + '/communes',
                        method: 'GET',
                        success: function(data) {
                            console.log("Comunas para la región seleccionada:", data);
                            data.forEach(function(commune) {
                                $('#city-select').append(new Option(commune.nombre,
                                    commune.id));
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error("Error al cargar las comunas:", error);
                            console.log("Detalles:", xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>

@endsection
