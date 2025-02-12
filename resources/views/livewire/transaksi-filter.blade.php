<div>
    <!-- Form Filter -->
    <div class="d-flex mb-3">
        <div class="form-group mr-3">
            <select wire:model="produkId" class="form-control">
                <option value="">Semua Produk</option>
                @foreach($produk as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_produk }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group mr-3">
            <input wire:model="tanggal" type="date" class="form-control">
        </div>

        <button wire:click="$refresh" class="btn btn-secondary">Clear Filter</button>
    </div>

    <!-- Tabel Transaksi -->
    <table class="table table-bordered">
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

    <!-- Pagination -->
    <div class="d-flex mt-1 justify-content-start">
        {{ $transaksi->links('pagination::simple-bootstrap-4') }}
    </div>
</div>
