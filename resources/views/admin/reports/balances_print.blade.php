<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Saldo Peserta Tabungan Qurban</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #000;
            margin: 20px;
            font-size: 12px;
        }
        .header {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 0 0 5px 0;
            text-transform: uppercase;
        }
        .header p {
            margin: 0;
        }
        .title {
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }
        .report-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .report-table th, .report-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .report-table th {
            background-color: #f2f2f2;
        }
        .footer-print {
            float: right;
            text-align: center;
            width: 200px;
            margin-top: 30px;
        }
        .sig-space {
            height: 70px;
        }
    </style>
</head>
<body onload="window.print()">

    <div class="header">
        <h2>Masjid Nurul Iman Sungai Perupuk</h2>
        <p>Alamat: Jalan Sungai Perupuk, Kota Padang, Sumatera Barat</p>
        <p>Email: masjidnuruliman@gmail.com</p>
    </div>

    <div class="title">Laporan Akumulasi Saldo Tabungan Qurban Jamaah</div>

    <table class="report-table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th>NIK</th>
                <th>Nama Peserta</th>
                <th>Total Setoran (+)</th>
                <th>Total Penarikan (-)</th>
                <th>Saldo Akhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach($participants as $idx => $participant)
            <tr>
                <td>{{ $idx + 1 }}</td>
                <td>{{ $participant->nik }}</td>
                <td><strong>{{ $participant->nama }}</strong></td>
                <td>Rp {{ number_format($participant->total_deposits, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($participant->total_withdrawals, 0, ',', '.') }}</td>
                <td><strong>Rp {{ number_format($participant->balance, 0, ',', '.') }}</strong></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer-print">
        <p>Padang, {{ date('d F Y') }}</p>
        <p>Pengurus Masjid</p>
        <div class="sig-space"></div>
        <p><strong>( ____________________ )</strong></p>
    </div>

</body>
</html>
