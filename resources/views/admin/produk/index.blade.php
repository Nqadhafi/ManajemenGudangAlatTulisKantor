@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">

                    <h3 class="card-title">Daftar Master Produk</h3>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <a href="{{ route('produk.create') }}" class="btn btn-primary float-right">Tambah Produk</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Level Stok</th>
                                <th>Satuan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produk as $item)
                                <tr>
                                    <td>{{ $loop->iteration + ($produk->currentPage() - 1) * $produk->perPage() }}</td>
                                    <td>{{ $item->nama_produk }}</td>
                                    <td>{{ $item->kategori->nama_kategori }}</td>
                                    <td>{{ $item->stok_minimum }}</td>
                                    <td>{{ $item->satuan }}</td>
                                    <td>
                                        <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('produk.destroy', $item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                        <!-- Pagination -->
    <div class="d-flex mt-1 justify-content-start">
        {{ $produk->links('pagination::simple-bootstrap-4') }}
    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
