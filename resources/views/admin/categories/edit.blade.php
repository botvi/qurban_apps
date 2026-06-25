@extends('template-admin.layout')
@section('title', 'Edit Kategori')

@section('content')
<div class="pc-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Kategori Qurban</a></li>
                        <li class="breadcrumb-item active">Edit Kategori</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <h2 class="mb-0" style="color: #064e3b; font-weight: 800;"><i class="fa fa-edit me-1"></i> Edit Kategori Qurban</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Formulir Perubahan Kategori</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('categories.update', $category) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label class="form-label" for="kode_kategori">Kode Kategori</label>
                            <input type="text" name="kode_kategori" id="kode_kategori" class="form-control @error('kode_kategori') is-invalid @enderror" value="{{ old('kode_kategori', $category->kode_kategori) }}" placeholder="Contoh: KMB, SP-IND, SP-KEL" required>
                            @error('kode_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="nama_kategori">Nama Kategori</label>
                            <input type="text" name="nama_kategori" id="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror" value="{{ old('nama_kategori', $category->nama_kategori) }}" placeholder="Contoh: Kambing, Sapi Perorangan" required>
                            @error('nama_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="target_dana">Target Dana (Rp)</label>
                            <input type="number" name="target_dana" id="target_dana" class="form-control @error('target_dana') is-invalid @enderror" value="{{ old('target_dana', $category->target_dana) }}" placeholder="Contoh: 3500000" required min="0">
                            @error('target_dana')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="keterangan">Keterangan / Deskripsi</label>
                            <textarea name="keterangan" id="keterangan" rows="4" class="form-control @error('keterangan') is-invalid @enderror" placeholder="Keterangan kategori program qurban (opsional)">{{ old('keterangan', $category->keterangan) }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
