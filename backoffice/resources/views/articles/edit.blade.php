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
                    <input type="text" name="title" value="{{ old('title', $article->title) }}" class="form-control" autofocus>
                    <p>Editar Descripción</p>
                    <input type="textarea" name="description" value="{{ old('description', $article->description) }}" class="form-control" autofocus>
                    <hr>

                    <h4 class="mt-3">Editar Metros cuadrados</h4>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <input type="number" class="form-control" autofocus name="description" value="{{ old('square_meters', $article->square_meters) }}" class="form-control" autofocus>
                    </div>

                    <h4 class="mt-3">Metros construidos:</h4>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <input type="number" class="form-control" autofocus value="{{ old('constructed_meters',$article->constructed_meters)}}">      
                    </div>

                    <h4 class="mt-3">Región:</h4>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <input type="text" class="form-control" autofocus name="region-input" id="region-input" value="{{ old('region',$article->region)}}">
                    </div>

                    <h4 class="mt-3">Ciudad:</h4>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <input type="text" class="form-control" autofocus id="ciudad-input" name="ciudad-input"value="{{ old('city',$article->city)}}" disabled>
                    </div>

                    <h4 class="mt-3">Calle:</h4>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <input type="text" class="form-control" autofocus id="calle-input" name="calle-input"value="{{ old('street',$article->street)}}" disabled>
                        </label>
                    </div>

                    <h4 class="mt-3">Venta o Arriendo:</h4>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                             <select name="sale_or_rent" id="sale_or_rent" class="form-control">
                                <option value="sale">Venta</option>
                                <option value="rent">Arriendo</option>
                            </select>
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
                    
                    <button type="submit" class="btn btn-info">Guardar</button>
                    </form>
                </div>
            </div>
          
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRuDch_iRINkMpRTc-m5EFIhpZ8CdeqBs&libraries=places"></script>


@endsection
