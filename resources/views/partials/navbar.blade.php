<nav class="main-header navbar navbar-expand navbar-dark text-white">
  <!-- <a class="navbar-brand ms-4" href="{{ route('raiz') }}">Evaluación 2</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span> -->

  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="bi bi-list"></i></a>
    </li>
  </ul>
  <span>Sistema de Códigos QR | Diseño y Programación | CMMEdu</span>

  <!-- </button> -->

  <!-- Right navbar links -->
  @if(Auth::check())
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <form class="" action="{{ Route('usuario.logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</button>
      </form>
    </li>
  </ul>
  @else
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="btn btn-primary" href="{{ route('login') }}">
        <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
      </a>
    </li>
  </ul>
  @endif

</nav>