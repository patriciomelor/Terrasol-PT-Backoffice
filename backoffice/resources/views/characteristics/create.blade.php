@extends('layouts.dash')

@section('content')
<section class="content-header">

</section>

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="row m-5">
              <h4>{{ isset($characteristic) ? 'Editar' : 'Crear' }} Característica</h4>
          </div>
          <div class="card-body">
            <form action="{{ route('characteristics.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label for="icon" class="form-label">Seleccionar Ícono</label>
                    <input type="text" class="form-control" id="icon" name="icon" value="{{ old('icon') }}" readonly>
                    <button type="button" class="btn btn-secondary mt-2" id="selectIcon">Seleccionar Ícono</button>
                </div>

                <div class="mb-3">
                    <label for="icon-preview" class="form-label">Ícono Seleccionado</label>
                    <i id="icon-preview" class="{{ old('icon') ?? 'fas fa-question' }}" style="font-size: 24px;"></i>
                </div>

                <button type="submit" class="btn btn-info">Guardar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal de Selección de Íconos -->
<div class="modal fade" id="iconPickerModal" tabindex="-1" aria-labelledby="iconPickerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="iconPickerModalLabel">Seleccionar Ícono</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @foreach ([
                        'fa-home', 'fa-car', 'fa-bed', 'fa-warehouse', 'fa-wifi', 'fa-water', 'fa-sun',
                        'fa-building', 'fa-bell', 'fa-cog', 'fa-envelope', 'fa-calendar', 'fa-camera',
                        'fa-chart-line', 'fa-cloud', 'fa-dumbbell', 'fa-flag', 'fa-gift', 'fa-globe',
                        'fa-heart', 'fa-key', 'fa-lock', 'fa-map', 'fa-music', 'fa-phone', 'fa-recycle',
                        'fa-search', 'fa-share', 'fa-star', 'fa-tag', 'fa-trash', 'fa-user', 'fa-users'
                    ] as $icon)
                        <div class="col-3 text-center mb-3">
                            <i class="fas {{ $icon }}" style="font-size: 24px; cursor: pointer;" data-icon="{{ $icon }}"></i>
                            <div class="mt-2">{{ ucfirst(str_replace('fa-', '', $icon)) }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var iconPickerModal = new bootstrap.Modal(document.getElementById('iconPickerModal'));

        document.getElementById('selectIcon').addEventListener('click', function () {
            iconPickerModal.show();
        });

        document.querySelectorAll('#iconPickerModal .modal-body i').forEach(function (iconElement) {
            iconElement.addEventListener('click', function () {
                var iconClass = this.getAttribute('data-icon');
                document.getElementById('icon').value = iconClass;
                document.getElementById('icon-preview').className = 'fas ' + iconClass;
                iconPickerModal.hide();
            });
        });
    });
</script>
@endsection
