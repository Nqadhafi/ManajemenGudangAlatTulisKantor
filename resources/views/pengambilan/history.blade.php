<!-- resources/views/pengambilan/history.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    @livewireStyles
</head>
<body>
    <div class="container mt-5">
        <h2>History Transaksi</h2>

        @if ($transaksi->isEmpty())
            <div class="alert alert-info">Anda belum melakukan transaksi apapun.</div>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tanggal Transaksi</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi as $item)
                        <tr>
                            <td>{{ ucfirst(strftime('%e %B %Y', strtotime($item->tanggal_transaksi))) }}</td>
                            <td>{{ $item->produk->nama_produk }}</td>
                            <td>{{ $item->jumlah }} {{ $item->produk->satuan }}</td>
                            <td>{{ $item->keterangan ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <a href="{{ route('pengambilan.index') }}" class="btn btn-primary mt-3">Kembali ke Transaksi</a>
    </div>

    @livewireScripts
</body>
</html>
