<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
  <a class="navbar-brand ms-4" href="{{ route('raiz') }}">Evaluación 2</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto me-4">
      @if(Auth::check())
      <!-- Mostrar solo cuando el usuario está autenticado -->
      <li class="nav-item">
        <a class="nav-link" href="{{ route('usuario.info') }}">Perfil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('proyects.home') }}">Proyectos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('usuario.logout') }}"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          Cerrar Sesión
        </a>
        <form id="logout-form" action="{{ route('usuario.logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </li>
      @else
      <!-- Mostrar solo cuando el usuario no está autenticado -->
      <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('usuario.registrar') }}">Registrarse</a>
      </li>
      @endif
    </ul>
  </div>
</nav>