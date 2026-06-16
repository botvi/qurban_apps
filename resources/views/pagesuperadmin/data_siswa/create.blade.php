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
                                <li class="breadcrumb-item" aria-current="page">Form Tambah Siswa</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Form Tambah Siswa</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-header">
                            <h5>Form Tambah Siswa</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('siswa.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">NISN</label>
                                        <input type="text" name="nisn" class="form-control" placeholder="NISN"
                                            required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input type="text" name="nama_lengkap" class="form-control"
                                            placeholder="Nama Lengkap" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">Kelas</label>
                                        <select name="kelas" class="form-control" required>
                                            <optgroup label="Kelas VII">
                                                <option value="VII1">VII1</option>
                                                <option value="VII2">VII2</option>
                                                <option value="VII3">VII3</option>
                                            </optgroup>
                                            <optgroup label="Kelas VIII">
                                                <option value="VIII1">VIII1</option>
                                                <option value="VIII2">VIII2</option>
                                                <option value="VIII3">VIII3</option>
                                            </optgroup>
                                            <optgroup label="Kelas IX">
                                                <option value="IX1">IX1</option>
                                                <option value="IX2">IX2</option>
                                                <option value="IX3">IX3</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">Alamat</label>
                                        <input type="text" name="alamat" class="form-control" placeholder="Alamat"
                                            required>
                                    </div>
                                </div>
                                <hr>
                                <h6>Akun Login</h6>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control" placeholder="Username"
                                            required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="Password"
                                            required>
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
