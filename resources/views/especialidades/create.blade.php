@extends('layouts.panel')

@section('content')

    <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Nueva Especialidades</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('especialidades') }}" class="btn btn-sm btn-default">Cancelar y volver</a>
            </div>
          </div>
        </div>
        <card-body>
            @if(count($errors)>0)
                <div class="alert alert-danger" rote="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li> {{ $error }} </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('especialidades') }}" method="post">
                @csrf
                <div class="form-group">
                  <label for"nombre">Nombre de especialidad</label>
                  <input type="text" name="nombre" id="nombre" class="form-control"
                   value="{{ old('nombre') }}" placeholder="Nombre de especialidad"  required>
                </div>
                <div class="form-group">
                    <label for"descripcion">Descripcion</label>
                    <input type="text" name="descripcion" id="descripcion" class="form-control"
                    value="{{ old('descripcion') }}" placeholder="Descripcion"  >
                </div>
                <button type="submit" class="btn btn-primary">
                    Guardar
                </button>


            </form>
        </card-body>

    </div>


@endsection
