@extends('template-admin.layout')

@section('content')
    <section class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard-superadmin">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('mapel.index') }}">Master Mapel</a></li>
                                <li class="breadcrumb-item" aria-current="page">Form Edit Mapel</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Form Edit Mata Pelajaran</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Form Edit Mapel</h5>
                            <small class="text-muted">
                                Kelas aktif sudah tercentang. Centang kelas lain untuk <strong>menduplikasi</strong> ke kelas tersebut.
                            </small>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('mapel.update', $mapel->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group mb-3">
                                    <label class="form-label fw-semibold">Nama Mata Pelajaran</label>
                                    <input type="text" name="nama_mapel" class="form-control"
                                        value="{{ old('nama_mapel', $mapel->nama_mapel) }}" required>
                                    @error('nama_mapel')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label fw-semibold">Pilih Kelas <span class="text-danger">*</span></label>
                                    <p class="text-muted small mb-2">
                                        <span class="badge bg-primary">{{ $mapel->kelas }}</span> adalah kelas yang sedang diedit.
                                        Centang kelas lain untuk <strong>menduplikasi</strong> mapel ini ke kelas tersebut sekaligus.
                                    </p>

                                    {{-- Tombol Pilih Semua --}}
                                    <div class="mb-2 d-flex gap-2 flex-wrap">
                                        <button type="button" class="btn btn-sm btn-outline-primary" id="pilihSemuaBtn">✔ Pilih Semua</button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" id="hapusSemuaBtn">✖ Hapus Semua</button>
                                        <button type="button" class="btn btn-sm btn-outline-info" onclick="pilihRombel('VII')">Pilih Semua Kelas VII</button>
                                        <button type="button" class="btn btn-sm btn-outline-info" onclick="pilihRombel('VIII')">Pilih Semua Kelas VIII</button>
                                        <button type="button" class="btn btn-sm btn-outline-info" onclick="pilihRombel('IX')">Pilih Semua Kelas IX</button>
                                    </div>

                                    <div class="row g-2 mt-1" id="kelasCheckboxes">
                                        {{-- Kelas VII --}}
                                        <div class="col-md-4">
                                            <div class="card border p-3">
                                                <h6 class="text-primary mb-2">Kelas VII</h6>
                                                @foreach(['VII1', 'VII2', 'VII3'] as $kls)
                                                    <div class="form-check mb-1">
                                                        <input class="form-check-input kelas-check kelas-VII" type="checkbox"
                                                            name="kelas[]" value="{{ $kls }}"
                                                            id="kelas_{{ str_replace(' ', '_', $kls) }}"
                                                            {{ in_array($kls, old('kelas', [$mapel->kelas])) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="kelas_{{ str_replace(' ', '_', $kls) }}">
                                                            {{ $kls }}
                                                            @if($kls == $mapel->kelas)
                                                                <span class="badge bg-primary ms-1" style="font-size:10px;">Aktif</span>
                                                            @endif
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        {{-- Kelas VIII --}}
                                        <div class="col-md-4">
                                            <div class="card border p-3">
                                                <h6 class="text-success mb-2">Kelas VIII</h6>
                                                @foreach(['VIII1', 'VIII2', 'VIII3'] as $kls)
                                                    <div class="form-check mb-1">
                                                        <input class="form-check-input kelas-check kelas-VIII" type="checkbox"
                                                            name="kelas[]" value="{{ $kls }}"
                                                            id="kelas_{{ str_replace(' ', '_', $kls) }}"
                                                            {{ in_array($kls, old('kelas', [$mapel->kelas])) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="kelas_{{ str_replace(' ', '_', $kls) }}">
                                                            {{ $kls }}
                                                            @if($kls == $mapel->kelas)
                                                                <span class="badge bg-primary ms-1" style="font-size:10px;">Aktif</span>
                                                            @endif
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        {{-- Kelas IX --}}
                                        <div class="col-md-4">
                                            <div class="card border p-3">
                                                <h6 class="text-warning mb-2">Kelas IX</h6>
                                                @foreach(['IX1', 'IX2', 'IX3'] as $kls)
                                                    <div class="form-check mb-1">
                                                        <input class="form-check-input kelas-check kelas-IX" type="checkbox"
                                                            name="kelas[]" value="{{ $kls }}"
                                                            id="kelas_{{ str_replace(' ', '_', $kls) }}"
                                                            {{ in_array($kls, old('kelas', [$mapel->kelas])) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="kelas_{{ str_replace(' ', '_', $kls) }}">
                                                            {{ $kls }}
                                                            @if($kls == $mapel->kelas)
                                                                <span class="badge bg-primary ms-1" style="font-size:10px;">Aktif</span>
                                                            @endif
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    @error('kelas')
                                        <small class="text-danger d-block mt-2">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="card-footer text-end">
                                    <button type="submit" class="btn btn-primary me-2">Update Mapel</button>
                                    <a href="{{ route('mapel.index') }}" class="btn btn-light">Kembali</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
<script>
    document.getElementById('pilihSemuaBtn').addEventListener('click', function() {
        document.querySelectorAll('.kelas-check').forEach(cb => cb.checked = true);
    });
    document.getElementById('hapusSemuaBtn').addEventListener('click', function() {
        document.querySelectorAll('.kelas-check').forEach(cb => cb.checked = false);
    });
    function pilihRombel(tingkat) {
        document.querySelectorAll('.kelas-' + tingkat).forEach(cb => cb.checked = !cb.checked);
    }
</script>
@endsection
