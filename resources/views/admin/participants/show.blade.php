@extends('template-admin.layout')
@section('title', 'Detail Peserta')

@section('content')
<div class="pc-content">
    <!-- [ Page Header ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('participants.index') }}">Data Peserta</a></li>
                        <li class="breadcrumb-item active">Detail Peserta</li>
                    </ul>
                </div>
                <div class="col-md-12 d-flex align-items-center justify-content-between">
                    <h2 class="mb-0" style="color: #064e3b; font-weight: 800;"><i class="fa-solid fa-file-invoice me-1"></i> Detail Profil Peserta</h2>
                    <a href="{{ route('participants.index') }}" class="btn btn-outline-secondary">
                        <i class="ti ti-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Page Header ] end -->

    <!-- Upper Section: Profile and Balance Summary -->
    <div class="row">
        <!-- Profile Card -->
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h5><i class="ti ti-user me-2"></i>Biodata Diri</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <th style="width: 35%;">NIK</th>
                                <td>: <code style="font-size: 1.1em;">{{ $participant->nik }}</code></td>
                            </tr>
                            <tr>
                                <th>Nama Lengkap</th>
                                <td>: <strong>{{ $participant->nama }}</strong></td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>: <span class="badge badge-{{ $participant->jenis_kelamin }}">{{ $participant->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</span></td>
                            </tr>
                            <tr>
                                <th>No. HP / WA</th>
                                <td>: {{ $participant->no_hp ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>: {{ $participant->alamat }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Terdaftar</th>
                                <td>: {{ date('d F Y', strtotime($participant->tanggal_daftar)) }}</td>
                            </tr>
                            <tr>
                                <th>Status Akun</th>
                                <td>: <span class="badge badge-{{ $participant->status }}">{{ ucfirst($participant->status) }}</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Balance Summary Card -->
        <div class="col-md-5">
            <div class="card bg-light-primary border-primary">
                <div class="card-header bg-primary text-white">
                    <h5><i class="ti ti-wallet me-2"></i>Informasi Keuangan</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <span class="text-muted" style="font-size:0.85em; text-transform:uppercase;">Total Setoran (Kredit)</span>
                        <h4 class="text-success mb-0" style="font-weight:700;">Rp {{ number_format($participant->total_deposits, 0, ',', '.') }}</h4>
                    </div>
                    <div class="mb-3">
                        <span class="text-muted" style="font-size:0.85em; text-transform:uppercase;">Total Penarikan (Debet)</span>
                        <h4 class="text-danger mb-0" style="font-weight:700;">Rp {{ number_format($participant->total_withdrawals, 0, ',', '.') }}</h4>
                    </div>
                    <hr>
                    <div>
                        <span class="text-muted" style="font-size:0.85em; text-transform:uppercase;">Saldo Saat Ini</span>
                        <h3 class="text-primary mb-0" style="font-weight:800;">Rp {{ number_format($participant->balance, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Targets Section -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fa-solid fa-bullseye me-1"></i> Program Qurban Diikuti</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Tahun Qurban</th>
                                    <th>Kategori Qurban</th>
                                    <th>Target Dana</th>
                                    <th>Dana Terkumpul</th>
                                    <th style="width: 35%;">Progres</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($participant->targets as $target)
                                    @php
                                        // Hitung saldo spesifik tahun ini (menggunakan total akumulatif peserta saat ini)
                                        $terkumpul = $participant->balance;
                                        $persen = $target->target_dana > 0 ? round(($terkumpul / $target->target_dana) * 100, 2) : 0;
                                        $persen = min(max($persen, 0), 100);
                                    @endphp
                                    <tr>
                                        <td><strong>{{ $target->tahun_qurban }}</strong></td>
                                        <td>{{ $target->category->nama_kategori }} ({{ $target->category->kode_kategori }})</td>
                                        <td>Rp {{ number_format($target->target_dana, 0, ',', '.') }}</td>
                                        <td class="text-success">Rp {{ number_format($terkumpul, 0, ',', '.') }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="progress flex-grow-1" style="height: 10px; background: #e2e8f0; border-radius: 5px; overflow: hidden;">
                                                    <div class="progress-bar" role="progressbar" 
                                                         style="width: {{ $persen }}%; background: linear-gradient(135deg, #d97706, #f59e0b);" 
                                                         aria-valuenow="{{ $persen }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <span style="font-size:0.85em; font-weight:600;">{{ $persen }}%</span>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-3 text-muted">Peserta belum didaftarkan mengikuti target qurban apa pun.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- History Tab Area -->
    <div class="row mt-3">
        <!-- Setoran History -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-light-success text-success">
                    <h5 class="text-success"><i class="ti ti-arrow-up-right me-2"></i>Riwayat Setoran</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($participant->deposits as $deposit)
                                    <tr>
                                        <td>{{ date('d/m/Y', strtotime($deposit->tanggal)) }}</td>
                                        <td class="text-success font-weight-bold">Rp {{ number_format($deposit->jumlah, 0, ',', '.') }}</td>
                                        <td style="font-size: 0.85em;">{{ $deposit->keterangan ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-3 text-muted">Belum ada riwayat setoran.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Penarikan History -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-light-danger text-danger">
                    <h5 class="text-danger"><i class="ti ti-arrow-down-left me-2"></i>Riwayat Penarikan Dana</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                    <th>Alasan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($participant->withdrawals as $withdrawal)
                                    <tr>
                                        <td>{{ date('d/m/Y', strtotime($withdrawal->tanggal)) }}</td>
                                        <td class="text-danger font-weight-bold">Rp {{ number_format($withdrawal->jumlah, 0, ',', '.') }}</td>
                                        <td style="font-size: 0.85em;">{{ $withdrawal->alasan ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-3 text-muted">Belum ada riwayat penarikan dana.</td>
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
