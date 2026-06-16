<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MTs Nurul Islam Gunung Toar — Pilih Mata Pelajaran</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --green-dark: #022c22;
            --green-medium: #064e3b;
            --green: #059669;
            --green-bright: #10b981;
            --green-pale: #e6fbf2;
            --gold: #d97706;
            --gold-light: #f59e0b;
            --bg: #f4fbf7;
            --card: #ffffff;
            --border: #e2f5ec;
            --text: #0f172a;
            --muted: #64748b;
            --red: #ef4444;
            --primary-glow: rgba(16, 185, 129, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            background-image: 
                radial-gradient(at 0% 0%, rgba(16, 185, 129, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(245, 158, 11, 0.03) 0px, transparent 50%);
        }

        /* Topbar */
        .topbar {
            position: sticky;
            top: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 40px;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            z-index: 100;
            box-shadow: 0 4px 30px rgba(2, 44, 34, 0.02);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
        }

        .logo-icon {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, var(--green-medium), var(--green));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4em;
            box-shadow: 0 8px 16px rgba(6, 78, 59, 0.15);
        }

        .logo-text {
            display: flex;
            flex-direction: column;
        }

        .logo-text .name {
            font-family: 'Outfit', sans-serif;
            font-size: 0.95em;
            font-weight: 800;
            color: var(--green-dark);
            letter-spacing: 0.3px;
        }

        .logo-text .sub {
            font-size: 0.7em;
            color: var(--muted);
            font-weight: 500;
        }

        .nav-btns {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn-nav {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid var(--border);
            color: var(--muted);
            padding: 9px 18px;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.85em;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-nav:hover {
            border-color: var(--green);
            color: var(--green-dark);
            background: #fff;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.08);
        }

        .btn-out {
            border-color: rgba(239, 68, 68, 0.2);
            color: var(--red);
        }

        .btn-out:hover {
            background: var(--red);
            color: #fff;
            border-color: var(--red);
            box-shadow: 0 6px 15px rgba(239, 68, 68, 0.2);
        }

        /* Container */
        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 40px 24px;
        }

        /* Welcome Banner */
        .welcome-banner {
            position: relative;
            background: linear-gradient(135deg, var(--green-dark) 0%, var(--green-medium) 60%, var(--green) 100%);
            border-radius: 24px;
            padding: 40px 48px;
            color: white;
            overflow: hidden;
            box-shadow: 0 16px 36px rgba(2, 44, 34, 0.15);
            margin-bottom: 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .welcome-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.25) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .welcome-banner::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: 10%;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .welcome-text h1 {
            font-family: 'Outfit', sans-serif;
            font-size: clamp(1.6rem, 5vw, 2.5rem);
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 10px;
        }

        .welcome-text p {
            color: rgba(255, 255, 255, 0.8);
            font-size: clamp(0.85rem, 2.5vw, 1.05rem);
            font-weight: 400;
            max-width: 500px;
        }

        .welcome-illu {
            font-size: 5.5rem;
            opacity: 0.9;
            filter: drop-shadow(0 10px 15px rgba(0, 0, 0, 0.15));
            animation: float 4s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .alert {
            padding: 16px 24px;
            border-radius: 16px;
            margin-bottom: 30px;
            font-size: 0.92em;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
            animation: fadeIn 0.4s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .alert-err {
            background: rgba(239, 68, 68, 0.06);
            border: 1px solid rgba(239, 68, 68, 0.15);
            color: var(--red);
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.06);
            border: 1px solid rgba(16, 185, 129, 0.15);
            color: var(--green-medium);
        }

        /* Section Title */
        .section-title {
            font-family: 'Outfit', sans-serif;
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--green-dark);
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: var(--green);
        }

        /* Subjects Grid */
        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 24px;
        }

        /* Book Card */
        .book-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 32px 28px;
            text-decoration: none;
            color: var(--text);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 8px 20px rgba(2, 44, 34, 0.02);
        }

        .book-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--green), var(--green-bright));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .book-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 36px rgba(2, 44, 34, 0.07);
            border-color: rgba(16, 185, 129, 0.3);
        }

        .book-card:hover::before {
            transform: scaleX(1);
        }

        .card-header-main {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 24px;
        }

        .book-icon-box {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            background: var(--green-pale);
            color: var(--green);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            transition: all 0.3s;
        }

        .book-card:hover .book-icon-box {
            background: linear-gradient(135deg, var(--green), var(--green-bright));
            color: white;
            box-shadow: 0 8px 16px rgba(16, 185, 129, 0.2);
        }

        .book-badge-class {
            font-size: 0.72em;
            font-weight: 700;
            color: var(--green);
            background: rgba(16, 185, 129, 0.08);
            padding: 4px 12px;
            border-radius: 20px;
        }

        .book-title {
            font-family: 'Outfit', sans-serif;
            font-size: 1.15em;
            font-weight: 800;
            color: var(--green-dark);
            line-height: 1.3;
            margin-bottom: 12px;
            flex-grow: 1;
        }

        /* Progress Tracker */
        .progress-box {
            margin-top: auto;
            border-top: 1px solid var(--border);
            padding-top: 20px;
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.75em;
            font-weight: 700;
            color: var(--muted);
            margin-bottom: 8px;
        }

        .progress-bar-container {
            width: 100%;
            height: 7px;
            background: #f1f5f9;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 16px;
        }

        .progress-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--green), var(--green-bright));
            border-radius: 10px;
            transition: width 0.8s ease-out;
        }

        .action-link {
            font-size: 0.85em;
            font-weight: 700;
            color: var(--green);
            display: flex;
            align-items: center;
            gap: 6px;
            transition: gap 0.2s;
        }

        .book-card:hover .action-link {
            color: var(--green-medium);
            gap: 10px;
        }

        /* Empty State */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            background: var(--card);
            border: 1px dashed rgba(16, 185, 129, 0.2);
            border-radius: 24px;
            padding: 80px 40px;
            color: var(--muted);
            box-shadow: 0 4px 20px rgba(0,0,0,0.01);
        }

        .empty-state i {
            font-size: 4rem;
            color: rgba(16, 185, 129, 0.15);
            margin-bottom: 20px;
            display: block;
        }

        .empty-state p {
            font-size: 1.05rem;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .topbar {
                padding: 16px 20px;
            }
            .welcome-banner {
                padding: 30px 24px;
                flex-direction: column;
                text-align: center;
                gap: 20px;
            }
            .welcome-illu {
                display: none;
            }
            .books-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="topbar">
        <a href="{{ route('index') }}" class="logo">
            <div class="logo-icon">🕌</div>
            <div class="logo-text">
                <div class="name">MTs Nurul Islam Gunung Toar</div>
                <div class="sub">E-Learning Platform</div>
            </div>
        </a>
        <div class="nav-btns">
            <a href="{{ route('index') }}" class="btn-nav"><i class="fas fa-home"></i> Menu Utama</a>
            @if (Auth::check())
                <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display:none;">@csrf</form>
                <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn-nav btn-out"><i class="fas fa-power-off"></i> Keluar</a>
            @endif
        </div>
    </div>

    <div class="container">
        <!-- Welcome Banner -->
        <div class="welcome-banner">
            <div class="welcome-text">
                <h1>Assalamualaikum, {{ Auth::check() ? Auth::user()->name : 'Siswa' }}!</h1>
                <p>Selamat datang kembali di kelas digitalmu. Siap untuk menjelajahi dan menguasai materi baru hari ini?</p>
            </div>
            <div class="welcome-illu">📚</div>
        </div>

        @if (session('error'))
            <div class="alert alert-err"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif

        <div class="section-title">
            <i class="fas fa-bookmark"></i> Daftar Pelajaran Kamu
        </div>

        <div class="books-grid">
            @forelse($mapels as $mapel)
                @php
                    $totalMateri = $mapel->materis->count();
                    $completedMateri = 0;
                    if (Auth::check() && $totalMateri > 0) {
                        $materiIds = $mapel->materis->pluck('id');
                        $completedMateri = \App\Models\NilaiQuiz::where('user_id', Auth::id())
                            ->whereIn('materi_id', $materiIds)
                            ->count();
                    }
                    $progressPercent = $totalMateri > 0 ? round(($completedMateri / $totalMateri) * 100) : 0;

                    // Choose an illustrative icon based on key words in the course name
                    $iconClass = "fa-book";
                    $mapelLower = strtolower($mapel->nama_mapel);
                    if (str_contains($mapelLower, 'matematika') || str_contains($mapelLower, 'mtk')) {
                        $iconClass = "fa-calculator";
                    } elseif (str_contains($mapelLower, 'islam') || str_contains($mapelLower, 'agama') || str_contains($mapelLower, 'fiqih') || str_contains($mapelLower, 'al-qur') || str_contains($mapelLower, 'akidah') || str_contains($mapelLower, 'sjarah kebudayaan') || str_contains($mapelLower, 'ski')) {
                        $iconClass = "fa-mosque";
                    } elseif (str_contains($mapelLower, 'ipa') || str_contains($mapelLower, 'sains') || str_contains($mapelLower, 'fisika') || str_contains($mapelLower, 'biologi') || str_contains($mapelLower, 'kimia')) {
                        $iconClass = "fa-flask-vial";
                    } elseif (str_contains($mapelLower, 'inggris') || str_contains($mapelLower, 'bahasa') || str_contains($mapelLower, 'indonesia') || str_contains($mapelLower, 'arab')) {
                        $iconClass = "fa-language";
                    } elseif (str_contains($mapelLower, 'ips') || str_contains($mapelLower, 'sejarah') || str_contains($mapelLower, 'geografi')) {
                        $iconClass = "fa-globe-asia";
                    } elseif (str_contains($mapelLower, 'komputer') || str_contains($mapelLower, 'informatika') || str_contains($mapelLower, 'tik')) {
                        $iconClass = "fa-laptop-code";
                    } elseif (str_contains($mapelLower, 'penjas') || str_contains($mapelLower, 'olahraga') || str_contains($mapelLower, 'pjok')) {
                        $iconClass = "fa-running";
                    } elseif (str_contains($mapelLower, 'seni') || str_contains($mapelLower, 'prakarya')) {
                        $iconClass = "fa-palette";
                    }
                @endphp
                
                <a href="{{ route('user.materi.mapel', $mapel->id) }}" class="book-card">
                    <div class="card-header-main">
                        <div class="book-icon-box">
                            <i class="fas {{ $iconClass }}"></i>
                        </div>
                        <span class="book-badge-class">Kelas {{ $mapel->kelas }}</span>
                    </div>
                    
                    <div class="book-title">{{ $mapel->nama_mapel }}</div>
                    
                    <!-- Progress Tracker -->
                    <div class="progress-box">
                        <div class="progress-header">
                            <span>Progres Belajar</span>
                            <span>{{ $progressPercent }}%</span>
                        </div>
                        <div class="progress-bar-container">
                            <div class="progress-bar-fill" style="width: {{ $progressPercent }}%;"></div>
                        </div>
                        <div class="action-link">
                            <span>Mulai Belajar</span>
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                </a>
            @empty
                <div class="empty-state">
                    <i class="fas fa-box-open"></i>
                    <p>Mata pelajaran belum tersedia untuk kelas Anda saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</body>
</html>
