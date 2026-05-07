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
                <li class="breadcrumb-item"><a href="{{ route('ujian.index') }}">Master Ujian</a></li>
                <li class="breadcrumb-item" aria-current="page">Form Edit Ujian</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Form Edit Ujian</h2>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-sm-12">
          <form action="{{ route('ujian.update', $ujian->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card mb-3">
              <div class="card-header">
                <h5>Info Ujian</h5>
              </div>
              <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label">Judul Ujian</label>
                    <input type="text" name="judul" class="form-control" value="{{ $ujian->judul }}" required>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Mapel / Kelas</label>
                    <select name="mapel_id" class="form-control" required>
                        <option value="">-- Pilih Mapel --</option>
                        @foreach($mapels as $mapel)
                        <option value="{{ $mapel->id }}" {{ $ujian->mapel_id == $mapel->id ? 'selected' : '' }}>
                            {{ $mapel->nama_mapel }} - Kelas {{ $mapel->kelas }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Status Ujian</label>
                    <select name="status" class="form-control" required>
                        <option value="belum dimulai" {{ $ujian->status == 'belum dimulai' ? 'selected' : '' }}>Belum Dimulai</option>
                        <option value="dimulai" {{ $ujian->status == 'dimulai' ? 'selected' : '' }}>Dimulai</option>
                    </select>
                </div>
              </div>
            </div>

            <div id="soal-container">
                @php $soals = is_array($ujian->soal) ? $ujian->soal : []; @endphp
                @if(count($soals) > 0)
                    @foreach($soals as $index => $soal)
                    <div class="card mb-3 soal-item">
                      <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="soal-title">Soal {{ $index + 1 }}</h5>
                        <button type="button" class="btn btn-sm btn-danger btn-remove-soal" style="display: {{ count($soals) > 1 ? 'block' : 'none' }};">Hapus Soal</button>
                      </div>
                      <div class="card-body">
                        <div class="form-group mb-3">
                          <label class="form-label">Gambar Pertanyaan (Opsional)</label>
                          <input type="hidden" name="old_gambar_pertanyaan[]" value="{{ $soal['gambar_pertanyaan'] ?? '' }}">
                          @if(!empty($soal['gambar_pertanyaan']))
                              <div class="mb-2"><img src="{{ asset($soal['gambar_pertanyaan']) }}" alt="Gambar" width="150"></div>
                          @endif
                          <input type="file" name="gambar_pertanyaan[]" class="form-control" accept="image/*">
                          <label class="form-label mt-2">Pertanyaan</label>
                          <textarea name="pertanyaan[]" class="form-control" rows="3">{{ $soal['pertanyaan'] ?? '' }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                              <label class="form-label">Gambar Pilihan A (Opsional)</label>
                              <input type="hidden" name="old_gambar_a[]" value="{{ $soal['gambar_a'] ?? '' }}">
                              @if(!empty($soal['gambar_a']))
                                  <div class="mb-1"><img src="{{ asset($soal['gambar_a']) }}" alt="Gambar A" width="100"></div>
                              @endif
                              <input type="file" name="gambar_a[]" class="form-control mb-1" accept="image/*">
                              <label class="form-label mt-1">Pilihan A</label>
                              <input type="text" name="a[]" class="form-control" value="{{ $soal['a'] ?? '' }}">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                              <label class="form-label">Gambar Pilihan B (Opsional)</label>
                              <input type="hidden" name="old_gambar_b[]" value="{{ $soal['gambar_b'] ?? '' }}">
                              @if(!empty($soal['gambar_b']))
                                  <div class="mb-1"><img src="{{ asset($soal['gambar_b']) }}" alt="Gambar B" width="100"></div>
                              @endif
                              <input type="file" name="gambar_b[]" class="form-control mb-1" accept="image/*">
                              <label class="form-label mt-1">Pilihan B</label>
                              <input type="text" name="b[]" class="form-control" value="{{ $soal['b'] ?? '' }}">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                              <label class="form-label">Gambar Pilihan C (Opsional)</label>
                              <input type="hidden" name="old_gambar_c[]" value="{{ $soal['gambar_c'] ?? '' }}">
                              @if(!empty($soal['gambar_c']))
                                  <div class="mb-1"><img src="{{ asset($soal['gambar_c']) }}" alt="Gambar C" width="100"></div>
                              @endif
                              <input type="file" name="gambar_c[]" class="form-control mb-1" accept="image/*">
                              <label class="form-label mt-1">Pilihan C</label>
                              <input type="text" name="c[]" class="form-control" value="{{ $soal['c'] ?? '' }}">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                              <label class="form-label">Gambar Pilihan D (Opsional)</label>
                              <input type="hidden" name="old_gambar_d[]" value="{{ $soal['gambar_d'] ?? '' }}">
                              @if(!empty($soal['gambar_d']))
                                  <div class="mb-1"><img src="{{ asset($soal['gambar_d']) }}" alt="Gambar D" width="100"></div>
                              @endif
                              <input type="file" name="gambar_d[]" class="form-control mb-1" accept="image/*">
                              <label class="form-label mt-1">Pilihan D</label>
                              <input type="text" name="d[]" class="form-control" value="{{ $soal['d'] ?? '' }}">
                            </div>
                            <div class="col-md-12 form-group">
                              <label class="form-label">Kunci Jawaban</label>
                              <select name="jawaban[]" class="form-control" required>
                                  <option value="a" {{ (isset($soal['jawaban']) && $soal['jawaban'] == 'a') ? 'selected' : '' }}>A</option>
                                  <option value="b" {{ (isset($soal['jawaban']) && $soal['jawaban'] == 'b') ? 'selected' : '' }}>B</option>
                                  <option value="c" {{ (isset($soal['jawaban']) && $soal['jawaban'] == 'c') ? 'selected' : '' }}>C</option>
                                  <option value="d" {{ (isset($soal['jawaban']) && $soal['jawaban'] == 'd') ? 'selected' : '' }}>D</option>
                              </select>
                            </div>
                        </div>
                      </div>
                    </div>
                    @endforeach
                @else
                    <div class="card mb-3 soal-item">
                      <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="soal-title">Soal 1</h5>
                        <button type="button" class="btn btn-sm btn-danger btn-remove-soal" style="display: none;">Hapus Soal</button>
                      </div>
                      <div class="card-body">
                        <div class="form-group mb-3">
                          <label class="form-label">Gambar Pertanyaan (Opsional)</label>
                          <input type="file" name="gambar_pertanyaan[]" class="form-control" accept="image/*">
                          <label class="form-label mt-2">Pertanyaan</label>
                          <textarea name="pertanyaan[]" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                              <label class="form-label">Gambar Pilihan A (Opsional)</label>
                              <input type="file" name="gambar_a[]" class="form-control mb-1" accept="image/*">
                              <label class="form-label mt-1">Pilihan A</label>
                              <input type="text" name="a[]" class="form-control">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                              <label class="form-label">Gambar Pilihan B (Opsional)</label>
                              <input type="file" name="gambar_b[]" class="form-control mb-1" accept="image/*">
                              <label class="form-label mt-1">Pilihan B</label>
                              <input type="text" name="b[]" class="form-control">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                              <label class="form-label">Gambar Pilihan C (Opsional)</label>
                              <input type="file" name="gambar_c[]" class="form-control mb-1" accept="image/*">
                              <label class="form-label mt-1">Pilihan C</label>
                              <input type="text" name="c[]" class="form-control">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                              <label class="form-label">Gambar Pilihan D (Opsional)</label>
                              <input type="file" name="gambar_d[]" class="form-control mb-1" accept="image/*">
                              <label class="form-label mt-1">Pilihan D</label>
                              <input type="text" name="d[]" class="form-control">
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
                    <button type="submit" class="btn btn-primary me-2">Simpan Perubahan Ujian</button>
                    <a href="{{ route('ujian.index') }}" class="btn btn-light">Kembali</a>
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
    const container = document.getElementById('soal-container');
    const btnAdd = document.getElementById('btn-add-soal');

    function updateSoalUI() {
        const items = container.querySelectorAll('.soal-item');
        items.forEach((item, index) => {
            item.querySelector('.soal-title').textContent = 'Soal ' + (index + 1);
            item.querySelector('.btn-remove-soal').style.display = items.length > 1 ? 'block' : 'none';
        });
    }

    btnAdd.addEventListener('click', function() {
        const firstItem = container.querySelectorAll('.soal-item')[0];
        const newItem = firstItem.cloneNode(true);
        newItem.querySelectorAll('input, textarea').forEach(el => el.value = '');
        newItem.querySelectorAll('select').forEach(el => el.selectedIndex = 0);
        container.appendChild(newItem);
        updateSoalUI();
    });

    container.addEventListener('click', function(e) {
        const btn = e.target.closest('.btn-remove-soal');
        if (btn) {
            btn.closest('.soal-item').remove();
            updateSoalUI();
        }
    });
});
</script>
@endsection