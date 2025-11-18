<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-graduation-cap"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SPMB Admin</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <li class="nav-item {{ request()->routeIs('admin.log-aktivitas.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.log-aktivitas.index') }}">
            <i class="fas fa-fw fa-history"></i>
            <span>Log Aktivitas</span>
        </a>
    </li>

    @php $user = Session::get('admin_user'); @endphp

    @if(in_array($user->role, ['admin', 'kepala']))
    <div class="sidebar-heading">Master Data</div>
    
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseData">
            <i class="fas fa-fw fa-database"></i>
            <span>Data Masteruiop</span>
        </a>
        <div id="collapseData" class="collapse">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="#">Jurusan</a>
                <a class="collapse-item" href="#">Gelombang</a>
                <a class="collapse-item" href="#">Pengguna</a>
            </div>
        </div>
    </li>
    @endif

    @if(in_array($user->role, ['admin', 'verifikator_adm', 'kepala']))
    <div class="sidebar-heading">Pendaftaran</div>
    
    <li class="nav-item {{ request()->routeIs('admin.pendaftar.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.pendaftar.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Pendaftar</span>
        </a>
    </li>
    
    <li class="nav-item {{ request()->routeIs('admin.verifikasi.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.verifikasi.index') }}">
            <i class="fas fa-fw fa-check-circle"></i>
            <span>Verifikasi Berkas</span>
        </a>
    </li>
    
    <li class="nav-item {{ request()->routeIs('admin.wilayah.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.wilayah.index') }}">
            <i class="fas fa-fw fa-map-marked-alt"></i>
            <span>Analisis Wilayah</span>
        </a>
    </li>
    @endif

    @if(in_array($user->role, ['admin', 'keuangan', 'kepala']))
    <div class="sidebar-heading">Keuangan</div>
    
    <li class="nav-item {{ request()->routeIs('admin.keuangan.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.keuangan.pembayaran') }}">
            <i class="fas fa-fw fa-money-bill"></i>
            <span>Pembayaran</span>
        </a>
    </li>
    @endif
    
    @if($user && $user->role == 'admin')
    <div class="sidebar-heading">Sistem</div>
    
    <li class="nav-item {{ request()->routeIs('admin.log-aktivitas.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.log-aktivitas.index') }}">
            <i class="fas fa-fw fa-history"></i>
            <span>Log Aktivitas</span>
        </a>
    </li>
    @endif

    @if(in_array($user->role, ['admin', 'kepala']))
    <div class="sidebar-heading">Laporan</div>
    
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReport">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Laporan</span>
        </a>
        <div id="collapseReport" class="collapse">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="#">Laporan Pendaftar</a>
                <a class="collapse-item" href="#">Laporan Keuangan</a>
            </div>
        </div>
    </li>
    @endif

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>