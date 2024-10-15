@extends('layouts.dash')

@section('content')

                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title mb-4">Configuraciones</h3>
                        <a href="{{ route('settings.create') }}"  class="btn rounded-pill btn-label-info waves-effect"><i class=" fa-solid fa-pen-to-square ti-xs me-2"></i>Crear Configuración</a>
                    </div>
                    <div class="card-body">
                        <table id="settings-table" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nombre del Campo</th>
                                    <th>Clave</th>
                                    <th>Valor</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($settings as $setting)
                                <tr>
                                    <td>{{ $setting->name ?? ucfirst(str_replace('_', ' ', $setting->key)) }}</td>
                                    <td>{{ $setting->key }}</td>
                                    <td>{{ $setting->value }}</td>
                                    <td>
                                        <a href="{{ route('settings.edit', $setting) }}" class="btn btn-warning"><i class="fas fa-edit" style="color: white"></i></a>
                                        <form action="{{ route('settings.destroy', $setting) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
@endsection
