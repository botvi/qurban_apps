@extends('template-admin.layout')
@section('title', 'Konfirmasi Transfer')

@section('content')
<div class="pc-content">
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Konfirmasi Transfer</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <h2 class="mb-0" style="color:#064e3b;font-weight:800;"><i class="fa fa-money-bill-wave me-1"></i> Konfirmasi Transfer Tabungan</h2>
                    <p class="text-muted">Verifikasi bukti transfer dari jamaah peserta tabungan qurban.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-3">
        <div class="col-md-4">
            <div class="card" style="border-left:5px solid #f59e0b;background:#fffbeb;">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div style="font-size:.8em;text-transform:uppercase;letter-spacing:.5px;color:#6b7280;font-weight:600;">Menunggu Konfirmasi</div>
                            <div style="font-size:2em;font-weight:900;color:#d97706;">{{ $pendingCount }}</div>
                        </div>
                        <div style="font-size:2em;opacity:.5;"><i class="fa fa-hourglass-half text-warning"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="border-left:5px solid #10b981;">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div style="font-size:.8em;text-transform:uppercase;letter-spacing:.5px;color:#6b7280;font-weight:600;">Dikonfirmasi</div>
                            <div style="font-size:2em;font-weight:900;color:#10b981;">{{ $approvedCount }}</div>
                        </div>
                        <div style="font-size:2em;opacity:.5;"><i class="fa fa-check-circle text-success"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="border-left:5px solid #ef4444;">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div style="font-size:.8em;text-transform:uppercase;letter-spacing:.5px;color:#6b7280;font-weight:600;">Ditolak</div>
                            <div style="font-size:2em;font-weight:900;color:#ef4444;">{{ $rejectedCount }}</div>
                        </div>
                        <div style="font-size:2em;opacity:.5;"><i class="fa fa-times-circle text-danger"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter + Tabel -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5>Daftar Pengajuan Bukti Transfer</h5>
                </div>
                <div class="card-body">
                    <!-- Filter Form -->
                    <form method="GET" action="{{ route('transfers.index') }}" class="row g-2 mb-3 align-items-center">
                        <div class="col-auto">
                            <input type="text" name="search" class="form-control"
                                placeholder="Cari nama peserta..." value="{{ request('search') }}">
                        </div>
                        <div class="col-auto">
                            <select name="status" class="form-select">
                                <option value="">-- Semua Status --</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Dikonfirmasi</option>
                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Cari</button>
                            @if(request('search') || request('status'))
                            <a href="{{ route('transfers.index') }}" class="btn btn-light-secondary">Reset</a>
                            @endif
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Nama Peserta</th>
                                    <th>Tgl Transfer</th>
                                    <th>Jumlah</th>
                                    <th>Bank Pengirim</th>
                                    <th>Bukti TF</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($submissions as $idx => $sub)
                                @php
                                    $subJumlahFmt = number_format($sub->jumlah, 0, ',', '.');
                                    $subNama = addslashes($sub->participant->nama ?? 'peserta');
                                @endphp
                                <tr>
                                    <td>{{ $submissions->firstItem() + $idx }}</td>
                                    <td style="font-size:.82em;color:#6b7280;">{{ $sub->created_at->format('d M Y, H:i') }}</td>
                                    <td><strong>{{ $sub->participant->nama ?? '-' }}</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($sub->tanggal_transfer)->format('d M Y') }}</td>
                                    <td><strong class="text-success">Rp {{ $subJumlahFmt }}</strong></td>
                                    <td>
                                        @if($sub->nama_bank)
                                            <span class="badge bg-light text-dark">{{ $sub->nama_bank }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ Storage::url($sub->bukti_tf) }}" target="_blank"
                                            class="btn btn-sm btn-outline-primary" title="Lihat Bukti TF">
                                            <i class="ti ti-photo"></i> Lihat
                                        </a>
                                    </td>
                                    <td>
                                        @if($sub->status === 'pending')
                                            <span class="badge" style="background:#f59e0b;color:#fff;font-size:.78em;padding:5px 10px;"><i class="fa fa-spinner fa-spin me-1"></i> Pending</span>
                                        @elseif($sub->status === 'approved')
                                            <span class="badge" style="background:#10b981;color:#fff;font-size:.78em;padding:5px 10px;"><i class="fa fa-check-circle me-1"></i> Dikonfirmasi</span>
                                        @else
                                            <span class="badge" style="background:#ef4444;color:#fff;font-size:.78em;padding:5px 10px;"><i class="fa fa-times-circle me-1"></i> Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('transfers.show', $sub) }}"
                                                class="btn btn-sm btn-outline-primary" title="Detail">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                            @if($sub->status === 'pending')
                                            <form action="{{ route('transfers.approve', $sub) }}" method="POST" class="d-inline"
                                                onsubmit="return confirm('Konfirmasi transfer Rp {{ $subJumlahFmt }} dari {{ $subNama }}?')">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success" title="ACC / Konfirmasi">
                                                    <i class="ti ti-check"></i> ACC
                                                </button>
                                            </form>
                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="openReject({{ $sub->id }}, '{{ $subNama }}')"
                                                title="Tolak">
                                                <i class="ti ti-x"></i> Tolak
                                            </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center py-5 text-muted">
                                        Belum ada pengajuan transfer yang masuk.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                        <div style="font-size:.85em;color:#6b7280;">
                            Menampilkan {{ $submissions->firstItem() ?? 0 }}–{{ $submissions->lastItem() ?? 0 }} dari {{ $submissions->total() }} data
                        </div>
                        {{ $submissions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tolak -->
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px;overflow:hidden;">
            <div class="modal-header" style="background:linear-gradient(135deg,#dc2626,#ef4444);color:#fff;border:none;">
                <h5 class="modal-title text-white"><i class="fa fa-times-circle me-1"></i> Tolak Pengajuan Transfer</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="rejectForm" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <p style="font-size:.88em;color:#6b7280;margin-bottom:16px;">
                        Anda akan menolak pengajuan transfer dari <strong id="rejectName"></strong>.
                        Mohon berikan alasan penolakan yang jelas.
                    </p>
                    <div class="form-group">
                        <label class="form-label" style="font-weight:700;font-size:.82em;text-transform:uppercase;letter-spacing:.5px;">Alasan Penolakan <span style="color:#ef4444;">*</span></label>
                        <textarea name="catatan_admin" class="form-control" rows="4"
                            placeholder="Contoh: Bukti transfer tidak terbaca, nominal tidak sesuai, dll."
                            required></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger"><i class="ti ti-x me-1"></i> Tolak Transfer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
function openReject(id, name) {
    document.getElementById('rejectName').textContent = name;
    document.getElementById('rejectForm').action = '/transfers/' + id + '/reject';
    document.querySelector('#rejectModal textarea').value = '';
    var modal = new bootstrap.Modal(document.getElementById('rejectModal'));
    modal.show();
}
</script>
@endsection
