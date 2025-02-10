<div> <!-- Root element -->
    <!-- Input Pencarian Produk -->
    <div class="mb-3">
        <label for="produk" class="form-label">Cari Produk</label>
        <input type="text" class="form-control" placeholder="Cari produk..." wire:model="search">
    </div>

    <!-- Dropdown Pilihan Produk -->
    <div class="mb-3">
        <label for="produk_id" class="form-label">Pilih Produk</label>
        <select class="form-select" name="produk_id[]" wire:model="produk_id" multiple required>
            <!-- Tampilkan produk yang sesuai dengan pencarian -->
            @foreach ($produk as $item)
                <option value="{{ $item->id }}">
                    {{ $item->nama_produk }} (Stok: {{ $item->stok }})
                </option>
            @endforeach
        </select>
    </div>
</div> <!-- Akhir root element -->
