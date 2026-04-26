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
                <li class="breadcrumb-item"><a href="javascript: void(0)">Data Siswa</a></li>
                <li class="breadcrumb-item" aria-current="page">Form Edit Siswa</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Form Edit Siswa</h2>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-sm-8">
          <div class="card">
            <div class="card-header">
              <h5>Form Edit Siswa</h5>
            </div>
            <div class="card-body">
              <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="col-md-6 form-group">
                    <label class="form-label">NISN</label>
                    <input type="text" name="nisn" class="form-control" value="{{ $siswa->nisn }}" required>
                  </div>
                  <div class="col-md-6 form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" value="{{ $siswa->nama_lengkap }}" required>
                  </div>
                  <div class="col-md-6 form-group">
                    <label class="form-label">Kelas</label>
                    <select name="kelas" class="form-control" required>
                        <option value="VII" {{ $siswa->kelas == 'VII' ? 'selected' : '' }}>VII</option>
                        <option value="VIII" {{ $siswa->kelas == 'VIII' ? 'selected' : '' }}>VIII</option>
                        <option value="IX" {{ $siswa->kelas == 'IX' ? 'selected' : '' }}>IX</option>
                    </select>
                  </div>
                  <div class="col-md-6 form-group">
                    <label class="form-label">Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="{{ $siswa->alamat }}" required>
                  </div>
                </div>
                <hr>
                <h6>Akun Login</h6>
                <div class="row">
                  <div class="col-md-6 form-group">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="{{ $siswa->user->username ?? '' }}" required>
                  </div>
                  <div class="col-md-6 form-group">
                    <label class="form-label">Password (Kosongkan jika tidak ingin diubah)</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                  </div>
                </div>

                <div class="card-footer text-end mt-3">
                  <button type="submit" class="btn btn-primary me-2">Submit</button>
                  <a href="{{ route('siswa.index') }}" class="btn btn-light">Kembali</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection