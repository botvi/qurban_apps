@extends('template-admin.layout')
@section('title', 'Data Peserta')

@section('content')
<div class="pc-content">
    <!-- [ Page Header ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Peserta</li>
                    </ul>
                </div>
                <div class="col-md-12 d-flex align-items-center justify-content-between">
                    <h2 class="mb-0" style="color: #064e3b; font-weight: 800;"><i class="fa fa-users me-1"></i> Data Peserta</h2>
                    @if (auth()->user()->role === 'admin')
                    <a href="{{ route('participants.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i> Tambah Peserta
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- [ Page Header ] end -->

    <!-- Table Card -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Daftar Peserta Tabungan Qurban</h5>
                </div>
                <div class="card-body">
                    <!-- Search Form -->
                    <form method="GET" action="{{ route('participants.index') }}" class="row g-2 mb-3 align-items-center justify-content-end">
                        <div class="col-auto">
                            <input type="text" name="search" class="form-control" placeholder="Cari NIK atau Nama..." value="{{ request('search') }}">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Cari</button>
                            @if(request('search'))
                                <a href="{{ route('participants.index') }}" class="btn btn-light-secondary">Reset</a>
                            @endif
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama Peserta</th>
                                    <th>Jenis Kelamin</th>
                                    <th>No. HP</th>
                                    <th>Alamat</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($participants as $idx => $participant)
                                <tr>
                                    <td>{{ $participants->firstItem() + $idx }}</td>
                                    <td><code>{{ $participant->nik }}</code></td>
                                    <td><strong>{{ $participant->nama }}</strong></td>
                                    <td>
                                        <span class="badge badge-{{ $participant->jenis_kelamin }}">{{ $participant->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                                    </td>
                                    <td>{{ $participant->no_hp ?? '-' }}</td>
                                    <td>{{ Str::limit($participant->alamat, 40) }}</td>
                                    <td>
                                        <span class="badge badge-{{ $participant->status }}">{{ ucfirst($participant->status) }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('participants.show', $participant) }}" class="btn btn-sm btn-outline-primary" title="Detail">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                            @if (auth()->user()->role === 'admin')
                                            <a href="{{ route('participants.edit', $participant) }}" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <form action="{{ route('participants.destroy', $participant) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus peserta {{ $participant->nama }}?')">
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
                                    <td colspan="8" class="text-center py-4 text-muted">Belum ada data peserta yang terdaftar.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                        <div style="font-size:0.85em; color:#6b7280;">
                            Menampilkan {{ $participants->firstItem() ?? 0 }} - {{ $participants->lastItem() ?? 0 }} dari {{ $participants->total() }} data
                        </div>
                        <div>
                            {{ $participants->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
