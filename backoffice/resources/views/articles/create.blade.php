@extends('layouts.dash')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ isset($article) ? 'Editar' : 'Crear' }} Artículo</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">{{ isset($article) ? 'Editar' : 'Crear' }} Artículo</li>
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
                    <div class="card-body">
                        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="title">Título:</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Descripción:</label>
                                <textarea name="description" id="description" class="form-control" required>{{ old('description') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="content">Contenido:</label>
                                <textarea name="content" class="form-control" required>{{ old('content') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="square_meters">Metros Cuadrados de la Parcela:</label>
                                <input type="number" name="square_meters" id="square_meters" class="form-control" value="{{ old('square_meters') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="photos">Fotos:</label>
                                <input type="file" name="photos[]" id="photos" class="form-control" multiple>
                            </div>

                            <div class="form-group">
                                <label for="constructed_meters">Metros Construidos:</label>
                                <input type="number" name="constructed_meters" id="constructed_meters" class="form-control" value="{{ old('constructed_meters') }}">
                            </div>

                            <div class="form-group">
                                <label for="region">Región:</label>
                                <input type="text" name="region" id="region" class="form-control" value="{{ old('region') }}">
                            </div>

                            <div class="form-group">
                                <label for="city">Ciudad:</label>
                                <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}">
                            </div>

                            <div class="form-group">
                                <label for="street">Calle:</label>
                                <input type="text" name="street" id="street" class="form-control" value="{{ old('street') }}">
                            </div>

                            <div class="form-group">
                                <label for="sale_or_rent">Venta o Arriendo:</label>
                                <select name="sale_or_rent" id="sale_or_rent" class="form-control">
                                    <option value="sale" {{ old('sale_or_rent') == 'sale' ? 'selected' : '' }}>Venta</option>
                                    <option value="rent" {{ old('sale_or_rent') == 'rent' ? 'selected' : '' }}>Arriendo</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="characteristics">Características:</label>
                                @foreach($characteristics as $characteristic)
                                    <div class="form-check">
                                        <input type="checkbox" name="characteristics[{{ $characteristic->id }}]" value="1" class="form-check-input" id="characteristic-{{ $characteristic->id }}">
                                        <label class="form-check-label" for="characteristic-{{ $characteristic->id }}">
                                            @if($characteristic->icon)
                                                <i class="{{ $characteristic->icon }}"></i>
                                            @endif
                                            {{ $characteristic->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
