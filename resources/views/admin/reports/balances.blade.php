@extends('template-admin.layout')
@section('title', 'Laporan Saldo')

@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item">Laporan</li>
                        <li class="breadcrumb-item active">Laporan Saldo Peserta</li>
                    </ul>
                </div>
                <div class="col-md-12 d-flex align-items-center justify-content-between">
                    <h2 class="mb-0" style="color: #064e3b; font-weight: 800;"><i class="fa-solid fa-file-invoice me-1"></i> Laporan Saldo Peserta</h2>
                    <a href="{{ route('reports.balances', ['print' => true]) }}" target="_blank" class="btn btn-warning">
                        <i class="ti ti-printer me-1"></i> Cetak Laporan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Daftar Akumulasi Saldo Tabungan Peserta</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama Peserta</th>
                                    <th>Total Setoran (+)</th>
                                    <th>Total Penarikan (-)</th>
                                    <th>Saldo Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($participants as $idx => $participant)
                                <tr>
                                    <td>{{ $idx + 1 }}</td>
                                    <td><code>{{ $participant->nik }}</code></td>
                                    <td><strong>{{ $participant->nama }}</strong></td>
                                    <td class="text-success font-weight-bold">Rp {{ number_format($participant->total_deposits, 0, ',', '.') }}</td>
                                    <td class="text-danger font-weight-bold">Rp {{ number_format($participant->total_withdrawals, 0, ',', '.') }}</td>
                                    <td class="text-primary font-weight-bold" style="font-size:1.05em;">Rp {{ number_format($participant->balance, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">Belum ada data peserta.</td>
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
