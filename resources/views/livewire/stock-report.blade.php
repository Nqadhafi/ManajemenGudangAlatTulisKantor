<div>
    <div class="mb-3">
        <label for="search" class="form-label">Cari Produk</label>
        <input type="text" class="form-control" placeholder="Cari Produk" wire:model="search">
    </div>

    <div class="mb-3">
        <label for="category_id" class="form-label">Kategori</label>
        <select class="form-control" wire:model="category_id">
            <option value="">Pilih Kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <button class="btn btn-primary" wire:click="downloadPdf">Unduh PDF</button>
    </div>

    <!-- Tabel untuk menampilkan produk -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product->nama_produk }}</td>
                    <td>{{ $product->kategori->nama_kategori }}</td>
                    <td>{{ $product->stok }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
