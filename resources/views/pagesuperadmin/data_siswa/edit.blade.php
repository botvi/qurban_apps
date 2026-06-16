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
                                        <input type="text" name="nisn" class="form-control"
                                            value="{{ $siswa->nisn }}" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input type="text" name="nama_lengkap" class="form-control"
                                            value="{{ $siswa->nama_lengkap }}" required>
                                    </div>
                                     <div class="col-md-6 form-group">
                                         <label class="form-label">Kelas</label>
                                         <select name="kelas" class="form-control" required>
                                             <optgroup label="Kelas VII">
                                                 <option value="VII1" {{ $siswa->kelas == 'VII1' ? 'selected' : '' }}>VII1</option>
                                                 <option value="VII2" {{ $siswa->kelas == 'VII2' ? 'selected' : '' }}>VII2</option>
                                                 <option value="VII3" {{ $siswa->kelas == 'VII3' ? 'selected' : '' }}>VII3</option>
                                             </optgroup>
                                             <optgroup label="Kelas VIII">
                                                 <option value="VIII1" {{ $siswa->kelas == 'VIII1' ? 'selected' : '' }}>VIII1</option>
                                                 <option value="VIII2" {{ $siswa->kelas == 'VIII2' ? 'selected' : '' }}>VIII2</option>
                                                 <option value="VIII3" {{ $siswa->kelas == 'VIII3' ? 'selected' : '' }}>VIII3</option>
                                             </optgroup>
                                             <optgroup label="Kelas IX">
                                                 <option value="IX1" {{ $siswa->kelas == 'IX1' ? 'selected' : '' }}>IX1</option>
                                                 <option value="IX2" {{ $siswa->kelas == 'IX2' ? 'selected' : '' }}>IX2</option>
                                                 <option value="IX3" {{ $siswa->kelas == 'IX3' ? 'selected' : '' }}>IX3</option>
                                             </optgroup>
                                         </select>
                                     </div>
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">Alamat</label>
                                        <input type="text" name="alamat" class="form-control"
                                            value="{{ $siswa->alamat }}" required>
                                    </div>
                                </div>
                                <hr>
                                <h6>Akun Login</h6>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control"
                                            value="{{ $siswa->user->username ?? '' }}" required>
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
