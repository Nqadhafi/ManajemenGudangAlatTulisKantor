@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Transaksi Masuk</h3>
                    <form method="GET">
                        <select name="jenis" onchange="this.form.submit()">
                            <option value="">Semua Transaksi</option>
                            <option value="masuk">Masuk</option>
                            <option value="keluar">Keluar</option>
                        </select>
                    </form>
                    
                    <!-- Button tambah transaksi masuk (untuk admin) -->
                    <a href="{{ route('transaksi.create') }}" class="btn btn-primary float-right">Tambah Transaksi Masuk</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Produk</th>
                                <th>Jenis Transaksi</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->produk->nama_produk }}</td>
                                    <td>{{ ucfirst($item->jenis_transaksi) }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>{{ $item->produk->satuan }}</td>
                                    <td>{{ $item->tanggal_transaksi }}</td>
                                    <td>
                                        <a href="{{ route('transaksi.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
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
            </div>
        </div>
    </div>
</div>
@endsection
