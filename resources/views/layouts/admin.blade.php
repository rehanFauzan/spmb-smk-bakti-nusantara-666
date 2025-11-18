<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') - SPMB SMK BAKTI NUSANTARA 666</title>
    
    <!-- Favicon -->
    <link href="{{ asset('assets/img/baknus/bn2.png') }}" rel="icon">
    <link href="{{ asset('assets/img/baknus/bn2.png') }}" rel="apple-touch-icon">
    
    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    
    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    
    <!-- Custom styles for this page -->
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard-charts.css') }}" rel="stylesheet">
    
    <style>
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 123, 255, 0.05) !important;
        }
        .table-striped tbody tr:nth-of-type(even) {
            background-color: #ffffff !important;
        }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SPMB SMK BN 666</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            @if(request()->is('admin*'))
                <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard Admin</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">Data Master</div>

                <li class="nav-item {{ request()->is('admin/jurusan*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.jurusan') }}">
                        <i class="fas fa-fw fa-graduation-cap"></i>
                        <span>Kelola Jurusan</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('admin/gelombang*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.gelombang') }}">
                        <i class="fas fa-fw fa-calendar"></i>
                        <span>Kelola Gelombang</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('admin/wilayah-analisis*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.wilayah.index') }}">
                        <i class="fas fa-fw fa-map-marked-alt"></i>
                        <span>Analisis Wilayah</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('admin/users*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.users') }}">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Kelola User</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">Monitoring</div>

                <li class="nav-item {{ request()->is('admin/calon-siswa*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.calon-siswa') }}">
                        <i class="fas fa-fw fa-user-graduate"></i>
                        <span>Calon Siswa</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('admin/monitoring-pembayaran*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.monitoring-pembayaran') }}">
                        <i class="fas fa-fw fa-money-bill"></i>
                        <span>Monitoring Pembayaran</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#laporanModal">
                        <i class="fas fa-fw fa-file-export"></i>
                        <span>Cetak Laporan</span>
                    </a>
                </li>
                
                <li class="nav-item {{ request()->is('admin/log-aktivitas*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.log-aktivitas.index') }}">
                        <i class="fas fa-fw fa-history"></i>
                        <span>Log Aktivitas</span>
                    </a>
                </li>
            @endif

            @if(request()->is('panitia*'))
                <li class="nav-item {{ request()->is('panitia/dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('panitia.dashboard') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard Panitia</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <li class="nav-item {{ request()->is('panitia/pendaftaran*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('panitia.pendaftaran') }}">
                        <i class="fas fa-fw fa-list"></i>
                        <span>Semua Pendaftaran</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('panitia/verifikasi-berkas*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('panitia.verifikasi-berkas') }}">
                        <i class="fas fa-fw fa-file-check"></i>
                        <span>Verifikasi Berkas</span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="laporanDropdown" role="button" data-toggle="dropdown">
                        <i class="fas fa-fw fa-file-export"></i>
                        <span>Cetak Laporan</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="laporanDropdown">
                        <a class="dropdown-item" href="{{ route('laporan.panitia.pdf') }}">
                            <i class="fas fa-file-pdf text-danger"></i> Export PDF
                        </a>
                        <a class="dropdown-item" href="{{ route('laporan.panitia.excel') }}">
                            <i class="fas fa-file-excel text-success"></i> Export Excel
                        </a>
                    </div>
                </li>
            @endif

            @if(request()->is('keuangan*'))
                <li class="nav-item {{ request()->is('keuangan/dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('keuangan.dashboard') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard Keuangan</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <li class="nav-item {{ request()->is('keuangan/verifikasi-pembayaran*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('keuangan.verifikasi-pembayaran') }}">
                        <i class="fas fa-fw fa-check-circle"></i>
                        <span>Verifikasi Pembayaran</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('keuangan/rekap-pembayaran*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('keuangan.rekap-pembayaran') }}">
                        <i class="fas fa-fw fa-chart-bar"></i>
                        <span>Rekap Pembayaran</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('keuangan/daftar-pembayaran*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('keuangan.daftar-pembayaran') }}">
                        <i class="fas fa-fw fa-list"></i>
                        <span>Daftar Pembayaran</span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="laporanDropdown" role="button" data-toggle="dropdown">
                        <i class="fas fa-fw fa-file-export"></i>
                        <span>Cetak Laporan</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="laporanDropdown">
                        <a class="dropdown-item" href="{{ route('laporan.keuangan.pdf') }}">
                            <i class="fas fa-file-pdf text-danger"></i> Export PDF
                        </a>
                        <a class="dropdown-item" href="{{ route('laporan.keuangan.excel') }}">
                            <i class="fas fa-file-excel text-success"></i> Export Excel
                        </a>
                    </div>
                </li>
            @endif

            @if(request()->is('kepala-sekolah*'))
                <li class="nav-item {{ request()->is('kepala-sekolah/dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('kepala-sekolah.dashboard') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard Kepala Sekolah</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <li class="nav-item {{ request()->is('kepala-sekolah/calon-siswa*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('kepala-sekolah.calon-siswa') }}">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Daftar Calon Siswa</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('kepala-sekolah/siswa-diterima*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('kepala-sekolah.siswa-diterima') }}">
                        <i class="fas fa-fw fa-user-check"></i>
                        <span>Siswa Diterima</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('kepala-sekolah/rekap-pembayaran*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('kepala-sekolah.rekap-pembayaran') }}">
                        <i class="fas fa-fw fa-chart-bar"></i>
                        <span>Rekap Pembayaran</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('kepala-sekolah/asal-sekolah*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('kepala-sekolah.asal-sekolah') }}">
                        <i class="fas fa-fw fa-school"></i>
                        <span>Data Asal Sekolah</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('kepala-sekolah/asal-wilayah*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('kepala-sekolah.asal-wilayah') }}">
                        <i class="fas fa-fw fa-map-marker-alt"></i>
                        <span>Asal Wilayah</span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="laporanDropdown" role="button" data-toggle="dropdown">
                        <i class="fas fa-fw fa-file-export"></i>
                        <span>Cetak Laporan</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="laporanDropdown">
                        <a class="dropdown-item" href="{{ route('laporan.kepala-sekolah.pdf') }}">
                            <i class="fas fa-file-pdf text-danger"></i> Export PDF
                        </a>
                        <a class="dropdown-item" href="{{ route('laporan.kepala-sekolah.excel') }}">
                            <i class="fas fa-file-excel text-success"></i> Export Excel
                        </a>
                    </div>
                </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin User</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('admin/img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('admin.logout') }}">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                @yield('content')
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; SMK BAKTI NUSANTARA 666 {{ date('Y') }}</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Laporan Modal-->
    <div class="modal fade" id="laporanModal" tabindex="-1" role="dialog" aria-labelledby="laporanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="laporanModalLabel">Cetak Laporan Pendaftar</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('laporan.export') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jurusan</label>
                                    <select name="jurusan" class="form-control">
                                        <option value="">Semua Jurusan</option>
                                        @foreach(\App\Models\Jurusan::all() as $jurusan)
                                        <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Gelombang</label>
                                    <select name="gelombang" class="form-control">
                                        <option value="">Semua Gelombang</option>
                                        @foreach(\App\Models\Gelombang::all() as $gelombang)
                                        <option value="{{ $gelombang->id }}">{{ $gelombang->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="">Semua Status</option>
                                        <option value="SUBMIT">Baru Submit</option>
                                        <option value="ADM_PASS">Berkas Diterima</option>
                                        <option value="PAID">Sudah Bayar</option>
                                        <option value="ADM_REJECT">Ditolak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Format</label>
                                    <select name="format" class="form-control" required>
                                        <option value="excel">Excel (.csv)</option>
                                        <option value="pdf">PDF</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Periode Dari</label>
                                    <input type="date" name="periode_dari" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Periode Sampai</label>
                                    <input type="date" name="periode_sampai" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-download"></i> Export Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('admin.logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>

    @stack('scripts')
</body>
</html>