<div>
    <!-- Form Filter -->
    <div class="row mb-3">
        <!-- Input Pencarian Nama -->
        <div class="col-md-4 col-12 mb-2">
            <label for="search">Cari Nama Karyawan</label>
            <input wire:model="search" type="text" class="form-control" placeholder="Masukkan nama karyawan">
        </div>

        <!-- Dropdown Filter Divisi -->
        <div class="col-md-4 col-12 mb-2">
            <label for="divisi">Pilih Divisi</label>
            <select wire:model="divisi_id" class="form-control">
                <option value="">Semua Divisi</option>
                @foreach($divisi as $d)
                    <option value="{{ $d->id }}">{{ $d->nama_divisi }}</option>
                @endforeach
            </select>
        </div>

        <!-- Tombol Reset Filter -->
        <div class="col-md-4 col-12 d-flex align-items-end">
            <button wire:click="resetFilters" class="btn btn-secondary w-100">Reset Filter</button>
        </div>
    </div>

    <!-- Tabel Karyawan -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Nomor HP</th>
                    <th>Alamat</th>
                    <th>Divisi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($karyawan as $item)
                    <tr>
                        <td>{{ $loop->iteration + ($karyawan->currentPage() - 1) * $karyawan->perPage() }}</td>
                        <td>{{ $item->nik }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->nomor_hp }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->divisi ? $item->divisi->nama_divisi : '-' }}</td>
                        <td>
                            <a href="{{ route('karyawan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('karyawan.destroy', $item->id) }}" method="POST" style="display:inline;">
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

    <!-- Pagination -->
    <div class="d-flex mt-1 justify-content-start">
        <button wire:click="previousPage" class="btn btn-secondary" @if($karyawan->onFirstPage()) disabled @endif>← Prev</button>
        <button wire:click="nextPage" class="btn btn-secondary" @if(!$karyawan->hasMorePages()) disabled @endif>Next →</button>
        <br>
    </div>
    <span class="mx-2"><i>Halaman {{ $karyawan->currentPage() }} dari {{ $karyawan->lastPage() }}</i></span>
    
</div>
