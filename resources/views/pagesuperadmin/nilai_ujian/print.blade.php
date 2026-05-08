<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Nilai Ujian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 14px;
        }
        .title {
            text-align: center;
            margin: 20px 0;
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: underline;
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
            padding: 8px;
            text-align: center;
        }
        td:nth-child(2), td:nth-child(3), td:nth-child(4) {
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="header">
        <h1>SMP NEGERI 1 BENAI</h1>
        <p>Kecamatan Benai, Kabupaten Kuantan Singingi, Riau</p>
    </div>

    <div class="title">
        Laporan Nilai Ujian Siswa
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Siswa</th>
                <th>Judul Ujian</th>
                <th>Mapel</th>
                <th>Kelas</th>
                <th>Nilai</th>
                <th>Waktu Dikerjakan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nilais as $i => $item)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $item->user->name ?? 'Unknown' }}</td>
                <td>{{ $item->ujian->judul ?? '-' }}</td>
                <td>{{ $item->ujian->mapel->nama_mapel ?? '-' }}</td>
                <td>{{ $item->ujian->mapel->kelas ?? '-' }}</td>
                <td>{{ $item->nilai_ujian }}</td>
                <td>{{ $item->created_at->format('d M Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
