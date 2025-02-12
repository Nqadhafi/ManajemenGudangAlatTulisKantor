@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Transaksi {{ ucfirst($jenis_transaksi) }}</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="jenis_transaksi" value="{{ $jenis_transaksi }}">

                        <div class="form-group">
                            <label for="produk_id">Produk</label>
                            <select class="form-control" id="produk_id" name="produk_id" required>
                                @foreach($produk as $item)
                                    <option value="{{ $item->id }}" @if($transaksi->produk_id == $item->id) selected @endif>{{ $item->nama_produk }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ $transaksi->jumlah }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="tanggal_transaksi">Tanggal Transaksi</label>
                            <input type="date" class="form-control" id="tanggal_transaksi" name="tanggal_transaksi" value="{{ $transaksi->tanggal_transaksi }}" required>
                        </div>
                        
                        <button type="submit" class="btn btn-warning">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
