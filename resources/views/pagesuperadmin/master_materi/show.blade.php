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
                <li class="breadcrumb-item"><a href="{{ route('materi.index') }}">Master Materi</a></li>
                <li class="breadcrumb-item" aria-current="page">Detail Materi</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Detail Materi</h2>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5>{{ $materi->judul }}</h5>
            </div>
            <div class="card-body">
              <div class="mb-3">
                <strong>Bab:</strong>
                <p>{{ $materi->bab }}</p>
              </div>
              <div class="mb-3">
                <strong>Deskripsi:</strong>
                <p>{{ $materi->deskripsi }}</p>
              </div>
              <div class="mb-3">
                <strong>Isi Materi (PDF):</strong>
                <div class="mt-2" style="border: 1px solid #ddd; padding: 10px; border-radius: 5px; background: #f8f9fa;">
                    @if($materi->isi_materi)
                        <iframe src="{{ asset('uploads/pdf/' . $materi->isi_materi) }}" width="100%" height="600px" style="border: none;"></iframe>
                        <div class="mt-2">
                            <a href="{{ asset('uploads/pdf/' . $materi->isi_materi) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-external-link-alt"></i> Buka di Tab Baru
                            </a>
                        </div>
                    @else
                        <p class="text-danger">File PDF tidak ditemukan.</p>
                    @endif
                </div>
              </div>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('materi.index') }}" class="btn btn-light">Kembali</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
