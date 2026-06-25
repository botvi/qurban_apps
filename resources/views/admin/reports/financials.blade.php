@extends('template-admin.layout')
@section('title', 'Laporan Keuangan')

@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item">Laporan</li>
                        <li class="breadcrumb-item active">Laporan Keuangan</li>
                    </ul>
                </div>
                <div class="col-md-12 d-flex align-items-center justify-content-between">
                    <h2 class="mb-0" style="color: #064e3b; font-weight: 800;"><i class="fa-solid fa-file-invoice me-1"></i> Laporan Keuangan Tabungan Qurban</h2>
                    <a href="{{ route('reports.financials', ['print' => true]) }}" target="_blank" class="btn btn-warning">
                        <i class="ti ti-printer me-1"></i> Cetak Laporan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row">
        <div class="col-md-6">
            <div class="card bg-light-success border-success mb-4">
                <div class="card-body">
                    <h6 class="text-success text-uppercase font-weight-bold" style="letter-spacing:0.5px;">Total Pemasukan (Setoran Jamaah)</h6>
                    <h2 class="text-success font-weight-bold mb-0">Rp {{ number_format($totalDeposits, 0, ',', '.') }}</h2>
                    <p class="text-muted mt-1 mb-0">Total akumulasi dana yang disetorkan oleh jamaah ke tabungan qurban.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-light-danger border-danger mb-4">
                <div class="card-body">
                    <h6 class="text-danger text-uppercase font-weight-bold" style="letter-spacing:0.5px;">Total Pengeluaran (Penarikan / Pengembalian)</h6>
                    <h2 class="text-danger font-weight-bold mb-0">Rp {{ number_format($totalWithdrawals, 0, ',', '.') }}</h2>
                    <p class="text-muted mt-1 mb-0">Total dana tabungan yang ditarik kembali oleh jamaah.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card text-center" style="background:#f0fdf4; border: 2px solid #047857;">
                <div class="card-body py-5">
                    <span style="font-size:3em; color:#10b981;"><i class="fa-solid fa-wallet"></i></span>
                    <h4 class="text-uppercase text-muted mt-2 mb-1" style="font-size:0.9em; letter-spacing:1px;">Saldo Keseluruhan (Net Balance)</h4>
                    <h1 class="text-primary font-weight-bold mb-3" style="font-size:3em;">Rp {{ number_format($netBalance, 0, ',', '.') }}</h1>
                    <p class="text-muted" style="max-width:500px; margin: 0 auto; line-height:1.6;">
                        Dana kas bersih tabungan qurban yang saat ini dipegang oleh Masjid Nurul Iman Sungai Perupuk untuk total <strong>{{ $totalParticipants }}</strong> peserta terdaftar.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
