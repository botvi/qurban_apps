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
                                    @php
                                        $activeTarget = $participant->activeTarget();
                                    @endphp
                                    <option value="{{ $participant->id }}" 
                                        data-balance="{{ (int)$participant->balance }}"
                                        data-has-target="{{ $activeTarget ? 'true' : 'false' }}"
                                        data-target-category="{{ $activeTarget ? $activeTarget->category->nama_kategori : '' }}"
                                        data-target-year="{{ $activeTarget ? $activeTarget->tahun_qurban : '' }}"
                                        data-target-amount="{{ $activeTarget ? (int)$activeTarget->target_dana : 0 }}"
                                        {{ old('participant_id') == $participant->id ? 'selected' : '' }}>
                                        {{ $participant->nama }} (NIK: {{ $participant->nik }})
                                    </option>
                                @endforeach
                            </select>

                            <!-- Target Info & Withdrawal Impact Section -->
                            <div id="target-info-section" class="card mt-3 mb-3 d-none" style="border: 1px solid #fecaca; background-color: #fff5f5; border-radius: 8px;">
                                <div class="card-body p-3">
                                    <h6 class="mb-2" style="font-weight: 700; color: #991b1b;"><i class="fa fa-bullseye me-1"></i> Informasi Target & Dampak Penarikan</h6>
                                    <div class="row">
                                        <div class="col-sm-6 mb-2 mb-sm-0">
                                            <div style="font-size: 0.8em; color: #6b7280;">Kategori & Tahun Qurban</div>
                                            <div id="info-target-category" style="font-weight: 700; font-size: 0.95em;">-</div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div style="font-size: 0.8em; color: #6b7280;">Target Dana</div>
                                            <div id="info-target-amount" style="font-weight: 700; font-size: 0.95em;">Rp 0</div>
                                        </div>
                                    </div>
                                    <hr style="margin: 10px 0; border-top: 1px dashed #fecaca;">
                                    <div class="row">
                                        <div class="col-sm-6 mb-2 mb-sm-0">
                                            <div style="font-size: 0.8em; color: #6b7280;">Saldo Tabungan</div>
                                            <div id="info-current-balance" style="font-weight: 700; font-size: 0.95em; color: #047857;">Rp 0</div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div style="font-size: 0.8em; color: #6b7280;">Kekurangan/Sisa Target</div>
                                            <div id="info-target-remaining" style="font-weight: 700; font-size: 0.95em; color: #b91c1c;">Rp 0</div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="d-flex justify-content-between mb-1" style="font-size: 0.8em; font-weight: 600;">
                                            <span>Progres Target (Setelah Penarikan)</span>
                                            <span id="info-progress-pct" class="text-danger">0%</span>
                                        </div>
                                        <div class="progress" style="height: 8px; background-color: #fee2e2; border-radius: 4px; overflow: hidden;">
                                            <div id="info-progress-bar" class="progress-bar bg-danger" role="progressbar" style="width: 0%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- No Target Info & Withdrawal Impact Section -->
                            <div id="no-target-info-section" class="card mt-3 mb-3 d-none" style="border: 1px solid #e5e7eb; background-color: #f9fafb; border-radius: 8px;">
                                <div class="card-body p-3">
                                    <h6 class="mb-2" style="font-weight: 700; color: #4b5563;"><i class="fa fa-info-circle me-1"></i> Informasi Tabungan & Dampak Penarikan</h6>
                                    <div class="row">
                                        <div class="col-sm-6 mb-2 mb-sm-0">
                                            <div style="font-size: 0.8em; color: #6b7280;">Saldo Tabungan Saat Ini</div>
                                            <div id="no-target-balance" style="font-weight: 700; font-size: 0.95em; color: #047857;">Rp 0</div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div style="font-size: 0.8em; color: #6b7280;">Estimasi Sisa Saldo</div>
                                            <div id="no-target-remaining-balance" style="font-weight: 700; font-size: 0.95em; color: #dc2626;">-</div>
                                        </div>
                                    </div>
                                    <div style="font-size: 0.78em; color: #9ca3af; margin-top: 10px; border-top: 1px solid #e5e7eb; padding-top: 6px;">
                                        *Peserta ini belum terdaftar mengikuti program target qurban.
                                    </div>
                                </div>
                            </div>
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
        function updateWithdrawalCalculations() {
            var selectedOption = $('#participant_id').find('option:selected');
            if (!selectedOption.val()) {
                $('#target-info-section').addClass('d-none');
                $('#no-target-info-section').addClass('d-none');
                $('#balance-info').text('Pilih peserta terlebih dahulu untuk melihat batas saldo penarikan.');
                $('#jumlah').removeAttr('max');
                return;
            }

            var balance = parseInt(selectedOption.data('balance')) || 0;
            var hasTarget = selectedOption.data('has-target') === true || selectedOption.data('has-target') === 'true';
            var withdrawAmount = parseInt($('#jumlah').val()) || 0;

            var formattedBalance = new Intl.NumberFormat('id-ID').format(balance);
            $('#balance-info').html('Batas maksimal penarikan: <strong class="text-danger">Rp ' + formattedBalance + '</strong>');
            $('#jumlah').attr('max', balance);

            var remainingBalance = balance - withdrawAmount;
            if (remainingBalance < 0) remainingBalance = 0;
            var formattedRemainingBalance = 'Rp ' + new Intl.NumberFormat('id-ID').format(remainingBalance);

            if (hasTarget) {
                $('#target-info-section').removeClass('d-none');
                $('#no-target-info-section').addClass('d-none');

                var targetAmount = parseInt(selectedOption.data('target-amount')) || 0;
                var category = selectedOption.data('target-category');
                var year = selectedOption.data('target-year');

                var remainingTarget = targetAmount - remainingBalance;
                if (remainingTarget < 0) remainingTarget = 0;

                var pct = targetAmount > 0 ? (remainingBalance / targetAmount) * 100 : 0;
                var pctClamped = Math.min(Math.max(pct, 0), 100);

                $('#info-target-category').text(category + ' (' + year + ')');
                $('#info-target-amount').text('Rp ' + new Intl.NumberFormat('id-ID').format(targetAmount));

                var balanceHtml = 'Rp ' + formattedBalance;
                if (withdrawAmount > 0) {
                    balanceHtml += ' <span class="text-danger" style="font-size:0.85em; font-weight:bold;">- Rp ' + new Intl.NumberFormat('id-ID').format(withdrawAmount) + ' = Rp ' + new Intl.NumberFormat('id-ID').format(remainingBalance) + '</span>';
                }
                $('#info-current-balance').html(balanceHtml);

                $('#info-target-remaining').text('Rp ' + new Intl.NumberFormat('id-ID').format(remainingTarget));

                $('#info-progress-pct').text(pct.toFixed(1) + '%');
                $('#info-progress-bar').css('width', pctClamped + '%');
            } else {
                $('#target-info-section').addClass('d-none');
                $('#no-target-info-section').removeClass('d-none');

                $('#no-target-balance').text('Rp ' + formattedBalance);
                
                var remainingHtml = 'Rp ' + new Intl.NumberFormat('id-ID').format(remainingBalance);
                if (withdrawAmount > 0) {
                    remainingHtml = 'Rp ' + new Intl.NumberFormat('id-ID').format(remainingBalance) + ' <span class="text-danger" style="font-size:0.85em; font-weight:bold;">(Ditarik: Rp ' + new Intl.NumberFormat('id-ID').format(withdrawAmount) + ')</span>';
                }
                $('#no-target-remaining-balance').html(remainingHtml);
            }
        }

        $('#participant_id').change(updateWithdrawalCalculations);
        $('#jumlah').on('input', updateWithdrawalCalculations);

        // Run on page load if participant is preselected
        updateWithdrawalCalculations();
    });
</script>
@endsection
