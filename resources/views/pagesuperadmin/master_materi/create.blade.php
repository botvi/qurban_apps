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
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Master Materi</a></li>
                                <li class="breadcrumb-item" aria-current="page">Form Tambah Materi</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Form Tambah Materi</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Form Tambah Materi</h5>
                            <small class="text-muted">Pilih beberapa mapel/kelas sekaligus agar tidak perlu input berulang</small>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('materi.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                {{-- ===================== PILIH MAPEL MULTI ===================== --}}
                                <div class="form-group mb-3">
                                    <label class="form-label fw-semibold">
                                        Mata Pelajaran & Kelas
                                        <span class="text-danger">*</span>
                                    </label>
                                    <p class="text-muted small mb-2">
                                        Centang semua kelas yang akan mendapatkan materi yang sama ini sekaligus.
                                    </p>

                                    {{-- Cari & Filter --}}
                                    <div class="mb-2 d-flex gap-2 flex-wrap align-items-center">
                                        <input type="text" id="searchMapel" class="form-control" style="max-width:220px;" placeholder="🔍 Cari nama mapel...">
                                        <button type="button" class="btn btn-sm btn-outline-primary" id="pilihSemuaMapel">✔ Pilih Semua</button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" id="hapusSemuaMapel">✖ Hapus Semua</button>
                                    </div>

                                    <div class="border rounded p-3" style="max-height:280px; overflow-y:auto;" id="mapelCheckboxList">
                                        @php
                                            // Kelompokkan mapel berdasarkan nama
                                            $mapelGrouped = $mapels->groupBy('nama_mapel');
                                        @endphp

                                        @foreach ($mapelGrouped as $namaMapel => $items)
                                            <div class="mapel-group mb-2">
                                                <strong class="text-primary small">{{ $namaMapel }}</strong>
                                                <div class="ps-2 mt-1 d-flex flex-wrap gap-3">
                                                    @foreach ($items as $mapel)
                                                        <div class="form-check mapel-item" data-nama="{{ strtolower($namaMapel) }}">
                                                            <input class="form-check-input mapel-check" type="checkbox"
                                                                name="mapel_ids[]"
                                                                value="{{ $mapel->id }}"
                                                                id="mapel_{{ $mapel->id }}"
                                                                {{ in_array($mapel->id, old('mapel_ids', [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label small" for="mapel_{{ $mapel->id }}">
                                                                Kelas {{ $mapel->kelas }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <hr class="my-1">
                                        @endforeach

                                        @if($mapels->isEmpty())
                                            <p class="text-muted">Belum ada mata pelajaran. <a href="{{ route('mapel.create') }}">Tambah mapel dulu</a>.</p>
                                        @endif
                                    </div>

                                    @error('mapel_ids')
                                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- ===================== FIELD MATERI ===================== --}}
                                <div class="form-group mb-3">
                                    <label class="form-label fw-semibold">Bab</label>
                                    <input type="text" name="bab" class="form-control" placeholder="Bab" value="{{ old('bab') }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label fw-semibold">Judul Materi</label>
                                    <input type="text" name="judul" class="form-control" placeholder="Judul Materi" value="{{ old('judul') }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label fw-semibold">Deskripsi</label>
                                    <input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi Singkat" value="{{ old('deskripsi') }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label fw-semibold">Link YouTube (Opsional)</label>
                                    <input type="url" name="link_youtube" class="form-control" placeholder="https://www.youtube.com/watch?v=..." value="{{ old('link_youtube') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label fw-semibold">Upload File Materi (PDF)</label>
                                    <input type="file" name="isi_materi" class="form-control" accept="application/pdf" required>
                                    <small class="text-muted">Hanya file PDF yang diperbolehkan (Maks. 10MB). File yang sama akan disalin ke semua kelas yang dipilih.</small>
                                </div>

                                <div class="card-footer text-end">
                                    <button type="submit" class="btn btn-primary me-2">Simpan Materi</button>
                                    <a href="{{ route('materi.index') }}" class="btn btn-light">Kembali</a>
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
    // Pilih semua / hapus semua mapel
    document.getElementById('pilihSemuaMapel').addEventListener('click', function() {
        document.querySelectorAll('.mapel-check').forEach(cb => {
            if (cb.closest('.mapel-item').style.display !== 'none') cb.checked = true;
        });
    });
    document.getElementById('hapusSemuaMapel').addEventListener('click', function() {
        document.querySelectorAll('.mapel-check').forEach(cb => cb.checked = false);
    });

    // Filter / search mapel
    document.getElementById('searchMapel').addEventListener('input', function() {
        const keyword = this.value.toLowerCase().trim();
        document.querySelectorAll('.mapel-group').forEach(group => {
            const nama = group.querySelector('strong').textContent.toLowerCase();
            group.style.display = nama.includes(keyword) ? '' : 'none';
        });
    });
</script>
@endsection
