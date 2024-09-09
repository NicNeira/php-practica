<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/proyects" class="brand-link">
    <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">

    <span class="brand-text font-weight-light">Proyecto</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    @if ($user)
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('dist/img/avatar.png') }}" class="img-circle elevation-1" alt="User"
          style="margin-top: 8px; margin-left: -4px; width: 2.5rem; background-color: white">
      </div>
      <div class="info">
        <span class="d-block" style="color: white; ">{{ $user->email }}<br><small
            class="badge badge-info">{{ $user->nombre }}</small></span>
      </div>
    </div>
    @endif

    <!-- Sidebar Menu -->
    <nav class="">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
        data-accordion="false">
        <li class="nav-item">
          <a href="{{ Route('proyects.index') }}" class="nav-link">
            <i class="bi bi-list-ul"></i>
            <p>Proyectos</p>
          </a>
        </li>
        @if(Auth::check())
        <li class="nav-item">
          <a href="{{ Route('proyects.list') }}" class="nav-link">
            <i class="bi bi-pencil-square"></i>
            <p>Proyectos Mantenedor</p>
          </a>
        </li>
        @endif
        <!-- <li class="nav-item">
          <a href="{{ Route('usuario.info') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Usuarios</p>
          </a>
        </li> -->
      </ul>
    </nav>
  </div>
</aside>