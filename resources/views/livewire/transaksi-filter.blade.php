<div>
    <!-- Form Filter -->
    <div class="row mb-3">
        <!-- Pencarian Transaksi -->
        <div class="col-md-3 col-12 mb-2">
            <label for="search">Cari Nama Produk</label>
            <input wire:model="search" type="text" class="form-control" placeholder="Cari berdasarkan produk atau keterangan">
        </div>

        <!-- Filter Tanggal Awal -->
        <div class="col-md-3 col-12 mb-2">
            <label for="tanggal_awal">Tanggal Awal</label>
            <input wire:model="tanggal_awal" type="date" class="form-control">
        </div>

        <!-- Filter Tanggal Akhir -->
        <div class="col-md-3 col-12 mb-2">
            <label for="tanggal_akhir">Tanggal Akhir</label>
            <input wire:model="tanggal_akhir" type="date" class="form-control">
        </div>

        <!-- Tombol Clear Filter -->
        <div class="col-md-3 col-12 d-flex align-items-end">
            <button wire:click="resetFilters" class="btn btn-secondary w-100">Clear Filter</button>
        </div>
    </div>

    <!-- Tabel Transaksi -->
    <div class="table-responsive"> <!-- Tambahkan div ini agar tabel bisa di-scroll di layar kecil -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Pengambil</th>
                    <th>Produk</th>
                    <th>Jenis Transaksi</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $item)
                    <tr>
                        <td>{{ $loop->iteration + ($transaksi->currentPage() - 1) * $transaksi->perPage() }}</td>
                        <td>{{ $item->karyawan ? $item->karyawan->nama : 'Admin' }}</td>
                        <td>{{ $item->produk->nama_produk }}</td>
                        <td>{{ ucfirst($item->jenis_transaksi) }}</td>
                        <td>{{ $item->jumlah }} {{ $item->produk->satuan }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td>{{ $item->tanggal_transaksi }}</td>
                        <td>
                            <!-- Tombol Edit -->
                            <a href="{{ route('transaksi.edit', ['jenis_transaksi' => $item->jenis_transaksi, 'transaksi' => $item->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                            
                            <!-- Form untuk menghapus transaksi -->
                            <form action="{{ route('transaksi.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex mt-1 justify-content-start">
        <button wire:click="previousPage" class="btn btn-secondary" @if($transaksi->onFirstPage()) disabled @endif>← Prev</button>
        <button wire:click="nextPage" class="btn btn-secondary" @if(!$transaksi->hasMorePages()) disabled @endif>Next →</button>
        <br>
    </div>
    <span class="mx-2"><i>Halaman {{ $transaksi->currentPage() }} dari {{ $transaksi->lastPage() }}</i></span>
</div>
