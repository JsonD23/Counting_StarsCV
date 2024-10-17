{{ view('layouts.header') }}
<div class="container mt-4">
    <h2 class="text-center" style="color: #1B6DA9;">Filtrar Perfiles</h2>
    <form action="{{ route('user.profile.filter') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="profile_title" class="form-control" placeholder="Buscar por título" value="{{ request()->get('profile_title') }}">
            </div>
            <div class="col-md-4">
                <input type="text" name="first_name" class="form-control" placeholder="Buscar por nombre" value="{{ request()->get('first_name') }}">
            </div>
            <div class="col-md-4">
                <input type="text" name="id" class="form-control" placeholder="Buscar por ID" value="{{ request()->get('id') }}">
            </div>
        </div>
        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Nombre</th>
                   

                </tr>
            </thead>
            <tbody>
                @foreach ($users_data as $user)
                    <tr>

                        <td>{{ $user->id }}</td>
                        <td>{{ $user->profile_title }}</td>
                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>


                     
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="container mt-4 text-center">
    <a href="http://127.0.0.1:8000/index" class="btn btn-primary">
       Regresar
    </a>
</div>
</div>

{{ view('layouts.footer') }}
