<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi - Shuisi</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 14px;
            color: #333;
            margin: 0;
            padding: 0;
            background: #fff;
        }
        .container {
            width: 90%;
            margin: auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #d35400; /* Warna oren ala sushi 🍣 */
        }
        .header p {
            margin: 5px 0;
            font-size: 16px;
        }
        .info {
            text-align: left;
            margin-bottom: 20px;
        }
        .info p {
            font-size: 14px;
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #333;
            text-align: left;
        }
        table th {
            background: #d35400; /* Warna tema Shuisi */
            color: #fff;
            font-size: 14px;
        }
        table tr:nth-child(even) {
            background: #f9f9f9;
        }
        .total {
            text-align: right;
            font-size: 16px;
            font-weight: bold;
            margin-top: 20px;
        }
        .total span {
            color: #d35400; /* Warna mencolok */
        }
        @media print {
            @page {
                size: A4 portrait;
                margin: 20mm;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body onload="window.print()">

<div class="container">
    <!-- Header -->
    <div class="header">
        <h1>Shuisi Resto</h1>
        <p>Laporan Transaksi</p>
    </div>

    <!-- Info Periode -->
    <div class="info">
        <p><strong>Periode:</strong> {{ $tanggalFilter }}</p>
        <p><strong>Tanggal Cetak:</strong> {{ $tanggalCetak }}</p>
    </div>

    <!-- Tabel Transaksi -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Pelanggan</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksis as $index => $transaksi)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaksi->created_at)->translatedFormat('d F Y') }}</td>
                    <td>{{ $transaksi->pelanggan->Namapelanggan ?? '-' }}</td>
                    <td>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Total Pendapatan -->
    <p class="total">Total Pendapatan: <span>Rp {{ number_format($total, 0, ',', '.') }}</span></p>
</div>

</body>
</html>
