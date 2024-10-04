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
   

            <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1">{{ isset($article) ? 'Editar' : 'Crear' }} Parcela</h4>
                        <p class="mb-0">Orders placed across your store</p>
                    </div>
                    <div class="d-flex align-content-center flex-wrap gap-4">
                        <div class="d-flex gap-4">
                            <a type="button" href="{{ route('articles.index') }}"class="btn btn-label-secondary waves-effect">Discard</a>
                        </div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">publicar parcela</button>
                    </div>
                </div>
                @csrf
                <div class="row">
                    <!-- Product Information -->
                    <div class="col-12 col-lg-8">
                        <div class="card mb-6">
                            <div class="card-header">
                                <h5 class="card-tile mb-0">Información del Producto</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-6">
                                    <label class="form-label" for="ecommerce-product-name">Nombre</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="ecommerce-product-name" placeholder="Product title" name="title" value="{{ old('title') }}">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                           

                                <!-- Descripción -->
                                <div class="mb-6">
                                    <label for="description" class="form-label">Descripción</label>
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
                                    @error('description')
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
                                        <input type="file" class="form-control @error('cover_photo') is-invalid @enderror" name="cover_photo" id="cover_photo" required>
                                        @error('cover_photo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    
                                    </div>
                                <div class="col">
                                    <label for="photos">Fotos Adicionales</label>
                                    <input type="file" class="form-control @error('photos.*') is-invalid @enderror" name="photos[]" id="photos" multiple>
                                    @error('photos.*')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pricing Section -->
                    <div class="col-12 col-lg-4">
                          <!-- Organize Section -->
                        <div class="card mb-6">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Características</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-6">
                              
                                    @error('category')
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
                            </div>
                        </div>
                        <div class="card mb-6">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Precios</h5>
                            </div>
                            <div class="card-body">
                                    <label class="form-label" for="ecommerce-product-price">Precio Base</label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="ecommerce-product-price" placeholder="Precio" name="price" value="{{ old('price') }}">
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                <div class="mb-6">
                                    <label class="form-label" for="ecommerce-product-discount-price">Precio con Descuento</label>
                                    <input type="number" class="form-control @error('discount_price') is-invalid @enderror" id="ecommerce-product-discount-price" placeholder="Descuento" name="discount_price" value="{{ old('discount_price') }}">
                                    @error('discount_price')
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
