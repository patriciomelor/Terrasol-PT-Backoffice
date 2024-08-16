@extends('layouts.dash')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detalle PArcela</h1>
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
          <div class="row">
            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none">{{ $article->title }}</h3>
              <div class="col-12">
                <img src="../../dist/img/prod-1.jpg" class="product-image" alt="Product Image">
              </div>
              <div class="col-12 product-image-thumbs">
              <div>
              @if($article->photos)
            @foreach($article->photos as $photo)
                <div class="product-image-thumb active">
                    <img src="{{ asset('storage/' . $photo) }}" alt="Foto" style="max-width: 100%; height: auto;">
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

              <h4 class="mt-3">Metros cuadrados: </h4>
              <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-default text-center">
                  <input type="radio" name="color_option" id="color_option_b1" autocomplete="off">
                  <span class="text-l">{{ $article->square_meters }}</span>
                </label>

              </div>
              <h4 class="mt-3">Metros construidos: </h4>

              <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-default text-center">
                  <input type="radio" name="color_option" id="color_option_b1" autocomplete="off">
                  <span class="text-l">{{ $article->constructed_meters }}</span>
                </label>
              </div>
              <h4 class="mt-3">Región: </h4>

                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-default text-center">
                    <input type="radio" name="color_option" id="color_option_b1" autocomplete="off">
                    <span class="text-m">{{ $article->region }}</span>
                </label>
                </div>
                <h4 class="mt-3">ciudad: </h4>

                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-default text-center">
                    <input type="radio" name="color_option" id="color_option_b1" autocomplete="off">
                    <span class="text-m">{{ $article->city }}</span>
                </label>
                </div>
                <h4 class="mt-3">Calle: </h4>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-default text-center">
                    <input type="radio" name="color_option" id="color_option_b1" autocomplete="off">
                    <span class="text-m">{{ $article->street }}</span>
                </label>
                </div>
                <h4 class="mt-3">Venta o Arriendo: </h4>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-default text-center">
                    <input type="radio" name="color_option" id="color_option_b1" autocomplete="off">
                    <span class="text-m">{{ $article->sale_or_rent }}</span>
                </label>
                </div>
            </div>
          </div>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>


@endsection
