@extends('layouts.dash')

@section('content')

        <div class="card">
          <div class="card-header border-bottom">
          <h3 class="card-title mb-4">Característica</h3>
          <a href="{{ route('characteristics.create') }}"  class="btn rounded-pill btn-label-info waves-effect"><i class=" fa-solid fa-pen-to-square ti-xs me-2"></i>Agregar Característica</a>
  </div>
    <div class="card-body">
   
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Icono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($characteristics as $characteristic)
                <tr>
                    <td>{{ $characteristic->name }}</td>
                    <td>
                        @if(isset($characteristic->icon))
                            <i class="fas {{ $characteristic->icon }}" style="font-size: 24px;"></i>
                        @endif

                    </td>
                    <td>
                        <a href="{{ route('characteristics.edit', $characteristic->id) }}" class="btn btn-warning"><i class="fas fa-edit" style="color:white"></i></a>
                        <form action="{{ route('characteristics.destroy', $characteristic->id) }}" method="POST" style="display:inline;">
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
    </div>
    </div>
    </div>
</div>
@endsection
