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
                <li class="breadcrumb-item"><a href="javascript: void(0)">Nilai Quiz</a></li>
                <li class="breadcrumb-item" aria-current="page">Tabel Nilai Quiz</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Tabel Nilai Quiz</h2>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tabel Nilai Quiz</h5>
                <div>
                    <a href="{{ route('nilai-quiz.print', request()->query()) }}" target="_blank" class="btn btn-primary btn-sm"><i class="fas fa-print"></i> Cetak Laporan</a>
                </div>
            </div>
            <div class="card-body">
              <form action="{{ route('nilai-quiz.index') }}" method="GET" class="mb-4 pb-3 border-bottom">
                  <div class="row align-items-end">
                      <div class="col-md-3">
                          <label>Kelas</label>
                          <select name="kelas" class="form-control">
                              <option value="">Semua Kelas</option>
                              <option value="VII" {{ request('kelas') == 'VII' ? 'selected' : '' }}>Kelas VII</option>
                              <option value="VIII" {{ request('kelas') == 'VIII' ? 'selected' : '' }}>Kelas VIII</option>
                              <option value="IX" {{ request('kelas') == 'IX' ? 'selected' : '' }}>Kelas IX</option>
                          </select>
                      </div>
                      <div class="col-md-4">
                          <label>Mata Pelajaran</label>
                          <select name="mapel_id" class="form-control">
                              <option value="">Semua Mapel</option>
                              @foreach($mapels as $mapel)
                              <option value="{{ $mapel->id }}" {{ request('mapel_id') == $mapel->id ? 'selected' : '' }}>{{ $mapel->nama_mapel }} - Kelas {{ $mapel->kelas }}</option>
                              @endforeach
                          </select>
                      </div>
                      <div class="col-md-3">
                          <label>Waktu Pengerjaan</label>
                          <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                      </div>
                      <div class="col-md-2">
                          <button type="submit" class="btn btn-secondary w-100"><i class="fas fa-filter"></i> Filter</button>
                      </div>
                  </div>
              </form>
              <div class="dt-responsive table-responsive">
                <table id="simpletable" class="table table-striped table-bordered nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Siswa</th>
                      <th>Materi</th>
                      <th>Nilai</th>
                      <th>Waktu Dikerjakan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($nilais as $i => $item)
                    <tr>
                      <td>{{ $i+1 }}</td>
                      <td>{{ $item->user->name ?? 'Unknown' }}</td>
                      <td>{{ $item->materi->judul ?? 'Unknown' }}</td>
                      <td>{{ $item->nilai_quiz }}</td>
                      <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                      <td>
                        <form action="{{ route('nilai-quiz.destroy', $item->id) }}" method="POST" style="display:inline;" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
      $('#simpletable').DataTable();
    });
</script>
@endsection