{{ view('layouts.header') }}
@extends('layouts.app') 

@section('content')
<div class="container">
<h1 class="text-center display-4">Calendario de Entrevistas</h1>

    <div class="row justify-content-center mt-4">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">

                    <style>
                        table {
                            width: 100%;
                            border-collapse: collapse; /* Asegura que no haya espacio entre celdas */
                        }

                        th, td {
                            border: 1px solid #dee2e6; /* Borde de las celdas */
                            height: 100px; /* Altura de cada celda */
                            vertical-align: top; /* Alineación vertical superior */
                        }

                        th {
                            background-color: #f8f9fa; /* Color de fondo para encabezados */
                            color: #495057; /* Color del texto */
                        }

                        .text-success {
                            color: green; /* Color para eventos */
                        }

                        .event {
                            background-color: #d4edda; /* Color de fondo para eventos */
                            padding: 5px;
                            border-radius: 5px; /* Bordes redondeados */
                            margin-top: 5px; /* Espacio superior */
                        }

                        .form-container {
                            margin-bottom: 20px;
                        }

                        .form-header {
                            margin-bottom: 20px;
                        }

                        .form-control {
                            border: 1px solid #ced4da;
                            border-radius: 0.25rem;
                        }

                        .btn-primary {
                            width: 100%; /* Botón a ancho completo */
                        }
                    </style>

                    <!-- Formulario para agregar entrevistas -->
                    <div class="form-container">
                        <h5 class="form-header">Agregar Nueva Entrevista</h5>
                        <form action="{{ route('interviews.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="date">Fecha de la Entrevista</label>
                                <input type="date" name="date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Descripción de la Entrevista</label>
                                <input type="text" name="description" class="form-control" placeholder="Descripción de la entrevista" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Agregar Entrevista</button>
                        </form>
                    </div>

                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th>Domingo</th>
                                <th>Lunes</th>
                                <th>Martes</th>
                                <th>Miércoles</th>
                                <th>Jueves</th>
                                <th>Viernes</th>
                                <th>Sábado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // Obtener el mes y el año actual
                                $month = date('m');
                                $year = date('Y');

                                // Obtener el primer día del mes y el número de días en el mes
                                $firstDay = strtotime("$year-$month-01");
                                $daysInMonth = date('t', $firstDay);

                                // Obtener el índice del primer día (0=domingo, 6=sábado)
                                $firstDayIndex = date('w', $firstDay);

                                // Obtener las entrevistas de la base de datos
                                $interviews = session('interviews', []); // Usando la sesión para almacenar entrevistas
                            @endphp

                            @for ($i = 0; $i < 6; $i++) {{-- Seis filas para el calendario --}}
                                <tr>
                                    @for ($j = 0; $j < 7; $j++) {{-- Siete columnas para los días de la semana --}}
                                        @php
                                            $day = $i * 7 + $j - $firstDayIndex + 1; // Calcular el día actual
                                        @endphp

                                        <td>
                                            @if ($day > 0 && $day <= $daysInMonth)
                                                <div>
                                                    <strong>{{ $day }}</strong>
                                                    {{-- Mostrar entrevistas de este día --}}
                                                    @foreach ($interviews as $interview)
                                                        @if (date('j', strtotime($interview['date'])) == $day)
                                                            <div class="event">
                                                                <span class="text-success">{{ $interview['description'] }}</span>
                                                                <form action="{{ route('interviews.destroy', $interview['id']) }}" method="POST" style="display:inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-link text-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta entrevista?')">Eliminar</button>
                                                                </form>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </td>
                                    @endfor
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-1 text-center">
    <a href="http://127.0.0.1:8000/index" class="btn btn-primary btn-sm"> {{-- Clase btn-sm añadida --}}
        Ir a la página principal
    </a>
</div>


@endsection

@section('scripts')
<script>
    // Script para manejar el formulario si es necesario (puedes añadir validaciones o lógica adicional aquí)
</script>
@endsection
{{ view('layouts.footer') }}