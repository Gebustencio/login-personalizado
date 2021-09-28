@extends('layouts.panel')

@section('content')

    <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Nuevo Paciente</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('pacientes') }}" class="btn btn-sm btn-default">Cancelar y volver</a>
            </div>
          </div>
        </div>
        <div class="card-body">
            @if(count($errors)>0)
                <div class="alert alert-danger" rote="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li> {{ $error }} </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('pacientes') }}" method="post">
                @csrf
                <div class="form-group">
                  <label for"name">Nombre del paciente</label>
                  <input type="text" name="name" id="name" class="form-control"
                   value="{{ old('name') }}" placeholder="Nombre de especialidad"  required>
                </div>
                <div class="form-group">
                    <label for"email">E-mail</label>
                    <input type="text" name="email" id="email" class="form-control"
                    value="{{ old('email') }}" placeholder="Correo"  >
                </div>
                <div class="form-group">
                    <label for"ci">Cedula</label>
                    <input type="text" name="ci" id="ci" class="form-control"
                    value="{{ old('ci') }}" placeholder="Cedula de Identidad"  >
                </div>
                <div class="form-group">
                    <label for"address">Direccion</label>
                    <input type="text" name="address" id="address" class="form-control"
                    value="{{ old('address') }}" placeholder="Direccion"  >
                </div>
                <div class="form-group">
                    <label for"phpne">Telefono / Movil</label>
                    <input type="text" name="phone" id="phone" class="form-control"
                    value="{{ old('phone') }}" placeholder="Telefono o Celular"  >
                </div>
                <div class="form-group">
                    <label for"password">Contraseña</label>
                    <input type="text" name="password" id="password" class="form-control"
                    value="{{ old('password') }}" placeholder="Contraseña"  >
                </div>
                <button type="submit" class="btn btn-primary">
                    Guardar
                </button>


            </form>
        </div>

    </div>


@endsection
