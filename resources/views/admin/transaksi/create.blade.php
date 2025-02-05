@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Transaksi</h3>
                </div>
                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                <div class="card-body">
                    <form action="{{ route('transaksi.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="produk_id">Produk</label>
                            <select name="produk_id" id="produk_id" class="form-control">
                                @foreach ($produk as $produk)
                                    <option value="{{ $produk->id }}">
                                        {{ $produk->nama_produk }} (Stok: {{ $produk->stok }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="jenis_transaksi">Jenis Transaksi</label>
                            <select class="form-control" id="jenis_transaksi" name="jenis_transaksi" required>
                                <option value="masuk">Masuk</option>
                                <option value="keluar">Keluar</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_transaksi">Tanggal Transaksi</label>
                            <input type="date" class="form-control" id="tanggal_transaksi" name="tanggal_transaksi" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
