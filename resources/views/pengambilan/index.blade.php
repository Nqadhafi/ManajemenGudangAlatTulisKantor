<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengambilan Stok</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    @livewireStyles
</head>
<body>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h3>Pengambilan Stok</h3>

        <div>
            <a href="{{ route('pengambilan.history') }}" class="btn btn-info">Lihat History</a>
            <a href="{{ route('pengambilan.logout') }}" class="btn btn-danger">Logout</a>
        </div>
    </div>
    <div class="mx-auto my-2 alert alert-info">
        <strong>Nama Karyawan:</strong> {{ $karyawan->nama }} <br>
        <strong>NIK:</strong> {{ $karyawan->nik }}
    </div>
    <hr>

    <div class="row justify-content-center">
        <div class="col-md-8">
            @livewire('pengambilan-livewire', ['produkList' => $produkList])
        </div>
    </div>
</div>

@livewireScripts
<script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
