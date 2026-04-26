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
                <li class="breadcrumb-item" aria-current="page">Tabel Master Materi</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Tabel Master Materi</h2>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tabel Master Materi</h5>
                <a href="{{ route('materi.create') }}" class="btn btn-primary">Tambah Materi</a>
            </div>
          </div>
          
          @foreach($materis_grouped as $mapelName => $materis)
          <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">{{ $mapelName }}</h5>
            </div>
            <div class="card-body">
              <div class="dt-responsive table-responsive">
                <table class="table table-striped table-bordered nowrap simpletable">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Bab</th>
                      <th>Judul</th>
                      <th>Deskripsi</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($materis as $m => $item)
                    <tr>
                      <td>{{ $m+1 }}</td>
                      <td>{{ $item->bab }}</td>
                      <td>{{ $item->judul }}</td>
                      <td>{{ $item->deskripsi }}</td>
                      <td>
                        <a href="{{ route('materi.show', $item->id) }}" class="btn btn-sm btn-info">Detail</a>
                        <a href="{{ route('materi.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('materi.destroy', $item->id) }}" method="POST" style="display:inline;" class="delete-form">
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
          @endforeach
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
      $('.simpletable').DataTable();
    });
</script>
@endsection