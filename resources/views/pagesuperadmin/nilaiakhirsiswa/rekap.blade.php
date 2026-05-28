@extends('template-admin.layout')

@section('content')
<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard-superadmin">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Nilai Akhir Siswa</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Rekap Nilai Akhir Siswa</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Nilai Akhir Siswa</h5>
                        <a href="{{ route('nilai-akhir.print', request()->query()) }}" target="_blank"
                            class="btn btn-primary btn-sm">
                            <i class="fas fa-print"></i> Cetak Laporan
                        </a>
                    </div>
                    <div class="card-body">

                        {{-- Filter --}}
                        <form action="{{ route('nilai-akhir.index') }}" method="GET" class="mb-4 pb-3 border-bottom">
                            <div class="row align-items-end g-2">
                                <div class="col-md-3">
                                    <label class="form-label">Kelas</label>
                                    <select name="kelas" class="form-control">
                                        <option value="">Semua Kelas</option>
                                        @foreach(['VII A','VII B','VII C','VIII A','VIII B','VIII C','IX A','IX B','IX C'] as $k)
                                            <option value="{{ $k }}" {{ $kelasFilter == $k ? 'selected' : '' }}>
                                                {{ $k }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Mata Pelajaran</label>
                                    <select name="mapel_id" class="form-control">
                                        <option value="">Semua Mapel</option>
                                        @foreach($mapels as $mapel)
                                            <option value="{{ $mapel->id }}"
                                                {{ $mapelFilter == $mapel->id ? 'selected' : '' }}>
                                                {{ $mapel->nama_mapel }} – Kelas {{ $mapel->kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-secondary w-100">
                                        <i class="fas fa-filter"></i> Filter
                                    </button>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('nilai-akhir.index') }}" class="btn btn-outline-secondary w-100">
                                        <i class="fas fa-times"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </form>

                        {{-- Keterangan Formula --}}
                        <div class="alert alert-info d-flex align-items-center gap-2 mb-3" style="font-size:0.88em;">
                            <i class="fas fa-info-circle"></i>
                            <span>
                                <strong>Formula Nilai Akhir:</strong>
                                (Rata-rata Quiz × 40%) + (Nilai UTS × 20%) + (Nilai UAS × 40%)
                                &nbsp;|&nbsp; KKM: <strong>72</strong>
                            </span>
                        </div>

                        {{-- Tabel --}}
                        <div class="dt-responsive table-responsive">
                            <table id="nilaiakhirtable" class="table table-striped table-bordered nowrap">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Kelas</th>
                                        <th>Mata Pelajaran</th>
                                        <th class="text-center">Rata-rata Quiz<br><small class="fw-normal">(40%)</small></th>
                                        <th class="text-center">Nilai UTS<br><small class="fw-normal">(20%)</small></th>
                                        <th class="text-center">Nilai UAS<br><small class="fw-normal">(40%)</small></th>
                                        <th class="text-center">Nilai Akhir</th>
                                        <th class="text-center">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($hasil as $i => $row)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $row['siswa']->nama_lengkap }}</td>
                                            <td>{{ $row['siswa']->kelas }}</td>
                                            <td>{{ $row['mapel']->nama_mapel }}</td>
                                            <td class="text-center">
                                                @if($row['rata_quiz'] !== null)
                                                    <span class="badge {{ $row['rata_quiz'] >= 72 ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $row['rata_quiz'] }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">–</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($row['nilai_uts'] !== null)
                                                    <span class="badge {{ $row['nilai_uts'] >= 72 ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $row['nilai_uts'] }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">–</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($row['nilai_uas'] !== null)
                                                    <span class="badge {{ $row['nilai_uas'] >= 72 ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $row['nilai_uas'] }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">–</span>
                                                @endif
                                            </td>
                                            <td class="text-center fw-bold">
                                                @if($row['nilai_akhir'] !== null)
                                                    <span style="font-size:1.05em;color:{{ $row['lulus'] ? '#198754' : '#dc3545' }}">
                                                        {{ $row['nilai_akhir'] }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">–</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($row['nilai_akhir'] !== null)
                                                    @if($row['lulus'])
                                                        @if($row['ada_remedial'] ?? false)
                                                            <span class="badge" style="background-color:#f39c12;font-size:0.85em;"><i class="fas fa-check-circle"></i> LULUS<br><small>Setelah Remedial</small></span>
                                                        @else
                                                            <span class="badge bg-success"><i class="fas fa-check-circle"></i> LULUS</span>
                                                        @endif
                                                    @else
                                                        @if($row['ada_remedial'] ?? false)
                                                            <span class="badge bg-danger"><i class="fas fa-sync-alt"></i> REMEDIAL<br><small>Belum Lulus</small></span>
                                                        @else
                                                            <span class="badge bg-danger"><i class="fas fa-times-circle"></i> TIDAK LULUS<br><small>Perlu Remedial</small></span>
                                                        @endif
                                                    @endif
                                                @else
                                                    <span class="badge bg-secondary">Belum Ada Data</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center text-muted py-4">
                                                <i class="fas fa-database me-2"></i>Tidak ada data nilai akhir.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('#nilaiakhirtable').DataTable({
            pageLength: 25,
            order: [[2, 'asc'], [1, 'asc']],
        });
    });
</script>
@endsection
