@extends('layouts.dash')

@section('content')
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Detalle Parcela</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Detalle parcela</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card card-solid">
        <div class="card-body">
        <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')            
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3 class="d-inline-block d-sm-none">{{ $article->title }}</h3>
                    <div class="col-12">
                        <img src="{{ asset('storage/' . $article->cover_photo) }}" alt="Portada del Artículo">
                    </div>
                    <div class="col-12 product-image-thumbs">
                        <div>
                            @if(is_array($article->photos))
                                @foreach ($article->photos as $photo)
                                    <img src="{{ asset('storage/' . $photo) }}" alt="Foto del Artículo" style="width: 150px; height: auto;">
                                @endforeach
                            @elseif($article->photos)
                                @foreach (json_decode($article->photos) as $photo)
                                    <img src="{{ asset('storage/' . $photo) }}" alt="Foto del Artículo" style="width: 150px; height: auto;">
                                @endforeach
                            @else
                                <p>No hay fotos disponibles.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6">
                    <h3 class="my-3">Editar Titulo:</h3>
                    <input type="text" name="title" value="{{ old('title', $article->title) }}" class="form-control">
                    <p>Editar Descripción</p>
                    <input type="text" name="description" value="{{ old('title', $article->description) }}" class="form-control">
                    <hr>

                    <h4 class="mt-3">Editar Metros cuadrados</h4>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-default text-center">
                        <input type="number" class="form-control col-md-5"name="description" value="{{ old('title', $article->square_meters) }}" class="form-control">
                        </label>
                    </div>

                    <h4 class="mt-3">Metros construidos:</h4>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-default text-center">
                            <input type="radio" name="color_option" id="color_option_b1" autocomplete="off">
                            <span class="text-l">{{ $article->constructed_meters }}</span>
                        </label>
                    </div>

                    <h4 class="mt-3">Región:</h4>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-default text-center">
                            <input type="radio" name="color_option" id="color_option_b1" autocomplete="off">
                            <span class="text-m">{{ $article->region }}</span>
                        </label>
                    </div>

                    <h4 class="mt-3">Ciudad:</h4>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-default text-center">
                            <input type="radio" name="color_option" id="color_option_b1" autocomplete="off">
                            <span class="text-m">{{ $article->city }}</span>
                        </label>
                    </div>

                    <h4 class="mt-3">Calle:</h4>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-default text-center">
                            <input type="radio" name="color_option" id="color_option_b1" autocomplete="off">
                            <span class="text-m">{{ $article->street }}</span>
                        </label>
                    </div>

                    <h4 class="mt-3">Venta o Arriendo:</h4>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-default text-center">
                            <input type="radio" name="color_option" id="color_option_b1" autocomplete="off">
                            <span class="text-m">{{ $article->sale_or_rent }}</span>
                        </label>
                    </div>

                    <div class="form-group">
                        <label>Características:</label>
                        @foreach($characteristics as $characteristic)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="characteristics[{{ $characteristic->id }}]" value="1" id="characteristic_{{ $characteristic->id }}"
                                    {{ $article->characteristics->contains($characteristic->id) ? 'checked' : '' }}>
                                <label class="form-check-label" for="characteristic_{{ $characteristic->id }}">
                                    <i class="{{ $characteristic->icon }}"></i> {{ $characteristic->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection
