@extends('layouts.app')

@section('content')

<br>

<!-- Tabla para mostrar las vacantes almacenadas -->
<div class="row justify-content-center">
    <div class="col-md-12"> <!-- Cambié a col-md-12 para más ancho -->
        @if($vacancies->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-hover table-bordered shadow-lg mx-auto" style="width: 100%;">
                    <thead class="thead-light text-center">
                        <tr style="background-color: #007bff; color: white;">
                            <th>ID</th>
                            <th>Título</th>
                            <th>Descripción</th>
                            <th>Fecha de Publicación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vacancies as $vacancy)
                            <tr class="align-middle text-center" style="transition: background-color 0.3s;">
                                <td>{{ $vacancy->id }}</td>
                                <td>{{ $vacancy->title }}</td>
                                <td>{{ $vacancy->description }}</td>
                                <td>{{ \Carbon\Carbon::parse($vacancy->date)->format('d-m-Y') }}</td> <!-- Conversión a Carbon -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-warning text-center" role="alert">
                No hay vacantes disponibles.
            </div>
        @endif
    </div>
</div>

<style>
    /* Estilos adicionales para la tabla */
    .table {
        border-collapse: separate;
        border-spacing: 0 15px; /* Espaciado entre filas */
    }
    
    .table th, .table td {
        padding: 15px; /* Espaciado interno de las celdas */
        vertical-align: middle;
        border: none; /* Sin bordes en las celdas */
    }

    .table th {
        background-color: #007bff; /* Color de fondo del encabezado */
        color: white; /* Color del texto del encabezado */
    }

    .table tbody tr:hover {
        background-color: #f1f1f1; /* Color de fondo al pasar el cursor */
    }
</style>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
