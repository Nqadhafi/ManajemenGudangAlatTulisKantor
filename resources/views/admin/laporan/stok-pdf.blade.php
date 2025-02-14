<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Stok Gudang ATK & Bahan - {{ $company->nama }}</title>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Laporan Stok Gudang ATK & Bahan - {{ $company->nama }}</title>
        <style>
body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center; /* Memastikan semua konten rata tengah */
        }

        .header {
            margin-bottom: 20px;
        }

        .company-info {
            width: 100%;
            font-size: 14px;
            /* line-height: 1.2; */
            font-weight: bold; /* Membuat teks menjadi tebal */
        }

        .company-info td {
            padding: 0;
            margin: 0;
        }

        .logo {
            width: 5rem;
            margin-left : 40px;
            height: auto;
            text-align: center;
        }

        .divider {
            height: 2px;
            background-color: #000;
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            text-align: center; /* Mengatur agar teks di dalam tabel juga rata tengah */
        }

        th, td {
            padding: 10px;
            text-align: left; /* Semua teks di tabel rata tengah */
            border: 1px solid #ddd;
        }
        .company-info th,  .company-info td {
            padding: 0px 0px 0px 0px;
            margin : 0px 0px 0px 0px;
            text-align: left; /* Semua teks di tabel rata tengah */
            /* border: none; */
        }

        th {
            background-color: #FFEB3B; /* Warna kuning untuk header tabel */
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .company-info tr:nth-child(even) {
            background-color: #ffffff;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        @media print {
            body {
                font-size: 12px;
            }

            .header, .divider {
                display: none;
            }

            table {
                border: 1px solid #000;
            }

            th, td {
                border: 1px solid #000;
                padding: 5px;
            }
        }
        </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <table class="company-info">
            <tr colspan="4">
                <td rowspan="4" colspan="4"><img src="{{ asset('storage/' . $company->logo) }}" alt="Logo" class="logo"></td>
                <td>Laporan Stok Gudang ATK & Bahan</td>
            </tr>
            <tr>
                <td>{{ $company->nama }}</td>
            </tr>
            <tr>
                <td>{{ $company->alamat }}</td>
            </tr>
            <tr>
                <td>Telepon: {{ $company->nomor_telepon }}</td>
            </tr>
        </table>
    </div>

    <!-- Divider -->
    <div class="divider"></div>
    <p style="font-size: 12px;">Tanggal dan Jam Laporan: {{ $currentDateTime }}</p>
    <!-- Tabel Stok -->
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Stok Tersedia</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product->nama_produk }}</td>
                    <td>{{ $product->kategori->nama_kategori }}</td>
                    <td>{{ $product->stok }} {{ $product->satuan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
