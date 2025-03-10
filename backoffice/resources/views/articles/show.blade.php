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

        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card card-solid">
        <div class="card-body">

            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3 class="d-inline-block d-sm-none">{{ $article->title }}</h3>
                    <!-- Imagen principal -->
                    <div class="col-12">
                        <img id="main-image" src="data:image/jpeg;base64,{{ $article->cover_photo }}" width="80%" alt="Portada del Artículo">
                    </div>

                    <!-- Miniaturas -->
                    <div class="col-12 product-image-thumbs d-flex">
                        @if (is_array($article->photos))
                            @foreach ($article->photos as $photo)
                                <div class="product-image-thumb">
                                    <img src="data:image/jpeg;base64,{{ $photo }}" class="thumb-img" style="width: 150px; height: auto;" alt="Foto del Artículo">
                                </div>
                            @endforeach
                        @elseif($article->photos)
                            @foreach (json_decode($article->photos) as $photo)
                                <div class="product-image-thumb" >
                                    <img src="data:image/jpeg;base64,{{ $photo }}" class="thumb-img" style="width: 150px; height: auto;" alt="Foto del Artículo">
                                </div>
                            @endforeach
                        @else
                            <p>No hay fotos disponibles.</p>
                        @endif
                    </div>

                </div>
                <div class="col-12 col-sm-6">
                    <h3 class="my-3">{{ $article->title }}</h3>
                    <p>{{ $article->description }}</p>

                    <hr>

 
                </div>
            </div>
            <div class="row">
            <div class="col-md-4 mt-4">
                <h4 class="mt-3">Metros cuadrados:</h4>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-default text-center">
                        <span class="text-l">{{ $article->square_meters }} m²</span>
                    </label>
                </div>

                <h4 class="mt-3">Metros construidos:</h4>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-default text-center">
                        <span class="text-l">{{ $article->constructed_meters }} m²</span>
                    </label>
                </div>

            </div>
            <div class="col-md-4 mt-4">
                <h4 class="mt-3">Región:</h4>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-default text-center">
                        <span class="text-m">{{ $article->region }}</span> 
                    </label>
                </div>

                <h4 class="mt-3">Ciudad:</h4>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-default text-center">
                        <span class="text-m"> {{ $article->city }}</span> 
                    </label>
                </div>

                <h4 class="mt-3">Calle:</h4>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-default text-center">
                        <span class="text-m">{{ $article->street }}</span>
                    </label>
                </div>
            </div>
            <div class="col-md-4 mt-4">
                <h4 class="mt-3">Venta o Arriendo:</h4>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-default text-center">
                        <span class="text-m">{{ $article->sale_or_rent }}</span>
                    </label>
                </div>

                <div class="form-group">
                    <h4>Características:</h4>
                    @foreach($article->characteristics as $characteristic) 
                        <div class="form-check">
                            <input hidden class="form-check-input" disabled type="checkbox" name="characteristics[{{ $characteristic->id }}]" value="1" id="characteristic_{{ $characteristic->id }}" checked>
                            <label class="form-check-label" for="characteristic_{{ $characteristic->id }}">
                                @if(isset($characteristic->icon))
                                    <i class="fas {{ $characteristic->icon }}" style="font-size: 24px; color: black;"> </i> <p style="margin-left:10px ">{{ $characteristic->name }}</p>
                                @endif
                            </label>
                        </div>
                    @endforeach
                    
                </div>
          </div>
        </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
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
