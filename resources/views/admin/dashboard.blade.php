@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Jumlah Produk</h3>
                </div>
                <div class="card-body">
                    <h4>{{ $produkCount }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Jumlah Transaksi</h3>
                </div>
                <div class="card-body">
                    <h4>{{ $transaksiCount }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Jumlah Karyawan</h3>
                </div>
                <div class="card-body">
                    <h4>{{ $karyawanCount }}</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Peringatan Stok Menipis -->
    @if($produkRendahCount > 0)
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{ $produkRendahCount }}</h3>
            <p>Jumlah produk dengan stok rendah</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <button type="button" class="btn small-box-footer w-100" data-toggle="modal" data-target="#produkStokModal">
            Lihat Produk
            <i class="fas fa-arrow-circle-right"></i>
        </button>
        </div>
      </div>
    @endif
</div>

<!-- Modal untuk menampilkan produk dengan stok rendah -->
<div class="modal fade" id="produkStokModal" tabindex="-1" role="dialog" aria-labelledby="produkStokModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="produkStokModalLabel">Produk dengan Stok Menipis</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul>
                    @foreach ($produkRendah as $produk)
                        <li>{{ $produk->nama_produk }} - Stok: {{ $produk->stok }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer">
                <a href="{{ route('transaksi.create', ['jenis_transaksi' => 'masuk']) }}" class="btn btn-success">Tambah Transaksi Masuk</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endsection
