@extends('template-admin.layout')
@section('title', 'Input Penarikan')

@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('withdrawals.index') }}">Penarikan Dana</a></li>
                        <li class="breadcrumb-item active">Input Penarikan</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <h2 class="mb-0" style="color: #064e3b; font-weight: 800;"><i class="fa fa-money-bill-wave me-1"></i> Input Penarikan/Pengembalian Dana</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-danger">
                    <h5 class="text-white">Formulir Penarikan Uang Jamaah</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('withdrawals.store') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="form-label" for="participant_id">Nama Peserta</label>
                            <select name="participant_id" id="participant_id" class="form-select @error('participant_id') is-invalid @enderror" required>
                                <option value="" disabled selected>-- Pilih Peserta Aktif --</option>
                                @foreach($participants as $participant)
                                    <option value="{{ $participant->id }}" data-balance="{{ (int)$participant->balance }}" {{ old('participant_id') == $participant->id ? 'selected' : '' }}>
                                        {{ $participant->nama }} (Saldo Saat Ini: Rp {{ number_format($participant->balance, 0, ',', '.') }})
                                    </option>
                                @endforeach
                            </select>
                            @error('participant_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="tanggal">Tanggal Transaksi</label>
                                    <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                                    @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="jumlah">Jumlah Penarikan (Rp)</label>
                                    <input type="number" name="jumlah" id="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{ old('jumlah') }}" placeholder="Contoh: 500000" required min="1000">
                                    <small id="balance-info" class="text-muted d-block mt-1">Pilih peserta terlebih dahulu untuk melihat batas saldo penarikan.</small>
                                    @error('jumlah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="alasan">Alasan Penarikan / Pengembalian</label>
                            <textarea name="alasan" id="alasan" rows="3" class="form-control @error('alasan') is-invalid @enderror" placeholder="Sebutkan alasan penarikan dana qurban (contoh: Keperluan mendesak / Qurban dibatalkan)" required>{{ old('alasan') }}</textarea>
                            @error('alasan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-danger text-white">Simpan Transaksi</button>
                            <a href="{{ route('withdrawals.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#participant_id').change(function() {
            var selectedOption = $(this).find('option:selected');
            var balance = selectedOption.data('balance');
            if(balance !== undefined) {
                var formatted = new Intl.NumberFormat('id-ID').format(balance);
                $('#balance-info').html('Batas maksimal penarikan: <strong class="text-danger">Rp ' + formatted + '</strong>');
                $('#jumlah').attr('max', balance);
            } else {
                $('#balance-info').text('Pilih peserta terlebih dahulu untuk melihat batas saldo penarikan.');
                $('#jumlah').removeAttr('max');
            }
        });
    });
</script>
@endsection
