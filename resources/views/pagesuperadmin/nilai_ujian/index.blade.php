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
                <li class="breadcrumb-item"><a href="javascript: void(0)">Nilai Ujian</a></li>
                <li class="breadcrumb-item" aria-current="page">Tabel Nilai Ujian</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Tabel Nilai Ujian</h2>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tabel Nilai Ujian</h5>
            </div>
            <div class="card-body">
              <div class="dt-responsive table-responsive">
                <table id="simpletable" class="table table-striped table-bordered nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Siswa</th>
                      <th>Judul Ujian</th>
                      <th>Mapel</th>
                      <th>Kelas</th>
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
                      <td>{{ $item->ujian->judul ?? '-' }}</td>
                      <td>{{ $item->ujian->mapel->nama_mapel ?? '-' }}</td>
                      <td>{{ $item->ujian->mapel->kelas ?? '-' }}</td>
                      <td>{{ $item->nilai_ujian }}</td>
                      <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                      <td>
                        <form action="{{ route('nilai-ujian.destroy', $item->id) }}" method="POST" style="display:inline;" class="delete-form">
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
                    if (result.isConfirmed) form.submit();
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