@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Laporan Stok Produk</h3>

                    <!-- Filter Form -->
                    <form method="GET" action="{{ route('laporan.stok') }}" class="form-inline float-right">
                        <select name="kategori_id" class="form-control">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategori as $kat)
                                <option value="{{ $kat->id }}" {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>{{ $kat->nama_kategori }}</option>
                            @endforeach
                        </select>

                        <select name="produk_id" class="form-control ml-2">
                            <option value="">-- Pilih Produk --</option>
                            @foreach($produk as $prod)
                                <option value="{{ $prod->id }}" {{ request('produk_id') == $prod->id ? 'selected' : '' }}>{{ $prod->nama_produk }}</option>
                            @endforeach
                        </select>

                        <button type="submit" class="btn btn-primary ml-2">Filter</button>
                    </form>
                </div>
                
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produk as $prod)
                            <tr>
                                <td>{{ $prod->id }}</td>
                                <td>{{ $prod->nama_produk }}</td>
                                <td>{{ $prod->kategori->nama_kategori }}</td>
                                <td>{{ $prod->stok }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $produk->links() }} <!-- Pagination -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
