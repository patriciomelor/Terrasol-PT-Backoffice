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
                                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" autofocus>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6 float-left">
                                    <label for="cover_photo">Subir Foto de Portada</label>
                                    <input type="file" class="form-control @error('cover_photo') is-invalid @enderror" name="cover_photo" id="cover_photo" required>
                                    @error('cover_photo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6 float-right">
                                    <label for="photos">Subir Fotos Adicionales</label>
                                    <input type="file" class="form-control @error('photos.*') is-invalid @enderror" name="photos[]" id="photos" multiple>
                                    @error('photos.*')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">Descripción:</label>
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="content">Contenido:</label>
                                    <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" required>{{ old('content') }}</textarea>
                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6 float-left">
                                    <label for="square_meters">Metros Cuadrados de la Parcela:</label>
                                    <input type="number" name="square_meters" id="square_meters" class="form-control @error('square_meters') is-invalid @enderror" value="{{ old('square_meters') }}" autofocus>
                                    @error('square_meters')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6 float-right">
                                    <label for="constructed_meters">Metros Construidos:</label>
                                    <input type="number" name="constructed_meters" id="constructed_meters" class="form-control @error('constructed_meters') is-invalid @enderror" value="{{ old('constructed_meters') }}" autofocus>
                                    @error('constructed_meters')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6 float-left">
                                    <label for="region">Región:</label>
                                    <input type="text" name="region" id="region" class="form-control @error('region') is-invalid @enderror" value="{{ old('region') }}" autofocus>
                                    @error('region')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6 float-right">
                                    <label for="city">Ciudad:</label>
                                    <input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}" autofocus>
                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6 float-left">
                                    <label for="street">Calle:</label>
                                    <input type="text" name="street" id="street" class="form-control @error('street') is-invalid @enderror" value="{{ old('street') }}" autofocus>
                                    @error('street')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6 float-right">
                                    <label for="sale_or_rent">Venta o Arriendo:</label>
                                    <select name="sale_or_rent" id="sale_or_rent" class="form-control @error('sale_or_rent') is-invalid @enderror">
                                        <option value="sale" {{ old('sale_or_rent') == 'sale' ? 'selected' : '' }}>Venta</option>
                                        <option value="rent" {{ old('sale_or_rent') == 'rent' ? 'selected' : '' }}>Arriendo</option>
                                    </select>
                                    @error('sale_or_rent')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Características:</label>
                                    <div class="characteristics-container">
                                        @foreach ($characteristics as $characteristic)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="characteristics[]" value="{{ $characteristic->id }}" id="characteristic_{{ $characteristic->id }}">
                                                <label class="form-check-label" for="characteristic_{{ $characteristic->id }}">
                                                    <i class="fa {{ $characteristic->icon }}" style="margin-right:5px!important;"></i>
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

                                <button type="submit" class="btn btn-info">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
