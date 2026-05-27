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
                <li class="breadcrumb-item" aria-current="page">Form Tambah Mapel</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Form Tambah Mata Pelajaran</h2>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5>Form Tambah Mapel</h5>
            </div>
            <div class="card-body">
              <form action="{{ route('mapel.store') }}" method="POST">
                @csrf
                <div class="form-group">
                  <label class="form-label">Nama Mata Pelajaran</label>
                  <input type="text" name="nama_mapel" class="form-control" placeholder="Mata Pelajaran (Contoh: Matematika)" required>
                </div>
                <div class="form-group">
                  <label class="form-label">Kelas</label>
                  <select name="kelas" class="form-control" required>
                      <optgroup label="Kelas VII">
                        <option value="VII A">VII A</option>
                        <option value="VII B">VII B</option>
                        <option value="VII C">VII C</option>
                      </optgroup>
                      <optgroup label="Kelas VIII">
                        <option value="VIII A">VIII A</option>
                        <option value="VIII B">VIII B</option>
                        <option value="VIII C">VIII C</option>
                      </optgroup>
                      <optgroup label="Kelas IX">
                        <option value="IX A">IX A</option>
                        <option value="IX B">IX B</option>
                        <option value="IX C">IX C</option>
                      </optgroup>
                  </select>
                </div>
                <div class="card-footer text-end">
                  <button type="submit" class="btn btn-primary me-2">Submit</button>
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
