<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Keuangan Tabungan Qurban</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #000;
            margin: 20px;
            font-size: 12px;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 30px;
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
            margin-bottom: 30px;
            text-transform: uppercase;
        }
        .summary-box {
            width: 100%;
            border: 1px solid #000;
            margin-bottom: 25px;
            border-collapse: collapse;
        }
        .summary-box th, .summary-box td {
            border: 1px solid #000;
            padding: 12px;
            text-align: left;
        }
        .summary-box th {
            background-color: #f2f2f2;
            width: 50%;
        }
        .footer-print {
            float: right;
            text-align: center;
            width: 200px;
            margin-top: 50px;
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

    <div class="title">Laporan Keuangan Tabungan Qurban</div>

    <table class="summary-box">
        <tr>
            <th>Total Peserta Terdaftar</th>
            <td><strong>{{ $totalParticipants }} Orang</strong></td>
        </tr>
        <tr>
            <th>Total Pemasukan (Setoran Jamaah)</th>
            <td style="color: green; font-weight: bold;">Rp {{ number_format($totalDeposits, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Total Pengeluaran (Penarikan Dana)</th>
            <td style="color: red; font-weight: bold;">Rp {{ number_format($totalWithdrawals, 0, ',', '.') }}</td>
        </tr>
        <tr style="background-color: #f9f9f9; font-size: 1.1em;">
            <th>Saldo Bersih Keseluruhan</th>
            <td style="font-weight: bold; text-decoration: underline;">Rp {{ number_format($netBalance, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div style="font-size: 11px; color: #555; margin-top: 20px;">
        * Laporan ini dicetak secara otomatis dari sistem informasi pengelolaan tabungan qurban Masjid Nurul Iman Sungai Perupuk.
    </div>

    <div class="footer-print">
        <p>Padang, {{ date('d F Y') }}</p>
        <p>Bendahara Masjid</p>
        <div class="sig-space"></div>
        <p><strong>( ____________________ )</strong></p>
    </div>

</body>
</html>
