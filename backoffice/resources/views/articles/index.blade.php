@extends('layouts.dash')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Parcelas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Parcelas</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
          <a href="{{ route('articles.create') }}" class="btn btn-primary mb-3">Agregar Nueva Parcela</a>
          </div>
    <div class="card-body">
    <table id="users-table" class="table table-striped table-primary table-hover">
        <thead>
            <tr>
               <th>Título</th>
                <th>Descripción</th>
                <th>Metros Cuadrados</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
             @foreach ($articles as $article)
                <tr>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->description }}</td>
                    <td>{{ $article->square_meters }}</td>
                    <td>
                        <a href="{{ route('articles.show', $article->id) }}" class="btn btn-info btn-sm">Ver</a>
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
@section('scripts')
<script>
    $(document).ready(function() {
        $('#users-table').DataTable({
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });
    });
</script>
@endsection


@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
