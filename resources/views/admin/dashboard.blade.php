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
</div>
@endsection
