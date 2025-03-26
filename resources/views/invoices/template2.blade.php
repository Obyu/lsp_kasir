<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
        }
        .header {
            text-align: center;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            padding: 8px;
            text-align: left;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
        }
        .signature {
            margin-top: 40px;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h2 class="text-xl font-bold">INVOICE</h2>
            <p>Shuisi<br>Restoran Sushi</p>
        </div>

        <div class="flex justify-between mt-4">
            <div>
                <p><strong>KEPADA:</strong></p>
                <p>{{ $pesanan->pelanggan->Namapelanggan }}</p>
            </div>
            <div>
                <p><strong>TANGGAL:</strong></p>
                <p>{{ now() }}</p>
                <p><strong>NO INVOICE:</strong> 128/05/2025</p>
            </div>
        </div>

        <table class="table mt-4">
            <thead class="bg-gray-200">
                <tr>
                    <th>NAMA MENU</th>
                    <th>HARGA</th>
                    <th>JML</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pesanans as $pesanan)
                <tr>
                    <td>{{ $pesanan->menu->Namamenu }}</td>
                    <td>{{ 'Rp ' . number_format($pesanan->menu->Harga,0,',','.') }}</td>
                    <td>{{ $pesanan->jumlah }}</td>
                    <td>{{'Rp ' . number_format($pesanan->menu->Harga * $pesanan->jumlah ,0, ',' , '.')}}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
        <hr>
        <div class="mt-4">
            <p><strong>PEMBAYARAN:</strong></p>
            <p>Nama: {{ $pesanan->pelanggan->Namapelanggan }}</p>
            <p>No Rek: 123-456-7890</p>
        </div>
      
        <div class="mt-4">
            <p><strong>TOTAL: {{ $transaksi->total}}</strong></p>
            <p><strong>BAYAR: {{ $transaksi->bayar }}</strong></p>
            <p><strong>KEMBALIAN: {{ $transaksi->kembalian }}</strong></p>
        </div>

        <div class="footer">
            <p>TERIMA KASIH ATAS PEMBELIAN ANDA</p>
        </div>

    </div>

</body>
</html>
