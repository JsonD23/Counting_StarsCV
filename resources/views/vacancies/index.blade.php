@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center"> 

    <h1 class="mb-5" style="font-size: 3rem; color: #007bff;">Vacantes</h1>

  
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('vacancies.store') }}" method="POST" class="mb-5 p-5 border rounded bg-light shadow-lg" style="border-color: #007bff;">
                @csrf
                <h2 class="mb-4 text-center" style="font-size: 2.5rem; color: #ffa500;">Agregar Vacante</h2>
                
         
                <div class="form-group">
                    <label for="title" class="font-weight-bold" style="color: #007bff;">Título</label>
                    <input type="text" name="title" id="title" class="form-control text-center" required
                        style="border: 2px solid #007bff; border-radius: 15px; padding: 10px; box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);">
                </div>

                <!-- Descripción -->
                <div class="form-group mt-4">
                    <label for="description" class="font-weight-bold" style="color: #007bff;">Descripción</label>
                    <textarea name="description" id="description" class="form-control text-center" rows="4" required
                        style="border: 2px solid #007bff; border-radius: 15px; padding: 10px; box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);"></textarea>
                </div>

                <!-- Fecha de Publicación -->
                <div class="form-group mt-4">
                    <label for="date" class="font-weight-bold" style="color: #007bff;">Fecha de Publicación</label>
                    <input type="date" name="date" id="date" class="form-control text-center" required
                        style="border: 2px solid #007bff; border-radius: 15px; padding: 10px; box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);">
                </div>

                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-lg shadow" 
                        style="background-color: #007bff; color: white; border-radius: 30px; padding: 10px 40px; font-size: 1.2rem; transition: all 0.3s ease;">
                        Agregar Vacante
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Formulario de búsqueda centrado -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-6">
            <form action="{{ route('vacancies.index') }}" method="GET" class="d-flex justify-content-center align-items-center">
                <div class="input-group" style="width: 100%; max-width: 500px;">
                    <input type="text" name="search" class="form-control rounded-pill text-center" placeholder="Buscar por título" value="{{ request('search') }}"
                        style="border: 2px solid #ffa500; padding: 10px; box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);">
                    <div class="input-group-append">
                        <button class="btn shadow ml-2" style="background-color: #ffa500; color: white; border-radius: 30px; padding: 10px 25px; font-size: 1rem; transition: all 0.3s ease;" type="submit">
                            Buscar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabla para mostrar las vacantes almacenadas -->
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if($vacancies->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-hover table-bordered shadow-lg mx-auto" style="width: 100%;">
                        <thead class="thead-dark text-center">
                            <tr style="background-color: #007bff; color: white;">
                                <th>ID</th>
                                <th>Título</th>
                                <th>Descripción</th>
                                <th>Fecha de Publicación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vacancies as $vacancy)
                                <tr class="align-middle text-center">
                                    <td>{{ $vacancy->id }}</td>
                                    <td>{{ $vacancy->title }}</td>
                                    <td>{{ $vacancy->description }}</td>
                                    <td>{{ $vacancy->date }}</td>
                                    <td>
                                        <form action="{{ route('vacancies.destroy', $vacancy->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm rounded-pill" style="background-color: #ffa500; color: white; border: none;">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
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
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection

 

