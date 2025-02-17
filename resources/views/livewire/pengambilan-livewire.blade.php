<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5>Form Pengambilan Stok</h5>
        </div>
        <div class="card-body">
            @if(session()->has('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="mb-3">
                <label for="produk" class="form-label">Pilih Produk</label>
                <select class="form-control" wire:model="produk_id">
                    <option value="">-- Pilih Produk --</option>
                    @foreach($produkList as $produk)
                        <option value="{{ $produk->id }}">
                            {{ $produk->nama_produk }} (Stok: {{ $produk->stok }})
                        </option>
                    @endforeach
                </select>
            </div>

            @if($stok)
                <p><strong>Stok tersedia:</strong> {{ $stok }} {{ $produk->satuan }}</p>
            @endif

            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" class="form-control" wire:model="jumlah" min="1" required>
            </div>

            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control" wire:model="keterangan" required></textarea>
            </div>

            <button class="btn btn-success" wire:click="confirmTransaksi">Ambil Stok</button>
        </div>
    </div>

    <!-- Modal Konfirmasi -->
    <div class="modal fade" id="modalKonfirmasi" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Produk:</strong> {{ $selectedProduk->nama_produk ?? '' }}</p>
                    <p><strong>Jumlah:</strong> {{ $jumlah }}</p>
                    <p><strong>Keterangan:</strong> {{ $keterangan }}</p>
                    <p>Apakah Anda yakin ingin mengambil stok ini?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" wire:click="transaksiSukses">Konfirmasi</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Sukses -->
    <div class="modal fade" id="modalSukses" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Transaksi Berhasil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Produk:</strong> {{ $transaksiDetail['nama'] ?? '' }}</p>
                    <p><strong>Jumlah:</strong> {{ $transaksiDetail['jumlah'] ?? '' }}</p>
                    <p><strong>Keterangan:</strong> {{ $transaksiDetail['keterangan'] ?? '' }}</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button class="btn btn-primary" onclick="window.location.reload();">Ambil Lagi</button>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan Script JavaScript untuk Bootstrap Modal -->
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('showModalKonfirmasi', () => {
            let modal = new bootstrap.Modal(document.getElementById('modalKonfirmasi'));
            modal.show();
        });

        Livewire.on('showModalSukses', () => {
            let modal = new bootstrap.Modal(document.getElementById('modalSukses'));
            modal.show();
        });

        Livewire.on('hideModals', () => {
            let modalKonfirmasi = bootstrap.Modal.getInstance(document.getElementById('modalKonfirmasi'));
            let modalSukses = bootstrap.Modal.getInstance(document.getElementById('modalSukses'));

            if (modalKonfirmasi) modalKonfirmasi.hide();
            if (modalSukses) modalSukses.hide();
        });
    });
</script>
