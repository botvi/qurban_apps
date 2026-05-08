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
                                <li class="breadcrumb-item" aria-current="page">Form Tambah Materi</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Form Tambah Materi</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Form Tambah Materi</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('materi.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label">Mata Pelajaran</label>
                                    <select name="mapel_id" class="form-control" required>
                                        <option value="">Pilih Mata Pelajaran & Kelas</option>
                                        @foreach ($mapels as $mapel)
                                            <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }} - Kelas
                                                {{ $mapel->kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Bab</label>
                                    <input type="text" name="bab" class="form-control" placeholder="Bab" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Judul Materi</label>
                                    <input type="text" name="judul" class="form-control" placeholder="Judul Materi"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Deskripsi</label>
                                    <input type="text" name="deskripsi" class="form-control"
                                        placeholder="Deskripsi Singkat" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Link YouTube (Opsional)</label>
                                    <input type="url" name="link_youtube" class="form-control"
                                        placeholder="https://www.youtube.com/watch?v=...">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Upload File Materi (PDF)</label>
                                    <input type="file" name="isi_materi" class="form-control" accept="application/pdf"
                                        required>
                                    <small class="text-muted">Hanya file PDF yang diperbolehkan (Maks. 10MB)</small>
                                </div>
                                <div class="card-footer text-end">
                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                                    <a href="{{ route('materi.index') }}" class="btn btn-light">Kembali</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
