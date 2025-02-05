@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="m-0 text-dark">Daftar Perusahaan</h1>
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">List Perusahaan</h3>
                <div class="card-tools">
                    <!-- Cek jika data perusahaan sudah ada -->
                    @if($perusahaans->isEmpty())
                        <a href="{{ route('perusahaan.create') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i> Tambah Perusahaan
                        </a>
                    @endif
                </div>
            </div>
            <div class="card-body">
                @if ($perusahaans->isNotEmpty())
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Logo</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($perusahaans as $perusahaan)
                                <tr>
                                    <td>{{ $perusahaan->nama }}</td>
                                    <td>
                                        @if ($perusahaan->logo)
                                            <img src="{{ asset('storage/' . $perusahaan->logo) }}" alt="Logo" width="50">
                                        @else
                                            <span>Logo Tidak Tersedia</span>
                                        @endif
                                    </td>
                                    <td>{{ $perusahaan->alamat }}</td>
                                    <td>{{ $perusahaan->nomor_telepon }}</td>
                                    <td>
                                        <a href="{{ route('perusahaan.edit', $perusahaan->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('perusahaan.destroy', $perusahaan->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Tidak ada data perusahaan. Silakan tambah perusahaan terlebih dahulu.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
