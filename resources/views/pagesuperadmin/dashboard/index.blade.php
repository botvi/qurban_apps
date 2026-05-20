@extends('template-admin.layout')

@section('content')
    <section class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Dashboard Statistik</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Data Master -->
                <div class="col-md-6 col-xl-3">
                    <div class="card bg-primary text-white position-relative">
                        <div class="card-body">
                            <h6 class="text-white">Total Siswa</h6>
                            <h2 class="text-white">{{ $totalSiswa }}</h2>
                            <i class="fas fa-users" style="font-size: 2.5rem; position: absolute; right: 20px; top: 20px; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card bg-info text-white position-relative">
                        <div class="card-body">
                            <h6 class="text-white">Total Mapel</h6>
                            <h2 class="text-white">{{ $totalMapel }}</h2>
                            <i class="fas fa-book" style="font-size: 2.5rem; position: absolute; right: 20px; top: 20px; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card bg-success text-white position-relative">
                        <div class="card-body">
                            <h6 class="text-white">Total Materi</h6>
                            <h2 class="text-white">{{ $totalMateri }}</h2>
                            <i class="fas fa-file-alt" style="font-size: 2.5rem; position: absolute; right: 20px; top: 20px; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card bg-warning text-white position-relative">
                        <div class="card-body">
                            <h6 class="text-white">Total Soal Kuis & Ujian</h6>
                            <h2 class="text-white">{{ $totalQuiz + $totalUjian }}</h2>
                            <i class="fas fa-edit" style="font-size: 2.5rem; position: absolute; right: 20px; top: 20px; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <!-- Statistik Kelulusan Quiz -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h5>Statistik Kelulusan Quiz</h5>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-6">
                                    <h3 class="text-success">{{ $lulusQuiz }}</h3>
                                    <p class="text-muted mb-0">Lulus (Skor &ge; 72)</p>
                                </div>
                                <div class="col-6 border-start border-left">
                                    <h3 class="text-danger">{{ $tidakLulusQuiz }}</h3>
                                    <p class="text-muted mb-0">Tidak Lulus (Skor &lt; 72)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistik Kelulusan Ujian -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h5>Statistik Kelulusan Ujian</h5>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-6">
                                    <h3 class="text-success">{{ $lulusUjian }}</h3>
                                    <p class="text-muted mb-0">Lulus (Skor &ge; 72)</p>
                                </div>
                                <div class="col-6 border-start border-left">
                                    <h3 class="text-danger">{{ $tidakLulusUjian }}</h3>
                                    <p class="text-muted mb-0">Tidak Lulus (Skor &lt; 72)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
