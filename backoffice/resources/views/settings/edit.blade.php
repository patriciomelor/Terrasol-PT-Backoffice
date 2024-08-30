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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="site_name">Nombre del Sitio</label>
                                    <input type="text" name="site_name" class="form-control" value="{{ $settings['site_name'] ?? '' }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="site_description">Descripción del Sitio</label>
                                    <input type="textarea" name="site_description" class="form-control" value="{{ $settings['site_description'] ?? '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-5 ">
                                         <label for="primary_color">Color Primario:</label>
                                         <input type="color" id="primary_color" name="primary_color" value="{{ $settings['primary_color'] ?? '#ffffff' }}">
                                    </div>
                                    <div class="col-md-5 ">
                                         <label for="secondary_color">Color Secundario:</label>
                                         <input type="color" id="secondary_color" name="secondary_color" value="{{ $settings['secondary_color'] ?? '#ffffff' }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-5 ">
                                        <label for="link_color">Color de Enlace</label>
                                        <input type="color" name="link_color"  value="{{ $settings['link_color'] ?? '' }}" required>
                                    </div>
                                    <div class="col-md-5 ">                              
                                        <label for="link_hover_color">Color de Enlace (Hover)</label>
                                        <input type="color" name="link_hover_color" value="{{ $settings['link_hover_color'] ?? '' }}" required>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="mission">Misión:</label>
                                    <textarea id="mission" name="mission" class="summernote">{{ $settings['mission'] ?? '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="vision">Visión:</label>
                                    <textarea id="vision" name="vision" class="summernote">{{ $settings['vision'] ?? '' }}</textarea>
                                </div>
                                <div class="form-group">
                                <label for="about_us">Sobre Nosotros:</label>
                                <textarea id="about_us" name="about_us" class="summernote">{{ $settings['about_us'] ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                            <label for="address">Dirección:</label>
                            <input id="address" name="address" class="form-control" value="{{ $settings['address'] ?? '' }}" type="text">
                            </div>


                            <!-- Agrega más campos según sea necesario -->
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
