@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Karyawan</h3>
                    <a href="{{ route('karyawan.create') }}" class="btn btn-primary float-right">Tambah Karyawan</a>
                </div>
                <div class="card-body">
                    @livewire('karyawan-filter') <!-- Panggil Livewire Component -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
