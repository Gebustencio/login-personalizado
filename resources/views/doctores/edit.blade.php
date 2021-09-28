@extends('layouts.panel')
@section('styles')
<link rel="stylesheet"
 href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection
@section('content')

    <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Modificar Medico</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('doctores') }}" class="btn btn-sm btn-default">Cancelar y volver</a>
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

            <form action="{{ url('doctores/'.$doctor->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label for"name">Nombre del medico</label>
                  <input type="text" name="name" id="name" class="form-control"
                   value="{{ old('name',$doctor->name) }}" placeholder="Nombre de especialidad"  required>
                </div>
                <div class="form-group">
                    <label for"email">E-mail</label>
                    <input type="text" name="email" id="email" class="form-control"
                    value="{{ old('email',$doctor->email) }}" placeholder="Correo"  >
                </div>
                <div class="form-group">
                    <label for"ci">Cedula</label>
                    <input type="text" name="ci" id="ci" class="form-control"
                    value="{{ old('ci',$doctor->ci) }}" placeholder="Cedula de Identidad"  >
                </div>
                <div class="form-group">
                    <label for"address">Direccion</label>
                    <input type="text" name="address" id="address" class="form-control"
                    value="{{ old('address',$doctor->address) }}" placeholder="Direccion"  >
                </div>
                <div class="form-group">
                    <label for"phone">Telefono / Movil</label>
                    <input type="text" name="phone" id="phone" class="form-control"
                    value="{{ old('phone',$doctor->phone) }}" placeholder="Telefono o Celular"  >
                </div>
                <div class="form-group">
                    <label for"password">Contraseña</label>
                    <input type="text" name="password" id="password" class="form-control"
                     placeholder="Contraseña"  >
                     <p>Ingrese un valorsolo si desea modificar la contraseña </p>
                </div>
                <div class="form-group">
                    <label for="especialidad">Especilidad</label>
                    <select name="especialidad[]" id="especialidad" class="form-control
                    selectpicker"  data-style="btn-secundary" multiple title="Seleccione uno o varios">
                        @foreach ($especialidades as $especialidad )
                            <option value="{{ $especialidad->id }}"> {{ $especialidad->nombre }}</option>
                         @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">
                    Guardar
                </button>


            </form>
        </div>

    </div>


@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(()=>{
        $('#especialidad').selectpicker('val',@json($especialidad_ids));
    });
</script>
@endsection
