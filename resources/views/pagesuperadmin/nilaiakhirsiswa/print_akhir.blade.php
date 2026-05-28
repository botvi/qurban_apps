<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Nilai Akhir Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 12px;
        }

        .title {
            text-align: center;
            margin: 16px 0 4px;
            font-size: 15px;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: underline;
        }

        .subtitle {
            text-align: center;
            margin-bottom: 16px;
            font-size: 11px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #000;
        }

        th, td {
            padding: 6px 8px;
            text-align: center;
            vertical-align: middle;
        }

        td:nth-child(2), td:nth-child(3), td:nth-child(4) {
            text-align: left;
        }

        th {
            background-color: #e2e8f0;
            font-size: 11px;
        }

        .lulus        { color: #166534; font-weight: bold; }
        .gagal        { color: #991b1b; font-weight: bold; }
        .remedial-ok  { color: #92400e; font-weight: bold; }
        .empty        { color: #999; }

        @media print {
            .no-print { display: none; }
        }
    </style>
</head>

<body onload="window.print()">

    {{-- Kop surat --}}
    <table style="border:none;border-bottom:3px solid #000;margin-bottom:12px;">
        <tr>
            <td style="width:12%;text-align:left;border:none;">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQq9BqgIl6ON8ljjfpIV1tbRhV2cA_K_iYzcg&s"
                    alt="Logo" style="width:80px;height:auto;">
            </td>
            <td style="width:76%;text-align:center;border:none;">
                <h1 style="margin:0;font-size:20px;text-transform:uppercase;">SMP NEGERI 1 BENAI</h1>
                <p style="margin:4px 0 0;font-size:12px;">Kecamatan Benai, Kabupaten Kuantan Singingi, Riau</p>
            </td>
            <td style="width:12%;text-align:right;border:none;">
                <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEh7k6wFKW3yD7f2pNt_5xgz1oOjPHI5USNrGR3dCRGwOVcY90xPcQWFJGXIl6j_kh2Om3B-gc-0tPAFVhHVxFOwx-7J2LK2fIxc_U7mPiURK1Vj7f_w-DjnCP2O2IAfkC7P4VLPrfZTDh1Z/s400/Kab+Kuantan+Singingi+%255Bbagilogo.com%255D.png"
                    alt="Logo Kanan" style="width:75px;height:auto;">
            </td>
        </tr>
    </table>

    <div class="title">Rekap Nilai Akhir Siswa</div>
    <div class="subtitle">
        Formula: Rata-rata Quiz (40%) + Nilai UTS (20%) + Nilai UAS (40%) &nbsp;|&nbsp; KKM: 72
        @if($kelasFilter) &nbsp;|&nbsp; Kelas: {{ $kelasFilter }} @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Mata Pelajaran</th>
                <th>Rata-rata Quiz<br>(40%)</th>
                <th>Nilai UTS<br>(20%)</th>
                <th>Nilai UAS<br>(40%)</th>
                <th>Nilai Akhir</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($hasil as $i => $row)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $row['siswa']->nama_lengkap }}</td>
                    <td>{{ $row['siswa']->kelas }}</td>
                    <td>{{ $row['mapel']->nama_mapel }}</td>
                    <td>{{ $row['rata_quiz'] !== null ? $row['rata_quiz'] : '-' }}</td>
                    <td>{{ $row['nilai_uts'] !== null ? $row['nilai_uts'] : '-' }}</td>
                    <td>{{ $row['nilai_uas'] !== null ? $row['nilai_uas'] : '-' }}</td>
                    <td><strong>{{ $row['nilai_akhir'] !== null ? $row['nilai_akhir'] : '-' }}</strong></td>
                    <td>
                        @if($row['nilai_akhir'] !== null)
                            @if($row['lulus'])
                                @if($row['ada_remedial'] ?? false)
                                    <span class="remedial-ok">&#10003; LULUS Setelah Remedial</span>
                                @else
                                    <span class="lulus">&#10003; LULUS</span>
                                @endif
                            @else
                                @if($row['ada_remedial'] ?? false)
                                    <span class="gagal">&#8635; REMEDIAL &ndash; Belum Lulus</span>
                                @else
                                    <span class="gagal">&#9888; TIDAK LULUS &ndash; Perlu Remedial</span>
                                @endif
                            @endif
                        @else
                            <span class="empty">&ndash;</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align:center;color:#999;">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="float:right;width:280px;text-align:center;margin-top:40px;margin-right:20px;">
        <p>Benai, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <p style="margin-bottom:70px;">Mengetahui,</p>
        <p><strong>(......................................)</strong></p>
    </div>

</body>
</html>
