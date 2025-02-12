@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Transaksi {{ ucfirst($jenis_transaksi) }}</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('transaksi.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="jenis_transaksi" value="{{ $jenis_transaksi }}">

                        <div class="form-group">
                            <label for="produk_id">Produk</label>
                            <select name="produk_id" id="produk_id" class="form-control">
                                @foreach ($produk as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nama_produk }} [Stok: {{ $item->stok }} {{ $item->satuan }}]
                                    </option>
                                @endforeach
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
