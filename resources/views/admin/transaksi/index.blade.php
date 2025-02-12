@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Transaksi 
                        @if(request()->routeIs('transaksi.masuk')) 
                            Masuk 
                        @elseif(request()->routeIs('transaksi.keluar')) 
                            Keluar 
                        @endif
                    </h3>

                    <!-- Form Filter -->
                    <form method="GET" action="{{ request()->url() }}" class="form-inline float-right">
                        <div class="form-group">
                            <select name="produk_id" class="form-control mr-2">
                                <option value="">Semua Produk</option>
                                @foreach($produk as $item)
                                    <option value="{{ $item->id }}" @if(request('produk_id') == $item->id) selected @endif>{{ $item->nama_produk }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="date" name="tanggal" class="form-control mr-2" value="{{ request('tanggal') }}">
                        </div>
                        <button type="submit" class="btn btn-secondary">Filter</button>
                    </form>

                    <!-- Tombol untuk menambah transaksi dengan jenis transaksi yang sesuai -->
                    <a href="{{ route('transaksi.create', ['jenis_transaksi' => request()->routeIs('transaksi.masuk') ? 'masuk' : 'keluar']) }}" class="btn btn-primary float-right ml-2">Tambah Transaksi</a>
                </div>
                <div class="card-body">
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
                                    <td>
                                        @if ($item->karyawan)
                                            {{ $item->karyawan->nama }}
                                        @else
                                            Admin
                                        @endif
                                    </td>
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
            </div>
        </div>
    </div>
</div>
@endsection
