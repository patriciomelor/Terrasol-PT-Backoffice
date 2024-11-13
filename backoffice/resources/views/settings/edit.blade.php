@extends('layouts.dash')

@section('content')
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
                            <div class="form-group mb-3">
                                <label for="key">Clave</label>
                                <input type="text" name="key" class="form-control" value="{{ $setting->key ?? '' }}" disabled>
                            </div>
                            <div class="form-group mb-3">
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
