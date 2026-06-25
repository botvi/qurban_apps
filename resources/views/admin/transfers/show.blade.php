@extends('template-admin.layout')
@section('title', 'Detail Pengajuan Transfer')

@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('transfers.index') }}">Konfirmasi Transfer</a></li>
                        <li class="breadcrumb-item active">Detail #{{ $transfer->id }}</li>
                    </ul>
                </div>
                <div class="col-md-12 d-flex align-items-center justify-content-between">
                    <h2 class="mb-0" style="color:#064e3b;font-weight:800;"><i class="fa-solid fa-magnifying-glass me-1"></i> Detail Pengajuan Transfer</h2>
                    <a href="{{ route('transfers.index') }}" class="btn btn-secondary">
                        <i class="ti ti-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Kolom kiri: info transfer -->
        <div class="col-md-5">
            <div class="card mb-3">
                <div class="card-header">
                    <h5><i class="fa-solid fa-clipboard-list me-1"></i> Informasi Pengajuan</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0" style="font-size:.88em;">
                        <tr>
                            <td style="width:40%;color:#6b7280;font-weight:600;">ID Pengajuan</td>
                            <td><code>#{{ $transfer->id }}</code></td>
                        </tr>
                        <tr>
                            <td style="color:#6b7280;font-weight:600;">Tanggal Masuk</td>
                            <td>{{ $transfer->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                        <tr>
                            <td style="color:#6b7280;font-weight:600;">Status</td>
                            <td>
                                @if($transfer->status === 'pending')
                                    <span class="badge" style="background:#f59e0b;color:#fff;padding:5px 12px;"><i class="fa fa-spinner fa-spin me-1"></i> Menunggu Konfirmasi</span>
                                @elseif($transfer->status === 'approved')
                                    <span class="badge" style="background:#10b981;color:#fff;padding:5px 12px;"><i class="fa fa-check-circle me-1"></i> Dikonfirmasi</span>
                                @else
                                    <span class="badge" style="background:#ef4444;color:#fff;padding:5px 12px;"><i class="fa fa-times-circle me-1"></i> Ditolak</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <h5><i class="fa-solid fa-user me-1"></i> Data Peserta</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0" style="font-size:.88em;">
                        <tr>
                            <td style="width:40%;color:#6b7280;font-weight:600;">Nama</td>
                            <td><strong>{{ $transfer->participant->nama ?? '-' }}</strong></td>
                        </tr>
                        <tr>
                            <td style="color:#6b7280;font-weight:600;">NIK</td>
                            <td><code>{{ $transfer->participant->nik ?? '-' }}</code></td>
                        </tr>
                        <tr>
                            <td style="color:#6b7280;font-weight:600;">No. HP</td>
                            <td>{{ $transfer->participant->no_hp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td style="color:#6b7280;font-weight:600;">Status Peserta</td>
                            <td>
                                <span class="badge badge-{{ $transfer->participant->status ?? 'nonaktif' }}">
                                    {{ ucfirst($transfer->participant->status ?? '-') }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <h5><i class="fa-solid fa-money-bill-wave me-1"></i> Detail Transfer</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0" style="font-size:.88em;">
                        <tr>
                            <td style="width:45%;color:#6b7280;font-weight:600;">Jumlah Transfer</td>
                            <td><strong class="text-success" style="font-size:1.15em;">Rp {{ number_format($transfer->jumlah, 0, ',', '.') }}</strong></td>
                        </tr>
                        <tr>
                            <td style="color:#6b7280;font-weight:600;">Tanggal Transfer</td>
                            <td>{{ \Carbon\Carbon::parse($transfer->tanggal_transfer)->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <td style="color:#6b7280;font-weight:600;">Bank Pengirim</td>
                            <td>{{ $transfer->nama_bank ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td style="color:#6b7280;font-weight:600;">No. Rekening</td>
                            <td>{{ $transfer->no_rekening_pengirim ?? '-' }}</td>
                        </tr>
                        @if($transfer->keterangan)
                        <tr>
                            <td style="color:#6b7280;font-weight:600;">Keterangan</td>
                            <td>{{ $transfer->keterangan }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>

            @if($transfer->status !== 'pending')
            <div class="card mb-3" style="border-left: 4px solid {{ $transfer->status === 'approved' ? '#10b981' : '#ef4444' }};">
                <div class="card-header">
                    <h5>{!! $transfer->status === 'approved' ? '<i class="fa fa-check-circle me-1"></i> Informasi Konfirmasi' : '<i class="fa fa-times-circle me-1"></i> Informasi Penolakan' !!}</h5>
                </div>
                <div class="card-body" style="font-size:.88em;">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <td style="width:45%;color:#6b7280;font-weight:600;">Diproses oleh</td>
                            <td>{{ $transfer->reviewer->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td style="color:#6b7280;font-weight:600;">Waktu Proses</td>
                            <td>{{ $transfer->reviewed_at?->format('d M Y, H:i') ?? '-' }}</td>
                        </tr>
                        @if($transfer->catatan_admin)
                        <tr>
                            <td style="color:#6b7280;font-weight:600;">Catatan Admin</td>
                            <td style="color:#dc2626;">{{ $transfer->catatan_admin }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
            @endif
        </div>

        <!-- Kolom kanan: bukti TF + aksi -->
        <div class="col-md-7">
            <div class="card mb-3">
                <div class="card-header">
                    <h5><i class="fa-solid fa-image me-1"></i> Bukti Transfer</h5>
                </div>
                <div class="card-body text-center p-3">
                    <img src="{{ Storage::url($transfer->bukti_tf) }}"
                        alt="Bukti Transfer"
                        style="max-width:100%;max-height:500px;border-radius:12px;border:1px solid #99f6e4;object-fit:contain;"
                        onerror="this.src=''; this.alt='Gambar tidak ditemukan';">
                    <div class="mt-3">
                        <a href="{{ Storage::url($transfer->bukti_tf) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                            <i class="ti ti-external-link me-1"></i> Buka di Tab Baru
                        </a>
                    </div>
                </div>
            </div>

            @if($transfer->status === 'pending')
            <div class="card">
                <div class="card-header">
                    <h5><i class="fa-solid fa-bolt me-1"></i> Tindakan Admin</h5>
                </div>
                <div class="card-body">
                    <p style="font-size:.88em;color:#6b7280;margin-bottom:20px;">
                        Verifikasi bukti transfer di atas, lalu pilih tindakan yang sesuai.
                        Jika dikonfirmasi, setoran akan otomatis tercatat dalam sistem tabungan.
                    </p>

                    <div class="d-flex gap-3 flex-wrap">
                        @php
                            $transferJumlahFmt = number_format($transfer->jumlah, 0, ',', '.');
                            $transferNama = addslashes($transfer->participant->nama ?? 'peserta');
                        @endphp
                        <!-- ACC -->
                        <form action="{{ route('transfers.approve', $transfer) }}" method="POST"
                            onsubmit="return confirm('Konfirmasi & catat setoran Rp {{ $transferJumlahFmt }} dari {{ $transferNama }}?')">
                            @csrf
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="ti ti-check me-2"></i> ACC &mdash; Konfirmasi Transfer
                            </button>
                        </form>

                        <!-- Tolak -->
                        <button type="button" class="btn btn-danger btn-lg" onclick="showRejectForm()">
                            <i class="ti ti-x me-2"></i> Tolak Transfer
                        </button>
                    </div>

                    <!-- Form Tolak (hidden by default) -->
                    <div id="rejectFormWrap" style="display:none;margin-top:24px;padding-top:20px;border-top:1px solid #e5e7eb;">
                        <form action="{{ route('transfers.reject', $transfer) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" style="font-weight:700;font-size:.85em;text-transform:uppercase;">
                                    Alasan Penolakan <span style="color:#ef4444;">*</span>
                                </label>
                                <textarea name="catatan_admin" class="form-control" rows="3"
                                    placeholder="Contoh: Bukti transfer tidak terbaca, nominal tidak sesuai, dll."
                                    required></textarea>
                            </div>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-danger">Konfirmasi Penolakan</button>
                                <button type="button" class="btn btn-secondary" onclick="hideRejectForm()">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
function showRejectForm() {
    document.getElementById('rejectFormWrap').style.display = 'block';
    document.getElementById('rejectFormWrap').scrollIntoView({ behavior: 'smooth' });
}
function hideRejectForm() {
    document.getElementById('rejectFormWrap').style.display = 'none';
}
</script>
@endsection
