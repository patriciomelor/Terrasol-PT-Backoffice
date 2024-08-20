@extends('layouts.dash')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ isset($setting) ? 'Editar Configuración' : 'Crear Configuración' }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">{{ isset($setting) ? 'Editar Configuración' : 'Crear Configuración' }}</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ isset($setting) ? route('settings.update', $setting) : route('settings.store') }}" method="POST">
                            @csrf
                            @if(isset($setting))
                                @method('PUT')
                            @endif
                            <div class="form-group">
                                <label for="key">Clave</label>
                                <input type="text" name="key" class="form-control" value="{{ $setting->key ?? '' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="value">Valor</label>
                                <textarea name="value" class="form-control">{{ $setting->value ?? '' }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ isset($setting) ? 'Actualizar' : 'Crear' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
