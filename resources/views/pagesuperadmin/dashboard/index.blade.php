@extends('template-admin.layout')

@section('style')
<style>
    .stat-card {
        border-radius: 18px !important;
        border: none !important;
        overflow: hidden;
        transition: transform 0.25s, box-shadow 0.25s;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.12) !important;
    }
    .stat-card .card-body { padding: 24px 22px; }
    .stat-card .stat-icon {
        width: 56px; height: 56px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5em;
        background: rgba(255,255,255,0.2);
        margin-bottom: 16px;
    }
    .stat-card .stat-num {
        font-size: 2.2em;
        font-weight: 800;
        color: white;
        line-height: 1;
        margin-bottom: 4px;
    }
    .stat-card .stat-label {
        font-size: 0.82em;
        color: rgba(255,255,255,0.8);
        font-weight: 500;
    }
    .sc-green { background: linear-gradient(135deg, #064e3b 0%, #059669 100%); box-shadow: 0 6px 20px rgba(6,78,59,0.3) !important; }
    .sc-blue { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); box-shadow: 0 6px 20px rgba(30,58,138,0.3) !important; }
    .sc-purple { background: linear-gradient(135deg, #4c1d95 0%, #8b5cf6 100%); box-shadow: 0 6px 20px rgba(76,29,149,0.3) !important; }
    .sc-gold { background: linear-gradient(135deg, #92400e 0%, #f59e0b 100%); box-shadow: 0 6px 20px rgba(146,64,14,0.3) !important; }

    .section-title {
        font-size: 1.4em;
        font-weight: 700;
        color: #064e3b;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .section-title::after {
        content: '';
        flex: 1;
        height: 2px;
        background: linear-gradient(90deg, #d1fae5, transparent);
        border-radius: 2px;
    }

    .stat-row {
        display: flex;
        gap: 0;
    }
    .stat-block {
        flex: 1;
        text-align: center;
        padding: 20px 16px;
    }
    .stat-block + .stat-block {
        border-left: 1px solid #d1fae5;
    }
    .stat-block .num {
        font-size: 2.4em;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 6px;
    }
    .stat-block .desc {
        font-size: 0.8em;
        color: #6b7280;
        font-weight: 500;
    }

    .welcome-banner {
        background: linear-gradient(135deg, #064e3b 0%, #059669 100%);
        border-radius: 18px;
        padding: 30px 32px;
        color: white;
        margin-bottom: 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
        position: relative;
        overflow: hidden;
    }
    .welcome-banner::before {
        content: '🕌';
        position: absolute;
        right: 30px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 6em;
        opacity: 0.08;
    }
    .welcome-banner h2 {
        font-size: 1.5em;
        font-weight: 800;
        margin-bottom: 4px;
        color: white;
    }
    .welcome-banner p {
        font-size: 0.85em;
        color: rgba(255,255,255,0.75);
        margin: 0;
    }
    .welcome-badge {
        background: linear-gradient(135deg, #d97706, #f59e0b);
        color: #064e3b;
        border-radius: 50px;
        padding: 8px 20px;
        font-size: 0.8em;
        font-weight: 700;
        white-space: nowrap;
    }
</style>
@endsection

@section('content')
    <section class="pc-container">
        <div class="pc-content">

            <!-- Welcome Banner -->
            <div class="welcome-banner">
                <div>
                    <h2>🎓 Dashboard Admin E-Learning</h2>
                    <p>MTs Nurul Islam Gunung Toar — Kuantan Singingi, Riau</p>
                </div>
                <div class="welcome-badge">📊 Statistik Real-time</div>
            </div>

            <!-- Stat Cards -->
            <div class="section-title"><i class="fas fa-chart-bar" style="color:#059669;"></i> Ringkasan Data</div>
            <div class="row g-3 mb-4">
                <div class="col-6 col-xl-3">
                    <div class="card stat-card sc-green">
                        <div class="card-body">
                            <div class="stat-icon">👥</div>
                            <div class="stat-num">{{ $totalSiswa }}</div>
                            <div class="stat-label">Total Siswa</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-xl-3">
                    <div class="card stat-card sc-blue">
                        <div class="card-body">
                            <div class="stat-icon">📚</div>
                            <div class="stat-num">{{ $totalMapel }}</div>
                            <div class="stat-label">Mata Pelajaran</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-xl-3">
                    <div class="card stat-card sc-purple">
                        <div class="card-body">
                            <div class="stat-icon">📄</div>
                            <div class="stat-num">{{ $totalMateri }}</div>
                            <div class="stat-label">Total Materi</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-xl-3">
                    <div class="card stat-card sc-gold">
                        <div class="card-body">
                            <div class="stat-icon">✍️</div>
                            <div class="stat-num">{{ $totalQuiz + $totalUjian }}</div>
                            <div class="stat-label">Soal Quiz & Ujian</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistik Kelulusan -->
            <div class="section-title"><i class="fas fa-chart-pie" style="color:#059669;"></i> Statistik Kelulusan</div>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="card" style="border-radius:16px; border:1px solid #d1fae5;">
                        <div class="card-header" style="padding:18px 22px;">
                            <h5 style="color:white; margin:0; font-size:0.95em; font-weight:700;">
                                <i class="fas fa-list-check me-2"></i>Statistik Kelulusan Quiz
                            </h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="stat-row">
                                <div class="stat-block">
                                    <div class="num" style="color:#059669;">{{ $lulusQuiz }}</div>
                                    <div class="desc">✅ Lulus (Skor ≥ 72)</div>
                                </div>
                                <div class="stat-block">
                                    <div class="num" style="color:#dc2626;">{{ $tidakLulusQuiz }}</div>
                                    <div class="desc">❌ Tidak Lulus (Skor &lt; 72)</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card" style="border-radius:16px; border:1px solid #d1fae5;">
                        <div class="card-header" style="padding:18px 22px;">
                            <h5 style="color:white; margin:0; font-size:0.95em; font-weight:700;">
                                <i class="fas fa-file-check me-2"></i>Statistik Kelulusan Ujian
                            </h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="stat-row">
                                <div class="stat-block">
                                    <div class="num" style="color:#059669;">{{ $lulusUjian }}</div>
                                    <div class="desc">✅ Lulus (Skor ≥ 72)</div>
                                </div>
                                <div class="stat-block">
                                    <div class="num" style="color:#dc2626;">{{ $tidakLulusUjian }}</div>
                                    <div class="desc">❌ Tidak Lulus (Skor &lt; 72)</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
