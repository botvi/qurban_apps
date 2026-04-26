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
                <li class="breadcrumb-item" aria-current="page">Form Tambah Quiz</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Form Tambah Quiz</h2>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-sm-12">
          <form action="{{ route('quiz.store') }}" method="POST">
            @csrf
            <div class="card mb-3">
              <div class="card-header">
                <h5>Materi Quiz</h5>
              </div>
              <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Pilih Materi</label>
                    <select name="materi_id" class="form-control" required>
                        <option value="">-- Pilih Materi --</option>
                        @foreach($materis as $materi)
                        <option value="{{ $materi->id }}">{{ $materi->mapel ? $materi->mapel->nama_mapel . ' - Kelas ' . $materi->mapel->kelas . ' - ' : '' }}{{ $materi->bab }} ({{ $materi->judul }})</option>
                        @endforeach
                    </select>
                </div>
              </div>
            </div>

            <div id="soal-container">
                <!-- Soal Item 1 -->
                <div class="card mb-3 soal-item">
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="soal-title">Soal 1</h5>
                    <button type="button" class="btn btn-sm btn-danger btn-remove-soal" style="display: none;">Hapus Soal</button>
                  </div>
                  <div class="card-body">
                    <div class="form-group mb-3">
                      <label class="form-label">Pertanyaan</label>
                      <textarea name="pertanyaan[]" class="form-control" rows="3" placeholder="Masukkan pertanyaan..." required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                          <label class="form-label">Pilihan A</label>
                          <input type="text" name="a[]" class="form-control" placeholder="Teks pilihan A" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                          <label class="form-label">Pilihan B</label>
                          <input type="text" name="b[]" class="form-control" placeholder="Teks pilihan B" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                          <label class="form-label">Pilihan C</label>
                          <input type="text" name="c[]" class="form-control" placeholder="Teks pilihan C" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                          <label class="form-label">Pilihan D</label>
                          <input type="text" name="d[]" class="form-control" placeholder="Teks pilihan D" required>
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
            </div>

            <div class="mb-4">
                <button type="button" class="btn btn-success" id="btn-add-soal">
                    <i class="ti ti-plus"></i> Tambah Soal Lain
                </button>
            </div>

            <div class="card">
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary me-2">Simpan Quiz</button>
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
    const container = document.getElementById('soal-container');
    const btnAdd = document.getElementById('btn-add-soal');

    function updateSoalUI() {
        const items = container.querySelectorAll('.soal-item');
        items.forEach((item, index) => {
            item.querySelector('.soal-title').textContent = 'Soal ' + (index + 1);
            const btnRemove = item.querySelector('.btn-remove-soal');
            if(items.length > 1) {
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
        if(e.target.classList.contains('btn-remove-soal') || e.target.closest('.btn-remove-soal')) {
            const btn = e.target.classList.contains('btn-remove-soal') ? e.target : e.target.closest('.btn-remove-soal');
            const item = btn.closest('.soal-item');
            item.remove();
            updateSoalUI();
        }
    });
});
</script>
@endsection