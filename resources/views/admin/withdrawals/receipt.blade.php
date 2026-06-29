<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Penarikan Dana Qurban #{{ $withdrawal->id }}</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            color: #000;
            padding: 20px;
            font-size: 14px;
            line-height: 1.5;
            max-width: 650px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            border-bottom: 2px double #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 0 0 5px 0;
            font-size: 20px;
            text-transform: uppercase;
        }
        .header p {
            margin: 0;
            font-size: 12px;
        }
        .title {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            text-decoration: underline;
            margin-bottom: 25px;
            text-transform: uppercase;
            color: #dc2626;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        .details-table td {
            padding: 6px 4px;
            vertical-align: top;
        }
        .amount-box {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 25px;
            background: #fff5f5;
            border-color: #dc2626;
            color: #dc2626;
        }
        .signatures {
            margin-top: 50px;
            width: 100%;
            display: flex;
            justify-content: space-between;
        }
        .sig-box {
            text-align: center;
            width: 45%;
        }
        .sig-space {
            height: 70px;
        }
        .no-print-btn {
            display: block;
            margin: 20px auto;
            padding: 8px 16px;
            background: #dc2626;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: Arial, sans-serif;
            font-weight: bold;
        }
        @media print {
            .no-print-btn {
                display: none;
            }
            body {
                padding: 0;
            }
        }
    </style>
</head>
<body>

    <button class="no-print-btn" onclick="window.print()">Cetak Kwitansi</button>

    <div class="header">
        <h2>Masjid Nurul Iman Sungai Perupuk</h2>
        <p>Alamat: Jalan Sungai Perupuk, Kota Padang, Sumatera Barat</p>
        <p>Telepon: - | Email: masjidnuruliman@gmail.com</p>
    </div>

    <div class="title">Bukti Penarikan / Pengembalian Dana Qurban</div>

    <table class="details-table">
        <tr>
            <td style="width: 30%;">No. Transaksi</td>
            <td style="width: 3%;">:</td>
            <td style="font-weight: bold;">#WD-{{ str_pad($withdrawal->id, 5, '0', STR_PAD_LEFT) }}</td>
        </tr>
        <tr>
            <td>Tanggal Transaksi</td>
            <td>:</td>
            <td>{{ date('d F Y', strtotime($withdrawal->tanggal)) }}</td>
        </tr>
        <tr>
            <td>NIK Peserta</td>
            <td>:</td>
            <td>{{ $withdrawal->participant->nik }}</td>
        </tr>
        <tr>
            <td>Nama Peserta</td>
            <td>:</td>
            <td><strong>{{ $withdrawal->participant->nama }}</strong></td>
        </tr>
        <tr>
            <td>Alasan Penarikan</td>
            <td>:</td>
            <td>{{ $withdrawal->alasan }}</td>
        </tr>
        @php
            $activeTarget = $withdrawal->participant->activeTarget();
            $sisaSaldo = $withdrawal->participant->balance;
        @endphp
        <tr>
            <td>Sisa Saldo Tabungan</td>
            <td>:</td>
            <td style="font-weight: bold;">Rp {{ number_format($sisaSaldo, 0, ',', '.') }}</td>
        </tr>
        @if($activeTarget)
        <tr>
            <td>Target Program</td>
            <td>:</td>
            <td>{{ $activeTarget->category->nama_kategori }} ({{ $activeTarget->tahun_qurban }}) - Target: Rp {{ number_format($activeTarget->target_dana, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Progres Target</td>
            <td>:</td>
            <td style="font-weight: bold;">
                Rp {{ number_format($sisaSaldo, 0, ',', '.') }} dari Rp {{ number_format($activeTarget->target_dana, 0, ',', '.') }} 
                ({{ round(($sisaSaldo / $activeTarget->target_dana) * 100, 1) }}%)
            </td>
        </tr>
        @endif
    </table>

    <div class="amount-box">
        JUMLAH PENARIKAN: Rp {{ number_format($withdrawal->jumlah, 0, ',', '.') }}
    </div>

    <div style="font-style: italic; font-size: 12px; margin-bottom: 20px; border-bottom: 1px dashed #000; padding-bottom: 5px;">
        Terbilang: {{ ucwords(terbilang($withdrawal->jumlah)) }} Rupiah
    </div>

    <div class="signatures">
        <div class="sig-box">
            <p>Penerima Dana/Jamaah</p>
            <div class="sig-space"></div>
            <p>( _______________________ )</p>
        </div>
        <div class="sig-box">
            <p>Diserahkan Oleh (Admin Masjid)</p>
            <div class="sig-space"></div>
            <p><strong>( {{ $withdrawal->user->name }} )</strong></p>
        </div>
    </div>
</body>
</html>

<?php
// Simple helper to convert number to words in Indonesian
if (!function_exists('terbilang')) {
    function terbilang($angka) {
        $angka = abs($angka);
        $baca = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $terbilang = "";
        if ($angka < 12) {
            $terbilang = " " . $baca[$angka];
        } else if ($angka < 20) {
            $terbilang = terbilang($angka - 10) . " belas";
        } else if ($angka < 100) {
            $terbilang = terbilang($angka / 10) . " puluh" . terbilang($angka % 10);
        } else if ($angka < 200) {
            $terbilang = " seratus" . terbilang($angka - 100);
        } else if ($angka < 1000) {
            $terbilang = terbilang($angka / 100) . " ratus" . terbilang($angka % 100);
        } else if ($angka < 2000) {
            $terbilang = " seribu" . terbilang($angka - 1000);
        } else if ($angka < 1000000) {
            $terbilang = terbilang($angka / 1000) . " ribu" . terbilang($angka % 1000);
        } else if ($angka < 1000000000) {
            $terbilang = terbilang($angka / 1000000) . " juta" . terbilang($angka % 1000000);
        }
        return $terbilang;
    }
}
?>
