@extends('layouts.dash')

@section('content')
<div class="container">
    <h1>Agregar Parcela</h1>
    <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Título:</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="description">Descripción:</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="content">Contenido</label>
            <textarea name="content" class="form-control" required></textarea>
         </div>
        <div class="form-group">
            <label for="square_meters">Metros Cuadrados de la Parcela:</label>
            <input type="number" name="square_meters" id="square_meters" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="photos">Fotos:</label>
            <input type="file" name="photos[]" id="photos" class="form-control" multiple>
        </div>

        <div class="form-group">
            <label for="constructed_meters">Metros Construidos:</label>
            <input type="number" name="constructed_meters" id="constructed_meters" class="form-control">
        </div>

        <div class="form-group">
            <label for="region">Región:</label>
            <input type="text" name="region" id="region" class="form-control">
        </div>

        <div class="form-group">
            <label for="city">Ciudad:</label>
            <input type="text" name="city" id="city" class="form-control">
        </div>

        <div class="form-group">
            <label for="street">Calle:</label>
            <input type="text" name="street" id="street" class="form-control">
        </div>

        <div class="form-group">
            <label for="sale_or_rent">Venta o Arriendo:</label>
            <select name="sale_or_rent" id="sale_or_rent" class="form-control">
                <option value="sale">Venta</option>
                <option value="rent">Arriendo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection