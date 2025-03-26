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
            <p>Salford & Co.<br>Fashion Terlengkap</p>
        </div>

        <div class="flex justify-between mt-4">
            <div>
                <p><strong>KEPADA:</strong></p>
                <p>Ketut Susilo</p>
                <p>hello@reallygreatsite.com</p>
            </div>
            <div>
                <p><strong>TANGGAL:</strong></p>
                <p>Senin, 28 Maret 2022</p>
                <p><strong>NO INVOICE:</strong> 128/03/2022</p>
            </div>
        </div>

        <table class="table mt-4">
            <thead class="bg-gray-200">
                <tr>
                    <th>KETERANGAN</th>
                    <th>HARGA</th>
                    <th>JML</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>KAOS</td>
                    <td>RP 100.000</td>
                    <td>1</td>
                    <td>RP 100.000</td>
                </tr>
                <tr>
                    <td>JAKET</td>
                    <td>RP 200.000</td>
                    <td>1</td>
                    <td>RP 200.000</td>
                </tr>
                <tr>
                    <td>KAOS POLO</td>
                    <td>RP 120.000</td>
                    <td>1</td>
                    <td>RP 120.000</td>
                </tr>
                <tr>
                    <td>SEPATU</td>
                    <td>RP 230.000</td>
                    <td>1</td>
                    <td>RP 230.000</td>
                </tr>
                <tr>
                    <td>SEPATU</td>
                    <td>RP 230.000</td>
                    <td>1</td>
                    <td>RP 230.000</td>
                </tr>
            </tbody>
        </table>

        <div class="mt-4">
            <p><strong>PEMBAYARAN:</strong></p>
            <p>Nama: Salford & Co.</p>
            <p>No Rek: 123-456-7890</p>
        </div>

        <div class="mt-4">
            <p>SUB TOTAL: RP 800.000</p>
            <p>PAJAK: RP 80.000</p>
            <p><strong>TOTAL: RP 880.000</strong></p>
        </div>

        <div class="footer">
            <p>TERIMA KASIH ATAS PEMBELIAN ANDA</p>
        </div>

        <div class="signature">
            <p>_________________________</p>
            <p>Juliana Silva</p>
        </div>
    </div>

</body>
</html>
