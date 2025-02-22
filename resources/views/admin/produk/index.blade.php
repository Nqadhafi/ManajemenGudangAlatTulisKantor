@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Master Produk</h3>
                    <a href="{{ route('produk.create') }}" class="btn btn-primary float-right">Tambah Produk</a>
                </div>
                <div class="card-body">
                    @livewire('produk-search') <!-- Panggil Livewire Component -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
