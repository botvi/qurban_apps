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
                <strong>Isi Materi:</strong>
                <div class="mt-2" style="border: 1px solid #ddd; padding: 20px; border-radius: 5px; background: #fff;">
                    {!! $materi->isi_materi !!}
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
