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
                            <div class="row">
                                <!-- Nombre del Sitio -->
                                <div class="col-md-6 form-group mb-3">
                                    <label for="site_name">Nombre del Sitio</label>
                                    <input type="text" name="site_name" class="form-control" value="{{ $settings['site_name'] ?? '' }}" required>
                                </div>

                                <!-- Descripción del Sitio -->
                                <div class="col-md-6 form-group mb-3">
                                    <label for="site_description">Descripción del Sitio</label>
                                    <input type="text" name="site_description" class="form-control" value="{{ $settings['site_description'] ?? '' }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Color Primario -->
                                <div class="col-md-6 form-group mb-3">
                                    <label for="primary_color">Color Primario:</label>
                                    <input type="color" id="primary_color" name="primary_color" class="form-control" value="{{ $settings['primary_color'] ?? '#ffffff' }}">
                                </div>

                                <!-- Color Secundario -->
                                <div class="col-md-6 form-group mb-3">
                                    <label for="secondary_color">Color Secundario:</label>
                                    <input type="color" id="secondary_color" name="secondary_color" class="form-control" value="{{ $settings['secondary_color'] ?? '#ffffff' }}">
                                </div>
                            </div>

                            <div class="row">
                                <!-- Color de Enlace -->
                                <div class="col-md-6 form-group mb-3">
                                    <label for="link_color">Color de Enlace:</label>
                                    <input type="color" name="link_color" class="form-control" value="{{ $settings['link_color'] ?? '' }}" required>
                                </div>

                                <!-- Color de Enlace Hover -->
                                <div class="col-md-6 form-group mb-3">
                                    <label for="link_hover_color">Color de Enlace (Hover):</label>
                                    <input type="color" name="link_hover_color" class="form-control" value="{{ $settings['link_hover_color'] ?? '' }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Misión -->
                                <div class="col-md-12 form-group mb-3">
                                    <label for="mission">Misión:</label>
                                    <textarea id="mission" name="mission" class="form-control summernote">{{ $settings['mission'] ?? '' }}</textarea>
                                </div>

                                <!-- Visión -->
                                <div class="col-md-12 form-group mb-3">
                                    <label for="vision">Visión:</label>
                                    <textarea id="vision" name="vision" class="form-control summernote">{{ $settings['vision'] ?? '' }}</textarea>
                                </div>

                                <!-- Sobre Nosotros -->
                                <div class="col-md-12 form-group mb-3">
                                    <label for="about_us">Sobre Nosotros:</label>
                                    <textarea id="about_us" name="about_us" class="form-control summernote">{{ $settings['about_us'] ?? '' }}</textarea>
                                </div>
                            </div>

                            <!-- Dirección -->
                            <div class="form-group mb-3">
                                <label for="address">Dirección:</label>
                                <input id="address" name="address" class="form-control" value="{{ $settings['address'] ?? '' }}" type="text">
                            </div>

                            <!-- Botón de Enviar -->
                            <button type="submit" class="btn btn-info">{{ isset($setting) ? 'Actualizar' : 'Crear' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRuDch_iRINkMpRTc-m5EFIhpZ8CdeqBs&libraries=places"></script>
@endsection
