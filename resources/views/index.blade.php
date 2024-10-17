{{ view('layouts.header') }}

<div class="content-wrapper mt-4">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <h1 class="m-0" style="color: #1B6DA9;">Manejo de Cv´s - Counting Stars</h1>
                </div>
                <div class="col-4 text-right d-flex justify-content-end align-items-center">
                    <a href="{{ route('vacancies.index') }}" class="add-btn mx-2 d-flex flex-column align-items-center">
                        <i class="fa fa-briefcase"></i>
                        <span>Agregar Vacantes</span>
                    </a>
                    <a href="{{ route('vacancies.show') }}" class="add-btn mx-2 d-flex flex-column align-items-center">
                        <i class="fa fa-briefcase"></i>
                        <span>Consultar Vacantes</span>
                    </a>
                    <a href="{{ route('user.profile.create') }}" class="add-btn mx-2 d-flex flex-column align-items-center">
                        <i class="fa fa-user-plus"></i>
                        <span>Agregar nuevo</span>
                    </a>
                    <a href="#" onclick="promptPassword()" class="add-btn mx-2 d-flex flex-column align-items-center">
                        <i class="fa fa-calendar"></i>
                        <span>Calendario de Entrevistas</span>
                    </a>
                    <script>
                        function promptPassword() {
                            var password = prompt("Por favor, ingrese la contraseña:");
                            var correctPassword = "enterprisecalendar";

                            if (password === correctPassword) {
                                window.location.href = "{{ route('user.profile.calendar') }}";
                            } else {
                                alert("Contraseña incorrecta");
                            }
                        }
                    </script>

                    <a href="#" onclick="promptFilterPassword()" class="add-btn mx-2 d-flex flex-column align-items-center">
                        <i class="fa fa-filter"></i>
                        <span>Filtrar</span>
                    </a>
                    <script>
                        function promptFilterPassword() {
                            var password = prompt("Por favor, ingrese la contraseña para acceder ");
                            var correctPassword = "enterprisefilter"; 

                            if (password === correctPassword) {
                                window.location.href = "{{ route('user.profile.filter') }}";
                            } else {
                                alert("Contraseña incorrecta");
                            }
                        }
                    </script>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ul class="page-breadcrumb breadcrumb">
                        <li class="breadcrumb-item"><i class="fas fa-angle-right"></i></li>
                        <li class="breadcrumb-item">Home</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="color: #1B6DA9;">Perfiles de Usuario </h3>
                    </div>
                    <div class="card-body">
                        <table id="user_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Foto de perfil</th>
                                    <th>Título</th>
                                    <th>Nombre(s)</th>
                                    <th>Apellidos</th>
                                    <th>Email</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 1;
                                @endphp
                                @foreach ($users_data as $user)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>
                                            <img class="profile box-image-preview img-fluid img-circle elevation-2" src="{{ isset($user['personal_info']['image_path']) && !empty($user['personal_info']['image_path']) ? asset('assets/images/'. $user['personal_info']['image_path'])  : asset('assets/images/user-thumb.jpg') }}"
                                            alt="" style="height:40px; width:40px;" />
                                        </td>
                                        <td>{{ $user['personal_info']['profile_title'] }}</td>
                                        <td>{{ $user['personal_info']['first_name'] }}</td>
                                        <td>{{ $user['personal_info']['last_name'] }}</td>
                                        <td>{{ $user['contact_info']['email'] }}</td>
                                        <td align="center">
                                            <div class="d-flex flex-row justify-content-around">
                                                <a class="view_btn" href="{{ route('user.profile.view', $user['personal_info']['id']) }}" title="Plantilla 1 ">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a class="view_btn" href="{{ route('user.profile.viewdos', $user['personal_info']['id']) }}" title="Plantilla 2">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a class="view_btn" href="{{ route('user.profile.viewset', $user['personal_info']['id']) }}" title="Plantilla 3">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a class="edit_btn" href="{{ route('edit', $user['personal_info']['id']) }}" title="Edit Profile">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('destroy', $user['personal_info']['id']) }}" method="post" class="d-inline" id="delete-form-{{ $user['personal_info']['id'] }}">
                                                    @csrf
                                                    <a href="javascript:void(0)" onclick="promptDeletePassword({{ $user['personal_info']['id'] }})" class="del_btn" title="Borrar perfil">
                                                        <i class="fas fa-user-minus text-danger"></i>
                                                    </a>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @php
                                        $count++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
   
                </div>
            </div>
        </div>
     
    </div>
</div>

<div class="container mt-4 text-center">
    <a href="http://127.0.0.1:8000/" class="btn btn-primary">Ir a la página principal</a>
</div>

<script>
    function promptDeletePassword(userId) {
        var password = prompt("Por favor, ingrese la contraseña para eliminar el perfil:");

        var correctPassword = "enterprisedelete";

        if (password === correctPassword) {
            document.getElementById("delete-form-" + userId).submit(); 
        } else {
            alert("Contraseña incorrecta");
        }
    }
</script>

{{ view('layouts.footer') }}
