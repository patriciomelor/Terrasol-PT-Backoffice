@extends('layouts.dash')

@section('content')

                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title mb-4">Configuraciones</h3>
                        <a href="{{ route('settings.create') }}"  class="btn rounded-pill btn-label-info waves-effect"><i class=" fa-solid fa-pen-to-square ti-xs me-2"></i>Crear Configuración</a>
                    </div>
                    <div class="card-body">
                        <table id="settings-table" class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>Nombre del Campo</th>
                                    <th>Clave</th>
                                    <th style="width: 50%">Valor</th>
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
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light show" data-bs-toggle="dropdown" aria-expanded="true">
                                              <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end">
                                              <li><a class="dropdown-item waves-effect" href="{{ route('settings.edit', $setting) }}" >Editar</a></li>
                                              <li> <form action="{{ route('settings.destroy', $setting) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item waves-effect">Eliminar</button>
                                            </form></li>
                                            </ul>
                                          </div>
                                       
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
@endsection
