@extends('layouts.form')
@section('title','Registro')
@section('subtitle','Ingresar tus datos para registrarte')
@section('content')
 <!-- Page content -->
     <div class="container mt--2 pb-5">
        <!-- Table -->
        <div class="row justify-content-center">
          <div class="col-lg-6 col-md-6">
            <div class="card bg-secondary shadow border-6">
              <div class="card-body px-lg-5 py-lg-5">
                <form role="form" method="POST" action="{{ route('register') }}">
                    @csrf
                  <div class="form-group">
                    <div class="input-group input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                      </div>
                      <input id="name" type="text" placeholder="Nombre" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                         @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                      </div>
                      <input id="email" placeholder="Correo electronico" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                             </span>
                        @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                      </div>
                        <input id="password" placeholder="Contraseña" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                         @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                      </div>
                      <input id="password-confirm" placeholder="Confirmar contraseña" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-4">Confirmar Registro</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection
