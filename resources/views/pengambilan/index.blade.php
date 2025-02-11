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
  <!-- Link menuju history transaksi -->
  <a href="{{ route('pengambilan.history') }}" class="btn btn-info mt-3">Lihat History Transaksi</a>

        <!-- Tampilkan pesan error -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form transaksi -->
        <form method="POST" action="{{ route('pengambilan.store') }}" id="transaksiForm">
            @csrf

            <!-- Pencarian Produk dengan Livewire -->
            @livewire('produk-search')

            <!-- Jumlah untuk setiap produk yang dipilih -->
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="text" class="form-control" name="jumlah[]" required>
            </div>

            <!-- Keterangan -->
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <input type="text" class="form-control" name="keterangan[]" placeholder="Masukkan keterangan" required>
            </div>

            <button type="submit" class="btn btn-primary">Lakukan Transaksi</button>
        </form>

        <!-- Tombol Logout -->
        <form method="POST" action="{{ route('user.logout') }}" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>

    <!-- Modal Konfirmasi Transaksi -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin melanjutkan transaksi ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="confirmSubmitBtn">Konfirmasi</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Pesan Berhasil -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Transaksi Berhasil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Produk yang ditransaksikan:</h5>
                    <ul id="transaksiDetail"></ul>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('pengambilan.index') }}" class="btn btn-primary">Transaksi Lagi</a>
                    <form method="POST" action="{{ route('user.logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    @livewireScripts

    <!-- Konfirmasi Transaksi -->
    <script>
        // Tampilkan modal konfirmasi saat form dikirim
        document.querySelector('form').addEventListener('submit', function (e) {
            e.preventDefault(); // Mencegah form dikirimkan langsung
    
            // Tampilkan modal konfirmasi
            var myModal = new bootstrap.Modal(document.getElementById('confirmModal'));
            myModal.show();
    
            document.getElementById('confirmSubmitBtn').onclick = function() {
                // Kirimkan form setelah konfirmasi
                document.getElementById('transaksiForm').submit();
            };
        });
    
        // Tampilkan modal sukses jika ada session 'success'
        @if(session('success'))
            const transaksiDetail = @json(session('transaksiDetail'));
            let transaksiList = '';
            transaksiDetail.forEach(item => {
                transaksiList += `<li>${item.nama} - ${item.jumlah} pcs - Keterangan: ${item.keterangan}</li>`;
            });
            document.getElementById('transaksiDetail').innerHTML = transaksiList;
            var myModal = new bootstrap.Modal(document.getElementById('successModal'));
            myModal.show();
        @endif
    </script>
    

</body>
</html>
