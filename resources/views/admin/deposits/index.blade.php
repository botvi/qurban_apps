@extends('template-admin.layout')
@section('title', 'Setoran Tabungan')

@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Setoran Tabungan</li>
                    </ul>
                </div>
                <div class="col-md-12 d-flex align-items-center justify-content-between">
                    <h2 class="mb-0" style="color: #064e3b; font-weight: 800;"><i class="fa-solid fa-money-bill-wave me-1"></i> Setoran Tabungan</h2>
                    @if (auth()->user()->role === 'admin')
                    <a href="{{ route('deposits.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i> Input Setoran
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Daftar Riwayat Setoran Jamaah</h5>
                </div>
                <div class="card-body">
                    <!-- Search Form -->
                    <form method="GET" action="{{ route('deposits.index') }}" class="row g-2 mb-3 align-items-center justify-content-end">
                        <div class="col-auto">
                            <input type="text" name="search" class="form-control" placeholder="Cari nama peserta..." value="{{ request('search') }}">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Cari</button>
                            @if(request('search'))
                                <a href="{{ route('deposits.index') }}" class="btn btn-light-secondary">Reset</a>
                            @endif
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Peserta</th>
                                    <th>Jumlah Setoran</th>
                                    <th>Keterangan</th>
                                    <th>Penerima (Admin)</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($deposits as $idx => $deposit)
                                <tr>
                                    <td>{{ $deposits->firstItem() + $idx }}</td>
                                    <td>{{ date('d/m/Y', strtotime($deposit->tanggal)) }}</td>
                                    <td>
                                        <strong>{{ $deposit->participant->nama }}</strong>
                                        @php
                                            $activeTarget = $deposit->participant->activeTarget();
                                        @endphp
                                        @if($activeTarget)
                                            @php
                                                $pct = $activeTarget->target_dana > 0 ? ($deposit->participant->balance / $activeTarget->target_dana) * 100 : 0;
                                                $pctClamped = min(max($pct, 0), 100);
                                            @endphp
                                            <div style="font-size: 0.78em; margin-top: 4px; color: #4b5563;">
                                                <div class="mb-1">Target: <span class="badge bg-light-primary text-primary" style="font-size: 0.9em; padding: 2px 6px; font-weight: bold;">{{ $activeTarget->category->nama_kategori }} ({{ $activeTarget->tahun_qurban }})</span></div>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="progress" style="height: 5px; width: 85px; margin-bottom: 0; background-color: #e5e7eb; border-radius: 4px; overflow: hidden;">
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $pctClamped }}%"></div>
                                                    </div>
                                                    <span style="font-weight: 700; color: #047857;">{{ round($pct, 1) }}% (Rp {{ number_format($deposit->participant->balance, 0, ',', '.') }})</span>
                                                </div>
                                            </div>
                                        @else
                                            <div style="font-size: 0.75em; color: #9ca3af; margin-top: 4px;">
                                                <i class="fa fa-info-circle me-1"></i> Belum ada target aktif
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-success font-weight-bold">Rp {{ number_format($deposit->jumlah, 0, ',', '.') }}</td>
                                    <td>{{ $deposit->keterangan ?? '-' }}</td>
                                    <td><code>{{ $deposit->user->name }}</code></td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('deposits.show', $deposit) }}" target="_blank" class="btn btn-sm btn-outline-primary" title="Cetak Bukti">
                                                <i class="ti ti-printer"></i> Bukti
                                            </a>
                                            @if (auth()->user()->role === 'admin')
                                            <form action="{{ route('deposits.destroy', $deposit) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan/menghapus transaksi setoran Rp {{ number_format($deposit->jumlah, 0, ',', '.') }} untuk {{ $deposit->participant->nama }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">Belum ada riwayat transaksi setoran.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                        <div style="font-size:0.85em; color:#6b7280;">
                            Menampilkan {{ $deposits->firstItem() ?? 0 }} - {{ $deposits->lastItem() ?? 0 }} dari {{ $deposits->total() }} data
                        </div>
                        <div>
                            {{ $deposits->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
