@extends('layouts.panel')

@section('content')

    <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Medicos</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('doctores/create') }}" class="btn btn-sm btn-success">Nueva Medico</a>
            </div>
          </div>
        </div>
        <div class="card-body">
            @if(session('notification'))
                <div class="alert alert-success" role="alert">
                    {{ session('notification') }}
                </div>
            @endif
        </div>

        <div class="table-responsive">
          <!-- Projects table -->
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th scope="col">Cedula</th>
                        <th scope="col"class="col text-right">Opciones     </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $doctors as $doctor )
                        <tr>
                            <th scope="row">
                                {{ $doctor->name }}
                             </th>
                            <td>
                                {{ $doctor->email }}
                            </td>
                            <td>
                                {{ $doctor->ci }}
                            </td>
                            <td class="col text-right">

                                <form action="{{ url('/doctores/'.$doctor->id)}}" method="post">
                                     @csrf
                                     @method('DELETE')
                                     <a href="{{ url('/doctores/'.$doctor->id.'/edit') }}" class="btn btn-sm btn-primary">Editar</a>
                                     <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                                </form>

                             </td>
                        </tr>
                    @endforeach

                 </tbody>
            </table>
        </div>
    </div>


@endsection
