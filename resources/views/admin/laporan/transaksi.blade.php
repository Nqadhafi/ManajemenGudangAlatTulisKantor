@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Laporan Transaksi</h3>

                    <!-- Filter Form -->
                    <form method="GET" action="{{ route('laporan.transaksi') }}" class="form-inline float-right">
                        <select name="produk_id" class="form-control">
                            <option value="">-- Pilih Produk --</option>
                            @foreach($produk as $prod)
                                <option value="{{ $prod->id }}" {{ request('produk_id') == $prod->id ? 'selected' : '' }}>{{ $prod->nama_produk }}</option>
                            @endforeach
                        </select>

                        <select name="jenis_transaksi" class="form-control ml-2">
                            <option value="">-- Pilih Jenis Transaksi --</option>
                            <option value="masuk" {{ request('jenis_transaksi') == 'masuk' ? 'selected' : '' }}>Masuk</option>
                            <option value="keluar" {{ request('jenis_transaksi') == 'keluar' ? 'selected' : '' }}>Keluar</option>
                        </select>

                        <input type="date" name="tanggal_mulai" class="form-control ml-2" value="{{ request('tanggal_mulai') }}">
                        <input type="date" name="tanggal_akhir" class="form-control ml-2" value="{{ request('tanggal_akhir') }}">

                        <button type="submit" class="btn btn-primary ml-2">Filter</button>
                    </form>
                </div>
                
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Produk</th>
                                <th>Jenis Transaksi</th>
                                <th>Jumlah</th>
                                <th>Tanggal Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksi as $trans)
                            <tr>
                                <td>{{ $trans->id }}</td>
                                <td>{{ $trans->produk->nama_produk }}</td>
                                <td>{{ ucfirst($trans->jenis_transaksi) }}</td>
                                <td>{{ $trans->jumlah }}</td>
                                <td>{{ $trans->tanggal_transaksi }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $transaksi->links() }} <!-- Pagination -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
