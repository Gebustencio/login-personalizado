@extends('layouts.panel')

@section('content')

    <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Reservar Nueva Citas</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('citas') }}" class="btn btn-sm btn-default">Cancelar y volver</a>
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

            <form action="{{ url('citas') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for"descripcion">Descripcion</label>
                    <input type="text" name="descripcion" id="descripcion" class="form-control"
                     placeholder="Describe brevemente la consulta "  required  value="{{ old('descripcion') }}">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for"especialidad">Especialidad</label>
                        <select name="especialidad_id" id="especialidad" class="form-control" required>
                            <option value="">Seleccionar especialidad</option>
                            @foreach ($especialidades as $especialidad )
                                <option value="{{ $especialidad->id }}" @if(old('especialidad_id')==$especialidad->id) selected @endif> {{ $especialidad->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="doctor">Medico</label>
                        <select name="doctor_id" id="doctor" class="form-control" required>
                            @foreach ($doctors as $doctor )
                             <option value="{{ $doctor->id }}" @if(old('doctor_id')==$doctor->id) selected @endif> {{ $doctor->name }}</option>
                             @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="date">Fecha</label>
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                        </div>
                        <input class="form-control datepicker" placeholder="Select date"
                        id="date" name="fecha_programacion" type="text" value="{{ old('hora_programacion',date('Y-m-d') )}}"
                         data-date-format="yyyy-mm-dd"
                          data-date-start-date="{{ date('Y-m-d') }}"
                          data-date-end-date="+30d">
                    </div>
                </div>
                <div class="form-group">
                    <label for"hora">Hora de atencion</label>
                    <div id="hours" >
                        <div class="alert alert-info" role="alert">
                            Selecciona un medico y una fecha,para ver sus horas disponibles
                            </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for"type">Tipo de citas</label>
                    <div class="custom-control custom-radio mb-3">
                        <input type="radio" id="type1" name="tipo" class="custom-control-input"
                        @if(old('tipo','Consulta')=='Consulta') checked @endif value="Consulta">
                        <label class="custom-control-label" for="type1">Consulta</label>
                     </div>
                     <div class="custom-control custom-radio mb-3">
                        <input type="radio" id="type2" name="tipo" class="custom-control-input"
                        @if(old('tipo')=='Examen') checked @endif value="Examen">
                        <label class="custom-control-label" for="type2">Examen</label>
                     </div>
                     <div class="custom-control custom-radio mb-3">
                        <input type="radio" id="type3" name="tipo" class="custom-control-input"
                        @if(old('tipo')=='Operacion') checked @endif value="Operacion">
                        <label class="custom-control-label" for="type3">Operacion</label>
                     </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    Guardar
                </button>


            </form>
        </div>

    </div>
@endsection
@section('scripts')
<script src="{{ asset('vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')  }}">
</script>
<script src="{{ asset('/js/bus/create.js')  }}">
</script>
@endsection
