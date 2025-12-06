<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="align-items-center d-flex m-0 navbar-brand text-wrap" href="{{ route('dashboard') }}">
        <img src="{{ asset('assets/img/logo_taspen.png') }}" class="navbar-brand-img h-100" alt="Logo Taspen" style="max-height: 50px;">
        <span class="ms-3 font-weight-bold">Monitoring Tugas</span>
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse  w-auto h-100 overflow-visible" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ url('dashboard') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <!-- svg omitted for brevity -->
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>

      <li class="nav-item mt-2">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Manajemen Data</h6>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ Request::is('nasabah*') ? 'active' : '' }}" href="{{ url('nasabah') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-clipboard-list text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Data Nasabah</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ Request::is('jenis-klaim*') ? 'active' : '' }}" href="{{ url('jenis-klaim') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-file-alt text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Data Jenis Klaim</span>
        </a>
      </li>

      {{-- Tampilkan menu Data User hanya untuk Super Admin dan Admin --}}
      @if(auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isAdmin()))
      <li class="nav-item">
        <a class="nav-link {{ Request::is('users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-user-friends text-primary"></i>
          </div>
          <span class="nav-link-text ms-2">Data User</span>
        </a>
      </li>
      @endif

      <li class="nav-item mt-2">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Akun</h6>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ Request::is('profile') ? 'active' : '' }}" href="{{ route('profile.index') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-user-circle text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Profil Saya</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ url('/logout') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-sign-out-alt text-danger text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Logout</span>
        </a>
      </li>
    </ul>
  </div>
</aside>