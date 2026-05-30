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
                                <li class="breadcrumb-item"><a href="{{ route('quiz.index') }}">Master Quiz</a></li>
                                <li class="breadcrumb-item" aria-current="page">Form Edit Quiz</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Form Edit Quiz</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <form action="{{ route('quiz.update', $quiz->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card mb-3">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5>Materi Quiz</h5>
                                <small class="text-muted">
                                    Materi aktif sudah tercentang. Centang materi lain untuk <strong>menduplikasi</strong>
                                    quiz ke kelas tersebut.
                                </small>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">
                                        Pilih Materi / Kelas <span class="text-danger">*</span>
                                    </label>
                                    <p class="text-muted small mb-2">
                                        @if ($quiz->materi && $quiz->materi->mapel)
                                            <span class="badge bg-primary">{{ $quiz->materi->mapel->nama_mapel }} - Kelas
                                                {{ $quiz->materi->mapel->kelas }} — {{ $quiz->materi->bab }}
                                                ({{ $quiz->materi->judul }})</span>
                                            adalah materi yang sedang diedit.
                                        @endif
                                        Centang kelas lain dalam materi yang sama untuk <strong>menduplikasi</strong> quiz
                                        ini ke kelas tersebut sekaligus.
                                    </p>

                                    {{-- Tombol bantu --}}
                                    <div class="mb-2 d-flex gap-2 flex-wrap align-items-center">
                                        <input type="text" id="searchMateri" class="form-control"
                                            style="max-width:220px;" placeholder="🔍 Cari nama materi...">
                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                            id="pilihSemuaMateri">✔ Pilih Semua</button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary"
                                            id="hapusSemuaMateri">✖ Hapus Semua</button>
                                    </div>

                                    <div class="border rounded p-3" style="max-height:280px; overflow-y:auto;"
                                        id="materiCheckboxList">
                                        @php
                                            $materiGrouped = $materis->groupBy(function ($m) {
                                                return ($m->mapel ? $m->mapel->nama_mapel : '?') .
                                                    ' — ' .
                                                    $m->bab .
                                                    ' (' .
                                                    $m->judul .
                                                    ')';
                                            });
                                            $selectedIds = old('materi_ids', [$quiz->materi_id]);
                                        @endphp

                                        @foreach ($materiGrouped as $groupLabel => $items)
                                            <div class="materi-group mb-2">
                                                <strong class="text-primary small">{{ $groupLabel }}</strong>
                                                <div class="ps-2 mt-1 d-flex flex-wrap gap-3">
                                                    @foreach ($items as $materi)
                                                        <div class="form-check materi-item"
                                                            data-nama="{{ strtolower($groupLabel) }}">
                                                            <input class="form-check-input materi-check" type="checkbox"
                                                                name="materi_ids[]" value="{{ $materi->id }}"
                                                                id="materi_{{ $materi->id }}"
                                                                {{ in_array($materi->id, $selectedIds) ? 'checked' : '' }}>
                                                            <label class="form-check-label small"
                                                                for="materi_{{ $materi->id }}">
                                                                Kelas {{ $materi->mapel ? $materi->mapel->kelas : '-' }}
                                                                @if ($materi->id == $quiz->materi_id)
                                                                    <span class="badge bg-primary ms-1"
                                                                        style="font-size:10px;">Aktif</span>
                                                                @endif
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <hr class="my-1">
                                        @endforeach

                                        @if ($materis->isEmpty())
                                            <p class="text-muted">Belum ada materi. <a
                                                    href="{{ route('materi.create') }}">Tambah materi dulu</a>.</p>
                                        @endif
                                    </div>

                                    @error('materi_ids')
                                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div id="soal-container">
                            @php
                                $soals = is_array($quiz->soal) ? $quiz->soal : [];
                            @endphp
                            @if (count($soals) > 0)
                                @foreach ($soals as $index => $soal)
                                    <div class="card mb-3 soal-item">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5 class="soal-title">Soal {{ $index + 1 }}</h5>
                                            <button type="button" class="btn btn-sm btn-danger btn-remove-soal"
                                                style="display: {{ count($soals) > 1 ? 'block' : 'none' }};">Hapus
                                                Soal</button>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Gambar Pertanyaan (Opsional)</label>
                                                <input type="hidden" name="old_gambar_pertanyaan[]"
                                                    value="{{ $soal['gambar_pertanyaan'] ?? '' }}">
                                                @if (!empty($soal['gambar_pertanyaan']))
                                                    <div class="mb-2"><img src="{{ asset($soal['gambar_pertanyaan']) }}"
                                                            alt="Gambar" width="150"></div>
                                                @endif
                                                <input type="file" name="gambar_pertanyaan[]" class="form-control"
                                                    accept="image/*">
                                                <label class="form-label mt-2">Pertanyaan</label>
                                                <textarea name="pertanyaan[]" class="form-control" rows="3">{{ $soal['pertanyaan'] ?? '' }}</textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form-group mb-3">
                                                    <label class="form-label">Gambar Pilihan A (Opsional)</label>
                                                    <input type="hidden" name="old_gambar_a[]"
                                                        value="{{ $soal['gambar_a'] ?? '' }}">
                                                    @if (!empty($soal['gambar_a']))
                                                        <div class="mb-1"><img src="{{ asset($soal['gambar_a']) }}"
                                                                alt="Gambar A" width="100"></div>
                                                    @endif
                                                    <input type="file" name="gambar_a[]" class="form-control mb-1"
                                                        accept="image/*">
                                                    <label class="form-label mt-1">Pilihan A</label>
                                                    <input type="text" name="a[]" class="form-control"
                                                        value="{{ $soal['a'] ?? '' }}">
                                                </div>
                                                <div class="col-md-6 form-group mb-3">
                                                    <label class="form-label">Gambar Pilihan B (Opsional)</label>
                                                    <input type="hidden" name="old_gambar_b[]"
                                                        value="{{ $soal['gambar_b'] ?? '' }}">
                                                    @if (!empty($soal['gambar_b']))
                                                        <div class="mb-1"><img src="{{ asset($soal['gambar_b']) }}"
                                                                alt="Gambar B" width="100"></div>
                                                    @endif
                                                    <input type="file" name="gambar_b[]" class="form-control mb-1"
                                                        accept="image/*">
                                                    <label class="form-label mt-1">Pilihan B</label>
                                                    <input type="text" name="b[]" class="form-control"
                                                        value="{{ $soal['b'] ?? '' }}">
                                                </div>
                                                <div class="col-md-6 form-group mb-3">
                                                    <label class="form-label">Gambar Pilihan C (Opsional)</label>
                                                    <input type="hidden" name="old_gambar_c[]"
                                                        value="{{ $soal['gambar_c'] ?? '' }}">
                                                    @if (!empty($soal['gambar_c']))
                                                        <div class="mb-1"><img src="{{ asset($soal['gambar_c']) }}"
                                                                alt="Gambar C" width="100"></div>
                                                    @endif
                                                    <input type="file" name="gambar_c[]" class="form-control mb-1"
                                                        accept="image/*">
                                                    <label class="form-label mt-1">Pilihan C</label>
                                                    <input type="text" name="c[]" class="form-control"
                                                        value="{{ $soal['c'] ?? '' }}">
                                                </div>
                                                <div class="col-md-6 form-group mb-3">
                                                    <label class="form-label">Gambar Pilihan D (Opsional)</label>
                                                    <input type="hidden" name="old_gambar_d[]"
                                                        value="{{ $soal['gambar_d'] ?? '' }}">
                                                    @if (!empty($soal['gambar_d']))
                                                        <div class="mb-1"><img src="{{ asset($soal['gambar_d']) }}"
                                                                alt="Gambar D" width="100"></div>
                                                    @endif
                                                    <input type="file" name="gambar_d[]" class="form-control mb-1"
                                                        accept="image/*">
                                                    <label class="form-label mt-1">Pilihan D</label>
                                                    <input type="text" name="d[]" class="form-control"
                                                        value="{{ $soal['d'] ?? '' }}">
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label class="form-label">Kunci Jawaban</label>
                                                    <select name="jawaban[]" class="form-control" required>
                                                        <option value="a"
                                                            {{ isset($soal['jawaban']) && $soal['jawaban'] == 'a' ? 'selected' : '' }}>
                                                            A</option>
                                                        <option value="b"
                                                            {{ isset($soal['jawaban']) && $soal['jawaban'] == 'b' ? 'selected' : '' }}>
                                                            B</option>
                                                        <option value="c"
                                                            {{ isset($soal['jawaban']) && $soal['jawaban'] == 'c' ? 'selected' : '' }}>
                                                            C</option>
                                                        <option value="d"
                                                            {{ isset($soal['jawaban']) && $soal['jawaban'] == 'd' ? 'selected' : '' }}>
                                                            D</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <!-- Fallback if no questions exists yet -->
                                <div class="card mb-3 soal-item">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="soal-title">Soal 1</h5>
                                        <button type="button" class="btn btn-sm btn-danger btn-remove-soal"
                                            style="display: none;">Hapus Soal</button>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Gambar Pertanyaan (Opsional)</label>
                                            <input type="file" name="gambar_pertanyaan[]" class="form-control"
                                                accept="image/*">
                                            <label class="form-label mt-2">Pertanyaan</label>
                                            <textarea name="pertanyaan[]" class="form-control" rows="3" placeholder="Masukkan pertanyaan..."></textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group mb-3">
                                                <label class="form-label">Gambar Pilihan A (Opsional)</label>
                                                <input type="file" name="gambar_a[]" class="form-control mb-1"
                                                    accept="image/*">
                                                <label class="form-label mt-1">Pilihan A</label>
                                                <input type="text" name="a[]" class="form-control"
                                                    placeholder="Teks pilihan A">
                                            </div>
                                            <div class="col-md-6 form-group mb-3">
                                                <label class="form-label">Gambar Pilihan B (Opsional)</label>
                                                <input type="file" name="gambar_b[]" class="form-control mb-1"
                                                    accept="image/*">
                                                <label class="form-label mt-1">Pilihan B</label>
                                                <input type="text" name="b[]" class="form-control"
                                                    placeholder="Teks pilihan B">
                                            </div>
                                            <div class="col-md-6 form-group mb-3">
                                                <label class="form-label">Gambar Pilihan C (Opsional)</label>
                                                <input type="file" name="gambar_c[]" class="form-control mb-1"
                                                    accept="image/*">
                                                <label class="form-label mt-1">Pilihan C</label>
                                                <input type="text" name="c[]" class="form-control"
                                                    placeholder="Teks pilihan C">
                                            </div>
                                            <div class="col-md-6 form-group mb-3">
                                                <label class="form-label">Gambar Pilihan D (Opsional)</label>
                                                <input type="file" name="gambar_d[]" class="form-control mb-1"
                                                    accept="image/*">
                                                <label class="form-label mt-1">Pilihan D</label>
                                                <input type="text" name="d[]" class="form-control"
                                                    placeholder="Teks pilihan D">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label class="form-label">Kunci Jawaban</label>
                                                <select name="jawaban[]" class="form-control" required>
                                                    <option value="a">A</option>
                                                    <option value="b">B</option>
                                                    <option value="c">C</option>
                                                    <option value="d">D</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="mb-4">
                            <button type="button" class="btn btn-success" id="btn-add-soal">
                                <i class="ti ti-plus"></i> Tambah Soal Lain
                            </button>
                        </div>

                        <div class="card">
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary me-2">Update &amp; Duplikasi</button>
                                <a href="{{ route('quiz.index') }}" class="btn btn-light">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ===== Tambah / hapus soal =====
            const container = document.getElementById('soal-container');
            const btnAdd = document.getElementById('btn-add-soal');

            function updateSoalUI() {
                const items = container.querySelectorAll('.soal-item');
                items.forEach((item, index) => {
                    item.querySelector('.soal-title').textContent = 'Soal ' + (index + 1);
                    const btnRemove = item.querySelector('.btn-remove-soal');
                    if (items.length > 1) {
                        btnRemove.style.display = 'block';
                    } else {
                        btnRemove.style.display = 'none';
                    }
                });
            }

            btnAdd.addEventListener('click', function() {
                const items = container.querySelectorAll('.soal-item');
                const firstItem = items[0];
                const newItem = firstItem.cloneNode(true);

                // Clear inputs in cloned element
                const inputs = newItem.querySelectorAll('input, textarea');
                inputs.forEach(input => input.value = '');

                const selects = newItem.querySelectorAll('select');
                selects.forEach(select => select.selectedIndex = 0);

                container.appendChild(newItem);
                updateSoalUI();
            });

            container.addEventListener('click', function(e) {
                if (e.target.classList.contains('btn-remove-soal') || e.target.closest(
                        '.btn-remove-soal')) {
                    const btn = e.target.classList.contains('btn-remove-soal') ? e.target : e.target
                        .closest('.btn-remove-soal');
                    const item = btn.closest('.soal-item');
                    item.remove();
                    updateSoalUI();
                }
            });

            // ===== Pilih semua / hapus semua materi =====
            document.getElementById('pilihSemuaMateri').addEventListener('click', function() {
                document.querySelectorAll('.materi-check').forEach(cb => {
                    if (cb.closest('.materi-item').style.display !== 'none') cb.checked = true;
                });
            });
            document.getElementById('hapusSemuaMateri').addEventListener('click', function() {
                document.querySelectorAll('.materi-check').forEach(cb => cb.checked = false);
            });

            // ===== Filter / search materi =====
            document.getElementById('searchMateri').addEventListener('input', function() {
                const keyword = this.value.toLowerCase().trim();
                document.querySelectorAll('.materi-group').forEach(group => {
                    const nama = group.querySelector('strong').textContent.toLowerCase();
                    group.style.display = nama.includes(keyword) ? '' : 'none';
                });
            });
        });
    </script>
@endsection
