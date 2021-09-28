 {{-- Heading --}}
 <h6 class="navbar-heading text-muted">GESTIONAR DATOS</h6>
 {{-- Navigation --}}
 <ul class="navbar-nav">
    @if(auth()->user()->role=='admin')
        <li class="nav-item">
            <a class="nav-link" href="home">
            <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./especialidades">
              <i class="ni ni-planet text-blue"></i> Especialidades
            </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./doctores">
            <i class="ni ni-single-02  text-orange"></i> Medicos
          </a>
        </li>
        <li class="nav-item">
             <a class="nav-link" href="./pacientes">
            <i class="ni ni-satisfied text-yellow"></i> Pacientes
             </a>
        </li>
    @elseif (auth()->user()->role=='doctor')
        <li class="nav-item">
            <a class="nav-link" href="./calendario">
            <i class="ni ni-calendar-grid-58 text-danger"></i> Gestionar horario
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./calendario">
            <i class="ni ni-time-alarm text-orange"></i> Mis Citas
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./doctors">
                <i class="ni ni-single-02  text-orange"></i> Mis pacientes
            </a>
        </li>
        @else {{-- paciente --}}
        <li class="nav-item">
            <a class="nav-link" href="./citas/create">
            <i class="ni ni-laptop text-orange"></i> Reservar Citas
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./citas">
                <i class="ni ni-single-02  text-orange"></i> Mi Cita
            </a>
        </li>
    @endif

    <li class="nav-item">
      <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
      document.getElementById('formLogout').submit();" >
        <i class="ni ni-key-25 text-info"></i> Cerar session
      </a>
         <form action="{{ route('logout') }}" method="post" style="display: none;" id="formLogout">
              @csrf
         </form>
    </li>

 </ul>
  {{-- Divider --}}
 @if(auth()->user()->role=='admin')
 <hr class="my-3">
 {{-- Heading --}}
 <h6 class="navbar-heading text-muted">REPORTES</h6>
 {{-- Navigation --}}
  <ul class="navbar-nav mb-md-3">
   <li class="nav-item">
     <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html">
       <i class="ni ni-palette"></i> Frecuencia de citas
     </a>
   </li>
   <li class="nav-item">
     <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html">
       <i class="ni ni-spaceship"></i> Medicos mas activos
     </a>
   </li>

 </ul>
 @endif
