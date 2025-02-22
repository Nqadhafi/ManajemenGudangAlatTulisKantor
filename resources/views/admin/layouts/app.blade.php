<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen ATK - Shabat Printing</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    @livewireStyles
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
 <!-- Sidebar -->
 @include('admin.layouts.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

            <div class="container d-flex pt-5">
            @yield('content')
        </div>
        </div>
        <!-- Footer -->
        <footer class="main-footer">
            <strong>&copy; 2025 <a href="#">  {{ $perusahaan ? $perusahaan->nama : 'Your Company' }}</a>- {{ $perusahaan ? $perusahaan->alamat : '' }}.</strong>  All rights reserved.
        </footer>
    </div>

    <!-- AdminLTE JS -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
    @livewireScripts
</body>
</html>
