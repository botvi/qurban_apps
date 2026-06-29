@extends('template-admin.layout')
@section('title', 'Target Qurban Peserta')

@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Target Qurban Peserta</li>
                    </ul>
                </div>
                <div class="col-md-12 d-flex align-items-center justify-content-between">
                    <h2 class="mb-0" style="color: #064e3b; font-weight: 800;"><i class="fa fa-bullseye me-1"></i> Target Qurban Peserta</h2>
                    <a href="{{ route('targets.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i> Daftarkan Program
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Daftar Partisipasi Program Qurban Peserta</h5>
                </div>
                <div class="card-body">
                    <!-- Search Form -->
                    <form method="GET" action="{{ route('targets.index') }}" class="row g-2 mb-3 align-items-center justify-content-end">
                        <div class="col-auto">
                            <input type="text" name="search" class="form-control" placeholder="Cari nama peserta..." value="{{ request('search') }}">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Cari</button>
                            @if(request('search'))
                                <a href="{{ route('targets.index') }}" class="btn btn-light-secondary">Reset</a>
                            @endif
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Peserta</th>
                                    <th>Kategori Qurban</th>
                                    <th>Target Dana</th>
                                    <th>Progres Tabungan</th>
                                    <th>Tahun Qurban</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($targets as $idx => $target)
                                @php
                                    $balance = $target->participant->balance;
                                    $targetDana = $target->target_dana;
                                    $percent = $targetDana > 0 ? ($balance / $targetDana) * 100 : 0;
                                    $percentClamped = min(max($percent, 0), 100);
                                @endphp
                                <tr>
                                    <td>{{ $targets->firstItem() + $idx }}</td>
                                    <td><strong>{{ $target->participant->nama }}</strong></td>
                                    <td><span class="badge bg-light-primary text-primary">{{ $target->category->nama_kategori }}</span></td>
                                    <td><strong>Rp {{ number_format($targetDana, 0, ',', '.') }}</strong></td>
                                    <td>
                                        <div class="d-flex flex-column" style="min-width: 160px;">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <span style="font-size: 0.85em; font-weight: 700; color: #15803d;">Rp {{ number_format($balance, 0, ',', '.') }}</span>
                                                <span class="badge bg-light-success text-success" style="font-size: 0.8em; font-weight: bold;">{{ round($percent, 1) }}%</span>
                                            </div>
                                            <div class="progress" style="height: 6px; background-color: #e5e7eb;">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $percentClamped }}%" aria-valuenow="{{ $percentClamped }}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-light-warning text-warning" style="font-size:0.9em; font-weight:bold;">{{ $target->tahun_qurban }}</span></td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('targets.edit', $target) }}" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <form action="{{ route('targets.destroy', $target) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus target qurban untuk {{ $target->participant->nama }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">Belum ada data target qurban peserta.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                        <div style="font-size:0.85em; color:#6b7280;">
                            Menampilkan {{ $targets->firstItem() ?? 0 }} - {{ $targets->lastItem() ?? 0 }} dari {{ $targets->total() }} data
                        </div>
                        <div>
                            {{ $targets->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
