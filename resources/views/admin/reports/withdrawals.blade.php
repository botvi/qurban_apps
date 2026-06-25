@extends('template-admin.layout')
@section('title', 'Laporan Penarikan')

@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item">Laporan</li>
                        <li class="breadcrumb-item active">Laporan Penarikan</li>
                    </ul>
                </div>
                <div class="col-md-12 d-flex align-items-center justify-content-between">
                    <h2 class="mb-0" style="color: #064e3b; font-weight: 800;"><i class="fa-solid fa-file-invoice me-1"></i> Laporan Penarikan Dana Qurban</h2>
                    <a href="{{ route('reports.withdrawals', array_merge(request()->all(), ['print' => true])) }}" target="_blank" class="btn btn-warning">
                        <i class="ti ti-printer me-1"></i> Cetak Laporan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Form Card -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Filter Laporan Penarikan</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('reports.withdrawals') }}" class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label" for="filter_type">Jenis Filter</label>
                            <select name="filter_type" id="filter_type" class="form-select">
                                <option value="all" {{ $filterType === 'all' ? 'selected' : '' }}>Semua Transaksi</option>
                                <option value="harian" {{ $filterType === 'harian' ? 'selected' : '' }}>Harian</option>
                                <option value="bulanan" {{ $filterType === 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                                <option value="tahunan" {{ $filterType === 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                            </select>
                        </div>

                        <!-- Date input for Harian -->
                        <div class="col-md-3 filter-input-group" id="group-harian" style="display:none;">
                            <label class="form-label" for="date">Pilih Tanggal</label>
                            <input type="date" name="date" id="date" class="form-control" value="{{ $date }}">
                        </div>

                        <!-- Month & Year inputs for Bulanan -->
                        <div class="col-md-3 filter-input-group" id="group-bulanan-month" style="display:none;">
                            <label class="form-label" for="month">Pilih Bulan</label>
                            <select name="month" id="month" class="form-select">
                                @for($m=1; $m<=12; $m++)
                                    <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}" {{ $month == str_pad($m, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                                        {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-2 filter-input-group" id="group-bulanan-year" style="display:none;">
                            <label class="form-label" for="year-bulanan">Tahun</label>
                            <input type="number" name="year" id="year-bulanan" class="form-control" value="{{ $year }}" min="2020" max="2100">
                        </div>

                        <!-- Year input for Tahunan -->
                        <div class="col-md-3 filter-input-group" id="group-tahunan" style="display:none;">
                            <label class="form-label" for="year-tahunan">Pilih Tahun</label>
                            <input type="number" name="year_tahunan" id="year-tahunan" class="form-control" value="{{ $year }}" min="2020" max="2100">
                        </div>

                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">Filter Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Output Card -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h5>
                        Riwayat Penarikan Dana 
                        @if($filterType === 'harian')
                            - Tanggal {{ date('d/m/Y', strtotime($date)) }}
                        @elseif($filterType === 'bulanan')
                            - Bulan {{ date('F', mktime(0,0,0, (int)$month, 1)) }} {{ $year }}
                        @elseif($filterType === 'tahunan')
                            - Tahun {{ $year }}
                        @endif
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No. Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Nama Peserta</th>
                                    <th>Alasan Penarikan</th>
                                    <th>Jumlah Penarikan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($withdrawals as $idx => $withdrawal)
                                <tr>
                                    <td>{{ $idx + 1 }}</td>
                                    <td><code>#WD-{{ str_pad($withdrawal->id, 5, '0', STR_PAD_LEFT) }}</code></td>
                                    <td>{{ date('d/m/Y', strtotime($withdrawal->tanggal)) }}</td>
                                    <td><strong>{{ $withdrawal->participant->nama }}</strong></td>
                                    <td>{{ $withdrawal->alasan }}</td>
                                    <td class="text-danger font-weight-bold">Rp {{ number_format($withdrawal->jumlah, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">Tidak ada transaksi penarikan pada filter ini.</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr style="background:#fef2f2;">
                                    <th colspan="5" class="text-end font-weight-bold" style="color:#b91c1c;">TOTAL PENARIKAN:</th>
                                    <th class="text-danger font-weight-bold" style="font-size:1.1em;">Rp {{ number_format($total, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var filterSelect = document.getElementById('filter_type');
        
        function handleFilterChange() {
            var val = filterSelect.value;
            // Hide all
            document.querySelectorAll('.filter-input-group').forEach(el => el.style.display = 'none');
            
            if (val === 'harian') {
                document.getElementById('group-harian').style.display = 'block';
            } else if (val === 'bulanan') {
                document.getElementById('group-bulanan-month').style.display = 'block';
                document.getElementById('group-bulanan-year').style.display = 'block';
            } else if (val === 'tahunan') {
                document.getElementById('group-tahunan').style.display = 'block';
            }
        }
        
        filterSelect.addEventListener('change', handleFilterChange);
        handleFilterChange(); // run on load
    });
</script>
@endsection
