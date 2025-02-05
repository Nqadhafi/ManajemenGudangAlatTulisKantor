@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="m-0 text-dark">Edit Perusahaan</h1>
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Edit Data Perusahaan</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('perusahaan.update', $perusahaan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nama">Nama Perusahaan</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama', $perusahaan->nama) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="logo">Logo Perusahaan</label>
                        <input type="file" class="form-control-file" name="logo" id="logo">
                        @if ($perusahaan->logo)
                            <br>
                            <img src="{{ asset('storage/' . $perusahaan->logo) }}" alt="Logo" width="100">
                        @else
                            <span>Logo Tidak Tersedia</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat" value="{{ old('alamat', $perusahaan->alamat) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="nomor_telepon">Nomor Telepon</label>
                        <input type="text" class="form-control" name="nomor_telepon" id="nomor_telepon" value="{{ old('nomor_telepon', $perusahaan->nomor_telepon) }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('perusahaan.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
