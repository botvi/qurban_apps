<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MTs Nurul Islam Gunung Toar — E-Learning</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --green-dark: #064e3b;
            --green-mid: #065f46;
            --green: #059669;
            --green-bright: #10b981;
            --green-pale: #d1fae5;
            --gold: #d97706;
            --gold-light: #f59e0b;
            --bg: #f0fdf4;
            --card: #ffffff;
            --border: #d1fae5;
            --text: #111827;
            --muted: #6b7280;
            --red: #dc2626;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Background subtle grid */
        body::before {
            content: '';
            position: fixed; inset: 0;
            background-image:
                linear-gradient(rgba(5,150,105,0.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(5,150,105,0.06) 1px, transparent 1px);
            background-size: 50px 50px;
            pointer-events: none;
        }

        /* TOPBAR */
        .topbar {
            position: sticky; top: 0;
            display: flex; justify-content: space-between; align-items: center;
            padding: 14px 28px;
            background: rgba(255,255,255,0.97);
            backdrop-filter: blur(12px);
            border-bottom: 2px solid var(--green-pale);
            z-index: 100;
            box-shadow: 0 2px 10px rgba(6,78,59,0.06);
        }
        .logo {
            display: flex; align-items: center; gap: 12px;
            text-decoration: none;
        }
        .logo-icon {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--green-dark), var(--green));
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2em;
            box-shadow: 0 3px 8px rgba(6,78,59,0.25);
        }
        .logo-text .name { font-size: 0.9em; font-weight: 700; color: var(--green-dark); line-height: 1.2; }
        .logo-text .sub  { font-size: 0.65em; color: var(--muted); font-weight: 400; }

        .topbar-right { display: flex; align-items: center; gap: 12px; }
        .user-pill {
            display: flex; align-items: center; gap: 8px;
            background: var(--bg); border: 1px solid var(--border);
            border-radius: 50px; padding: 5px 14px 5px 5px;
        }
        .user-avatar {
            width: 30px; height: 30px; border-radius: 50%;
            background: linear-gradient(135deg, var(--green-dark), var(--green));
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 0.75em; font-weight: 700;
        }
        .user-name { font-size: 0.82em; font-weight: 600; color: var(--text); }
        .btn-logout {
            border: 1.5px solid #fca5a5; color: var(--red);
            background: transparent;
            padding: 7px 16px; border-radius: 8px;
            font-family: 'Poppins', sans-serif; font-size: 0.8em; font-weight: 600;
            cursor: pointer; text-decoration: none; transition: all 0.2s;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-logout:hover { background: var(--red); color: white; border-color: var(--red); }

        /* MAIN */
        .main { flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 50px 24px 40px; position: relative; z-index: 1; }

        .welcome-badge {
            display: inline-flex; align-items: center; gap: 8px;
            background: linear-gradient(135deg, var(--green-pale), #fffbeb);
            border: 1px solid var(--border); border-radius: 50px;
            padding: 7px 20px; font-size: 0.8em; font-weight: 600;
            color: var(--green-dark); margin-bottom: 22px;
        }

        .hero-title {
            font-size: clamp(1.6rem, 4vw, 2.8rem); font-weight: 800;
            color: var(--green-dark); text-align: center;
            line-height: 1.2; margin-bottom: 10px;
        }
        .hero-title span {
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }
        .hero-sub { font-size: 0.95em; color: var(--muted); text-align: center; margin-bottom: 48px; }

        /* MENU GRID */
        .menu-grid {
            display: flex; flex-wrap: wrap; justify-content: center;
            gap: 20px; max-width: 760px; width: 95%;
        }

        .menu-card {
            background: var(--card); border: 1.5px solid var(--border);
            border-radius: 20px; padding: 30px 18px 24px;
            text-align: center; text-decoration: none; color: var(--text);
            transition: all 0.3s ease; position: relative; overflow: hidden;
            display: flex; flex-direction: column; align-items: center;
            min-height: 165px; flex: 1 1 175px; max-width: 210px;
            box-shadow: 0 2px 10px rgba(6,78,59,0.05);
        }
        .menu-card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0;
            height: 4px; border-radius: 20px 20px 0 0; transition: height 0.3s;
        }
        .menu-card:hover { transform: translateY(-8px); border-color: transparent; }
        .menu-card:hover::before { height: 6px; }

        .card-icon {
            width: 62px; height: 62px; border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.7em; margin-bottom: 14px; transition: transform 0.3s;
        }
        .menu-card:hover .card-icon { transform: scale(1.1) rotate(-3deg); }

        .card-label { font-size: 0.88em; font-weight: 700; color: var(--text); }
        .card-desc  { font-size: 0.72em; color: var(--muted); margin-top: 4px; }

        /* Card variants */
        .mc-green .card-icon { background: linear-gradient(135deg,#d1fae5,#a7f3d0); color: var(--green-dark); }
        .mc-green::before { background: linear-gradient(90deg, var(--green-dark), var(--green-bright)); }
        .mc-green:hover { box-shadow: 0 14px 35px rgba(6,78,59,0.18); }

        .mc-blue .card-icon { background: linear-gradient(135deg,#dbeafe,#bfdbfe); color: #1d4ed8; }
        .mc-blue::before { background: linear-gradient(90deg, #1d4ed8, #3b82f6); }
        .mc-blue:hover { box-shadow: 0 14px 35px rgba(29,78,216,0.15); }

        .mc-gold .card-icon { background: linear-gradient(135deg,#fef3c7,#fde68a); color: #92400e; }
        .mc-gold::before { background: linear-gradient(90deg, var(--gold), var(--gold-light)); }
        .mc-gold:hover { box-shadow: 0 14px 35px rgba(217,119,6,0.15); }

        .mc-red .card-icon { background: linear-gradient(135deg,#fee2e2,#fecaca); color: #b91c1c; }
        .mc-red::before { background: linear-gradient(90deg, #b91c1c, #ef4444); }
        .mc-red:hover { box-shadow: 0 14px 35px rgba(185,28,28,0.15); }

        footer {
            text-align: center; padding: 20px;
            font-size: 0.75em; color: var(--muted);
            border-top: 1px solid var(--border);
        }

        @media (max-width: 600px) {
            .topbar { padding: 10px 16px; }
            .logo-text .name { font-size: 0.75em; }
            .menu-card { flex: 1 1 140px; max-width: 45%; min-height: 150px; }
        }
    </style>
</head>
<body>
    <div class="topbar">
        <a href="/" class="logo">
            <div class="logo-icon">🕌</div>
            <div class="logo-text">
                <div class="name">MTs Nurul Islam Gunung Toar</div>
                <div class="sub">E-Learning Platform</div>
            </div>
        </a>
        <div class="topbar-right">
            @if (Auth::check())
                <div class="user-pill">
                    <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                    <div class="user-name">{{ Auth::user()->name }}</div>
                </div>
                <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display:none;">@csrf</form>
                <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn-logout">
                    <i class="fas fa-power-off"></i> Keluar
                </a>
            @else
                <a href="{{ route('login') }}" class="btn-logout" style="border-color:#86efac;color:var(--green-dark);">
                    <i class="fas fa-sign-in-alt"></i> Masuk
                </a>
            @endif
        </div>
    </div>

    <div class="main">
        @if (Auth::check())
            <div class="welcome-badge">
                <i class="fas fa-hand-sparkles" style="color:var(--gold);"></i>
                Halo, {{ Auth::user()->name }}! Semangat belajar hari ini 🌟
            </div>
        @endif

        <h1 class="hero-title">
            Selamat Datang di<br><span>E-Learning MTs Nurul Islam</span>
        </h1>
        <p class="hero-sub">Platform pembelajaran digital untuk siswa/i MTs Nurul Islam Gunung Toar</p>

        <div class="menu-grid">
            <a href="{{ route('user.materi.index') }}" class="menu-card mc-green">
                <div class="card-icon"><i class="fas fa-book-open"></i></div>
                <div class="card-label">Materi Belajar</div>
                <div class="card-desc">Pelajari modul pembelajaran</div>
            </a>

            <a href="{{ route('user.ujian.index') }}" class="menu-card mc-blue">
                <div class="card-icon"><i class="fas fa-file-signature"></i></div>
                <div class="card-label">Ujian</div>
                <div class="card-desc">Ikuti ujian & evaluasi</div>
            </a>

            <a href="{{ route('user.nilaiquiz') }}" class="menu-card mc-gold">
                <div class="card-icon"><i class="fas fa-trophy"></i></div>
                <div class="card-label">Papan Nilai</div>
                <div class="card-desc">Lihat hasil & prestasi</div>
            </a>

            <a href="{{ route('user.profil') }}" class="menu-card mc-red">
                <div class="card-icon"><i class="fas fa-user-circle"></i></div>
                <div class="card-label">Profil Saya</div>
                <div class="card-desc">Kelola akun & data diri</div>
            </a>
        </div>
    </div>

    <footer>&copy; {{ date('Y') }} MTs Nurul Islam Gunung Toar — E-Learning Platform</footer>
</body>
</html>
