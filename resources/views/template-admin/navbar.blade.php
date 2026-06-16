<nav class="pc-sidebar" style="--pc-sidebar-bg:#064e3b; --pc-sidebar-color:#a7f3d0; --pc-sidebar-active-color:#fff;">
    <div class="navbar-wrapper">
        <div class="m-header" style="background: linear-gradient(135deg, #043927 0%, #064e3b 100%); border-bottom: 1px solid rgba(255,255,255,0.08); padding: 18px 20px;">
            <a href="/dashboard-superadmin" class="b-brand" style="display:flex;align-items:center;gap:12px; text-decoration:none;">
                <div style="width:40px;height:40px;background:linear-gradient(135deg,#d97706,#f59e0b);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.3em;box-shadow:0 3px 10px rgba(217,119,6,0.4);flex-shrink:0;">🕌</div>
                <div style="line-height:1.2;">
                    <div style="font-family:'Poppins',sans-serif;font-size:0.7em;font-weight:800;color:#f59e0b;letter-spacing:0.5px;">MTs NURUL ISLAM</div>
                    <div style="font-family:'Poppins',sans-serif;font-size:0.65em;font-weight:500;color:rgba(255,255,255,0.6);">Gunung Toar</div>
                </div>
            </a>
        </div>

        @if (Auth::user()->role == 'superadmin')
            <div class="navbar-content" style="background: linear-gradient(180deg, #064e3b 0%, #065f46 100%);">
                <ul class="pc-navbar">
                    {{-- Dashboard --}}
                    <li class="pc-item">
                        <a href="/dashboard-superadmin" class="pc-link" style="color:rgba(255,255,255,0.85);">
                            <span class="pc-micon"><i class="ti ti-layout-dashboard" style="color:#34d399;"></i></span>
                            <span class="pc-mtext" style="font-weight:500;">Dashboard</span>
                        </a>
                    </li>

                    {{-- Section label --}}
                    <li class="pc-item pc-caption" style="margin-top:8px;">
                        <label style="font-size:0.65em;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;color:#34d399;opacity:0.8;">Kelola Konten</label>
                    </li>

                    <li class="pc-item">
                        <a href="{{ route('mapel.index') }}" class="pc-link" style="color:rgba(255,255,255,0.85);">
                            <span class="pc-micon"><i class="ti ti-bookmark" style="color:#60a5fa;"></i></span>
                            <span class="pc-mtext" style="font-weight:500;">Mata Pelajaran</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('materi.index') }}" class="pc-link" style="color:rgba(255,255,255,0.85);">
                            <span class="pc-micon"><i class="ti ti-book" style="color:#34d399;"></i></span>
                            <span class="pc-mtext" style="font-weight:500;">Materi Belajar</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('quiz.index') }}" class="pc-link" style="color:rgba(255,255,255,0.85);">
                            <span class="pc-micon"><i class="ti ti-list-check" style="color:#a78bfa;"></i></span>
                            <span class="pc-mtext" style="font-weight:500;">Soal Quiz</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('ujian.index') }}" class="pc-link" style="color:rgba(255,255,255,0.85);">
                            <span class="pc-micon"><i class="ti ti-file-text" style="color:#fb923c;"></i></span>
                            <span class="pc-mtext" style="font-weight:500;">Soal Ujian</span>
                        </a>
                    </li>

                    {{-- Section label --}}
                    <li class="pc-item pc-caption" style="margin-top:8px;">
                        <label style="font-size:0.65em;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;color:#34d399;opacity:0.8;">Data Siswa</label>
                    </li>

                    <li class="pc-item">
                        <a href="{{ route('siswa.index') }}" class="pc-link" style="color:rgba(255,255,255,0.85);">
                            <span class="pc-micon"><i class="ti ti-users" style="color:#f472b6;"></i></span>
                            <span class="pc-mtext" style="font-weight:500;">Data Siswa</span>
                        </a>
                    </li>

                    {{-- Section label --}}
                    <li class="pc-item pc-caption" style="margin-top:8px;">
                        <label style="font-size:0.65em;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;color:#34d399;opacity:0.8;">Penilaian</label>
                    </li>

                    <li class="pc-item">
                        <a href="{{ route('nilai-quiz.index') }}" class="pc-link" style="color:rgba(255,255,255,0.85);">
                            <span class="pc-micon"><i class="ti ti-chart-bar" style="color:#fbbf24;"></i></span>
                            <span class="pc-mtext" style="font-weight:500;">Nilai Quiz</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('nilai-ujian.index') }}" class="pc-link" style="color:rgba(255,255,255,0.85);">
                            <span class="pc-micon"><i class="ti ti-chart-pie" style="color:#f87171;"></i></span>
                            <span class="pc-mtext" style="font-weight:500;">Nilai Ujian</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('nilai-akhir.input-nilai') }}" class="pc-link" style="color:rgba(255,255,255,0.85);">
                            <span class="pc-micon"><i class="ti ti-clipboard-list" style="color:#86efac;"></i></span>
                            <span class="pc-mtext" style="font-weight:500;">Input Absensi & Sikap</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('nilai-akhir.index') }}" class="pc-link" style="color:rgba(255,255,255,0.85);">
                            <span class="pc-micon"><i class="ti ti-trophy" style="color:#fcd34d;"></i></span>
                            <span class="pc-mtext" style="font-weight:500;">Nilai Akhir</span>
                        </a>
                    </li>
                </ul>
            </div>
        @endif
    </div>
</nav>

<style>
/* Override sidebar colors globally */
.pc-sidebar {
    background: linear-gradient(180deg, #064e3b 0%, #065f46 100%) !important;
}
.pc-sidebar .pc-link:hover {
    background: rgba(255,255,255,0.1) !important;
    border-radius: 10px;
    color: #fff !important;
}
.pc-sidebar .pc-navbar .pc-item.active > .pc-link {
    background: rgba(52,211,153,0.2) !important;
    border-radius: 10px;
    color: #fff !important;
    border-left: 3px solid #34d399;
}
.pc-sidebar .pc-caption label {
    color: rgba(52,211,153,0.8) !important;
}
.navbar-content {
    background: transparent !important;
}
</style>
