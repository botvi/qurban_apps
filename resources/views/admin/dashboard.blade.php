@extends('template-admin.layout')
@section('title', 'Dashboard')

@section('content')
<div class="pc-content">
    <!-- [ Page Header ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <h2 class="mb-0" style="color: #064e3b; font-weight: 800;"><i class="fa-solid fa-kaaba text-warning me-1"></i> Dashboard Pengelolaan Tabungan</h2>
                    <p class="text-muted">Selamat datang di Panel Sistem Informasi Tabungan Qurban Masjid Nurul Iman Sungai Perupuk.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Page Header ] end -->

    {{-- Alert Transfer Pending --}}
    @if($pendingTransfers > 0)
    <div style="background:linear-gradient(135deg,#d97706,#f59e0b);border-radius:14px;padding:14px 20px;margin-bottom:16px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;">
        <div style="display:flex;align-items:center;gap:12px;">
            <span style="font-size:1.4em;color:white;"><i class="fa fa-spinner fa-spin"></i></span>
            <div>
                <div style="font-weight:700;color:#fff;font-size:.95em;">{{ $pendingTransfers }} Pengajuan Transfer Menunggu Konfirmasi</div>
                <div style="font-size:.8em;color:rgba(255,255,255,.85);">Silakan verifikasi bukti transfer dari jamaah.</div>
            </div>
        </div>
        <a href="{{ route('transfers.index') }}" style="background:rgba(255,255,255,.2);color:#fff;border:1.5px solid rgba(255,255,255,.4);padding:8px 18px;border-radius:10px;text-decoration:none;font-size:.85em;font-weight:600;white-space:nowrap;">
            Lihat Sekarang →
        </a>
    </div>
    @endif

    <!-- [ Main Cards ] start -->
    <div class="row">
        <!-- Card 1 -->
        <div class="col-md-6 col-xl-3">
            <div class="card bg-grd-primary" style="background: linear-gradient(135deg, #064e3b, #047857); color: white;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-white text-opacity-75 mb-1" style="font-size:0.85em; text-transform:uppercase; letter-spacing:0.5px;">Peserta Aktif</h6>
                            <h2 class="text-white mb-0" style="font-weight: 800;">{{ $totalParticipants }} <span style="font-size: 0.5em; font-weight: 400;">Orang</span></h2>
                        </div>
                        <div style="width: 50px; height: 50px; background: rgba(255,255,255,0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5em; color: white;">
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="col-md-6 col-xl-3">
            <div class="card" style="border-left: 5px solid #10b981;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1" style="font-size:0.85em; text-transform:uppercase; letter-spacing:0.5px;">Total Setoran</h6>
                            <h3 class="mb-0 text-success" style="font-weight: 800;">Rp {{ number_format($totalDeposits, 0, ',', '.') }}</h3>
                        </div>
                        <div style="width: 50px; height: 50px; background: #ecfdf5; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5em; color: #10b981;">
                            <i class="fa fa-money-bill-wave"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card 3 -->
        <div class="col-md-6 col-xl-3">
            <div class="card" style="border-left: 5px solid #ef4444;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1" style="font-size:0.85em; text-transform:uppercase; letter-spacing:0.5px;">Total Penarikan</h6>
                            <h3 class="mb-0 text-danger" style="font-weight: 800;">Rp {{ number_format($totalWithdrawals, 0, ',', '.') }}</h3>
                        </div>
                        <div style="width: 50px; height: 50px; background: #fef2f2; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5em; color: #ef4444;">
                            <i class="fa fa-hand-holding-usd"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card 4 -->
        <div class="col-md-6 col-xl-3">
            <div class="card" style="border-left: 5px solid #f59e0b; background: #fffbeb;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1" style="font-size:0.85em; text-transform:uppercase; letter-spacing:0.5px;">Saldo Keseluruhan</h6>
                            <h3 class="mb-0 text-warning" style="font-weight: 800;">Rp {{ number_format($netBalance, 0, ',', '.') }}</h3>
                        </div>
                        <div style="width: 50px; height: 50px; background: #fff7ed; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5em; color: #f59e0b;">
                            <i class="fa fa-wallet"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Cards ] end -->

    <div class="row mt-3">
        <!-- Chart Section -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5><i class="fa-solid fa-chart-line me-1"></i> Grafik Setoran Tabungan Qurban ({{ date('Y') }})</h5>
                </div>
                <div class="card-body">
                    <div id="setoran-chart"></div>
                </div>
            </div>
        </div>

        <!-- Info / Quick action Section -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fa-solid fa-bolt text-warning me-1"></i> Pintasan & Informasi</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        @if (auth()->user()->role === 'admin')
                        <a href="{{ route('participants.create') }}" class="btn btn-primary text-start">
                            <i class="ti ti-user-plus me-2"></i> Pendaftaran Peserta Baru
                        </a>
                        <a href="{{ route('deposits.create') }}" class="btn btn-success text-start text-white">
                            <i class="ti ti-plus me-2"></i> Input Setoran Tabungan
                        </a>
                        <a href="{{ route('withdrawals.create') }}" class="btn btn-danger text-start">
                            <i class="ti ti-minus me-2"></i> Input Penarikan Dana
                        </a>
                        @endif
                        <a href="{{ route('reports.financials') }}" class="btn btn-warning text-start">
                            <i class="ti ti-file-text me-2"></i> Laporan Keuangan
                        </a>
                    </div>
                    <hr>
                    <div style="font-size:0.85em; line-height:1.6; color:#555;">
                        <p class="mb-1"><strong>Panduan Cepat:</strong></p>
                        <ul>
                            <li>Daftarkan peserta di menu <strong>Data Peserta</strong></li>
                            @if (auth()->user()->role === 'admin')
                            <li>Set target tabungan di menu <strong>Target Qurban Peserta</strong></li>
                            <li>Lakukan pencatatan transaksi melalui menu <strong>Setoran</strong> / <strong>Penarikan</strong></li>
                            @endif
                            <li>Pimpinan/Pengurus dapat memantau seluruh aktivitas di menu <strong>Laporan</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Table -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fa-solid fa-bullseye me-1"></i> Progres Pencapaian Tabungan Qurban Jamaah (Tahun {{ date('Y') }})</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Nama Peserta</th>
                                    <th>Kategori</th>
                                    <th>Target Dana</th>
                                    <th>Dana Terkumpul</th>
                                    <th style="width: 30%;">Progres / Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($targets as $target)
                                <tr>
                                    <td><strong>{{ $target->nama }}</strong></td>
                                    <td>
                                        <span class="badge bg-light-primary text-primary">{{ $target->kategori }}</span>
                                    </td>
                                    <td>Rp {{ number_format($target->target, 0, ',', '.') }}</td>
                                    <td class="text-success">Rp {{ number_format($target->terkumpul, 0, ',', '.') }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="progress flex-grow-1" style="height: 10px; background: #e2e8f0; border-radius: 5px; overflow: hidden;">
                                                <div class="progress-bar" role="progressbar" 
                                                     style="width: {{ $target->persen }}%; background: linear-gradient(135deg, #d97706, #f59e0b);" 
                                                     aria-valuenow="{{ $target->persen }}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span style="font-size: 0.8em; font-weight: 600; min-width: 45px;">{{ $target->persen }}%</span>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">Belum ada target qurban yang didaftarkan untuk tahun ini ({{ date('Y') }}).</td>
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
@endsection

@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var options = {
            chart: {
                type: 'area',
                height: 320,
                toolbar: { show: false }
            },
            dataLabels: { enabled: false },
            colors: ['#047857'],
            stroke: {
                curve: 'smooth',
                width: 3
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.45,
                    opacityTo: 0.05,
                    stops: [0, 90, 100]
                }
            },
            series: [{
                name: 'Total Setoran (Rp)',
                data: @json($chartData)
            }],
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                labels: {
                    style: {
                        colors: '#6b7280',
                        fontSize: '11px',
                        fontFamily: 'Poppins'
                    }
                }
            },
            yaxis: {
                labels: {
                    formatter: function (val) {
                        return "Rp " + new Intl.NumberFormat('id-ID').format(val);
                    },
                    style: {
                        colors: '#6b7280',
                        fontSize: '11px',
                        fontFamily: 'Poppins'
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return "Rp " + new Intl.NumberFormat('id-ID').format(val);
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#setoran-chart"), options);
        chart.render();
    });
</script>
@endsection
