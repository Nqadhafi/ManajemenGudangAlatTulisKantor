<div>
    <!-- Input Search -->
    <div class="mb-3">
        <input wire:model="search" type="text" class="form-control" placeholder="Cari Produk / Kategori">
    </div>

    <!-- Tabel Produk -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Level Stok</th>
                <th>Satuan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produk as $item)
                <tr>
                    <td>{{ $loop->iteration + ($produk->currentPage() - 1) * $produk->perPage() }}</td>
                    <td>{{ $item->nama_produk }}</td>
                    <td>{{ $item->kategori->nama_kategori }}</td>
                    <td>{{ $item->stok_minimum }}</td>
                    <td>{{ $item->satuan }}</td>
                    <td>
                        <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('produk.destroy', $item->id) }}" method="POST" style="display:inline;">
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
        <button wire:click="previousPage" class="btn btn-secondary" @if($produk->onFirstPage()) disabled @endif>← Prev</button>
        <button wire:click="nextPage" class="btn btn-secondary" @if(!$produk->hasMorePages()) disabled @endif>Next →</button>
        <br>
    </div>
    <span class="mx-2"><i>Halaman {{ $produk->currentPage() }} dari {{ $produk->lastPage() }}</i></span>
</div>
