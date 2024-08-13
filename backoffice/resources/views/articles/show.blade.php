@extends('layouts.dash')

@section('content')
<h1>{{ $article->title }}</h1>
    <p>{{ $article->description }}</p>
    <p>Metros cuadrados: {{ $article->square_meters }}</p>
    <p>Metros construidos: {{ $article->constructed_meters }}</p>
    <p>Región: {{ $article->region }}</p>
    <p>Ciudad: {{ $article->city }}</p>
    <p>Calle: {{ $article->street }}</p>
    <p>Venta o Arriendo: {{ $article->sale_or_rent }}</p>

    <div>
        <h2>Fotos</h2>
        @if($article->photos)
            @foreach(json_decode($article->photos) as $photo)
                <img src="{{ asset('storage/' . $photo) }}" alt="Foto" style="max-width: 100%; height: auto;">
            @endforeach
        @else
            <p>No hay fotos disponibles.</p>
        @endif
    </div>

@endsection
