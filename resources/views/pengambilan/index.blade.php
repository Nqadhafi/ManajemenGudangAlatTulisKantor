<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    @livewireStyles
</head>
<body>
    <div class="container mt-5">
        <h2>Transaksi Produk</h2>

        <!-- Tampilkan nama dan NIK karyawan yang sedang login -->
        <div class="mb-3">
            <strong>Nama Karyawan:</strong> {{ $karyawan->nama }} <br>
            <strong>NIK:</strong> {{ $karyawan->nik }}
        </div>

        <!-- Tampilkan pesan sukses -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
 <!-- Tampilkan pesan error -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <!-- Form transaksi -->
        <form method="POST" action="{{ route('pengambilan.store') }}">
            @csrf

            <!-- Pencarian Produk dengan Livewire -->
            @livewire('produk-search')

            <!-- Jumlah untuk setiap produk yang dipilih -->
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="text" class="form-control" name="jumlah[]" required>
            </div>
            <button type="submit" class="btn btn-primary">Lakukan Transaksi</button>
        </form>

        <!-- Tombol Logout -->
        <form method="POST" action="{{ route('user.logout') }}" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>

    @livewireScripts
</body>
</html>
