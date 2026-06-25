@extends('template-admin.layout')
@section('title', 'Input Setoran')

@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('deposits.index') }}">Setoran Tabungan</a></li>
                        <li class="breadcrumb-item active">Input Setoran</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <h2 class="mb-0" style="color: #064e3b; font-weight: 800;"><i class="fa-solid fa-money-bill-wave me-1"></i> Input Setoran Tabungan</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Formulir Setoran Uang Jamaah</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('deposits.store') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="form-label" for="participant_id">Nama Peserta</label>
                            <select name="participant_id" id="participant_id" class="form-select @error('participant_id') is-invalid @enderror" required>
                                <option value="" disabled selected>-- Pilih Peserta Aktif --</option>
                                @foreach($participants as $participant)
                                    <option value="{{ $participant->id }}" {{ old('participant_id') == $participant->id ? 'selected' : '' }}>
                                        {{ $participant->nama }} (NIK: {{ $participant->nik }})
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
                                    <label class="form-label" for="jumlah">Jumlah Setoran (Rp)</label>
                                    <input type="number" name="jumlah" id="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{ old('jumlah') }}" placeholder="Minimal Rp 1.000" required min="1000">
                                    @error('jumlah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="keterangan">Keterangan Tambahan</label>
                            <textarea name="keterangan" id="keterangan" rows="3" class="form-control @error('keterangan') is-invalid @enderror" placeholder="Contoh: Setoran tunai bulan Maret (opsional)">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                            <a href="{{ route('deposits.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
