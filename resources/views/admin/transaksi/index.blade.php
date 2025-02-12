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

                    <!-- Tombol untuk menambah transaksi -->
                    <a href="{{ route('transaksi.create', ['jenis_transaksi' => request()->routeIs('transaksi.masuk') ? 'masuk' : 'keluar']) }}" class="btn btn-primary float-right">Tambah Transaksi</a>
                </div>
                <div class="card-body">
                    @livewire('transaksi-filter')  <!-- Menggunakan komponen Livewire -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
