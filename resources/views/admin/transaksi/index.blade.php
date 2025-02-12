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
                    
                    <!-- Tombol untuk menambah transaksi dengan jenis transaksi yang sesuai -->
                    <a href="{{ route('transaksi.create', ['jenis_transaksi' => request()->routeIs('transaksi.masuk') ? 'masuk' : 'keluar']) }}" class="btn btn-primary float-right">Tambah Transaksi</a>


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
                                    <td>{{ $transaksi->perPage() * ($transaksi->currentPage() - 1) + $loop->iteration }}</td>
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
                    <div class="d-flex mt-1 justify-content-start">
                        {{ $transaksi->appends(['jenis_transaksi' => request()->routeIs('transaksi.masuk') ? 'masuk' : 'keluar'])->links('pagination::simple-bootstrap-4') }}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
