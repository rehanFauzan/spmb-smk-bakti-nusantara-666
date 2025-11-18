<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Admin SPMB') - SMK Bakti Nusantara 666</title>
    
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/custom-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/maps.css') }}" rel="stylesheet">
    <style>
        .avatar-sm { width: 40px; height: 40px; }
        .avatar-lg { width: 60px; height: 60px; }
        .badge-lg { font-size: 0.9rem; padding: 0.5rem 1rem; }

        .contact-info small { line-height: 1.4; }
        .status-info .badge { display: inline-block; }
        .berkas-info .badge { display: inline-block; }
        .payment-info { text-align: center; }
        .school-info h6 { font-size: 0.9rem; }
        .candidate-info { border-left: 4px solid #3F72AF; }
        .current-status { background-color: #F9F7F7; }
        .btn-group-vertical .btn { margin-bottom: 2px; }
        .btn-group-vertical .btn:last-child { margin-bottom: 0; }
        .table th { font-weight: 600; font-size: 0.85rem; }
        .table td { vertical-align: middle; }
        .modal-header { background: linear-gradient(45deg, #3F72AF, #112D4E); color: white; }
        .modal-header .close { color: white; opacity: 0.8; }
        .modal-header .close:hover { opacity: 1; }
    </style>
    @stack('styles')
</head>

<body id="page-top">
    <div id="wrapper">
        @include('admin.partials_admin.sidebar')
        
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('admin.partials_admin.navbar')
                
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            
            @include('admin.partials_admin.footer')
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('admin.partials_admin.logout-modal')

    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>