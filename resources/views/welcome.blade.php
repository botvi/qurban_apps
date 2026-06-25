<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MTs Nurul Islam Gunung Toar — E-Learning</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --green-dark: #064e3b;
            --green-mid: #065f46;
            --green-light: #059669;
            --green-bright: #10b981;
            --gold: #d97706;
            --gold-light: #f59e0b;
            --white: #ffffff;
            --text-dark: #111827;
            --text-muted: #6b7280;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #064e3b 0%, #065f46 40%, #047857 70%, #059669 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                repeating-linear-gradient(45deg, rgba(255,255,255,0.02) 0px, rgba(255,255,255,0.02) 1px, transparent 1px, transparent 40px),
                repeating-linear-gradient(-45deg, rgba(255,255,255,0.02) 0px, rgba(255,255,255,0.02) 1px, transparent 1px, transparent 40px);
            pointer-events: none;
        }

        .bg-orb {
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
            filter: blur(80px);
        }
        .orb1 { width: 500px; height: 500px; background: rgba(16,185,129,0.25); top: -200px; left: -150px; }
        .orb2 { width: 400px; height: 400px; background: rgba(217,119,6,0.2); bottom: -100px; right: -100px; }

        /* Top nav */
        .topnav {
            position: fixed;
            top: 0; left: 0; right: 0;
            padding: 16px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(6,78,59,0.6);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,0.1);
            z-index: 100;
        }
        .nav-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        .nav-logo {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2em;
        }
        .nav-title {
            font-size: 0.85em;
            font-weight: 700;
            color: rgba(255,255,255,0.95);
            line-height: 1.2;
        }
        .nav-sub {
            font-size: 0.65em;
            color: rgba(255,255,255,0.6);
            font-weight: 400;
        }
        .nav-actions {
            display: flex;
            gap: 12px;
            align-items: center;
        }
        .btn-nav {
            padding: 8px 20px;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.82em;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-nav-outline {
            border: 1.5px solid rgba(255,255,255,0.5);
            color: white;
            background: transparent;
        }
        .btn-nav-outline:hover {
            background: rgba(255,255,255,0.15);
            color: white;
            border-color: white;
        }
        .btn-nav-solid {
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            color: var(--green-dark);
            border: none;
            font-weight: 700;
        }
        .btn-nav-solid:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(217,119,6,0.4);
        }

        /* Hero */
        .hero {
            text-align: center;
            padding: 100px 24px 60px;
            position: relative;
            z-index: 1;
            max-width: 700px;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 50px;
            padding: 6px 18px;
            font-size: 0.78em;
            color: rgba(255,255,255,0.9);
            font-weight: 500;
            margin-bottom: 24px;
            backdrop-filter: blur(10px);
        }
        .hero-title {
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 800;
            color: white;
            line-height: 1.15;
            margin-bottom: 16px;
        }
        .hero-title .gold-text {
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hero-desc {
            font-size: 1em;
            color: rgba(255,255,255,0.75);
            line-height: 1.8;
            margin-bottom: 40px;
        }
        .hero-cta {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            color: var(--green-dark);
            text-decoration: none;
            padding: 14px 32px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.95em;
            transition: all 0.3s;
            box-shadow: 0 6px 24px rgba(217,119,6,0.4);
        }
        .hero-cta:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(217,119,6,0.5);
        }

        /* Features */
        .features {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            justify-content: center;
            max-width: 780px;
            padding: 0 20px 60px;
            position: relative;
            z-index: 1;
        }
        .feature-card {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 16px;
            padding: 24px 20px;
            text-align: center;
            flex: 1 1 160px;
            max-width: 200px;
            transition: all 0.3s;
        }
        .feature-card:hover {
            background: rgba(255,255,255,0.15);
            transform: translateY(-4px);
            border-color: rgba(255,255,255,0.3);
        }
        .feature-icon {
            font-size: 2em;
            margin-bottom: 12px;
            display: block;
        }
        .feature-label {
            font-size: 0.82em;
            font-weight: 600;
            color: white;
        }
        .feature-sub {
            font-size: 0.72em;
            color: rgba(255,255,255,0.6);
            margin-top: 4px;
        }

        .footer-text {
            position: fixed;
            bottom: 16px;
            font-size: 0.72em;
            color: rgba(255,255,255,0.4);
            z-index: 1;
        }

        @media (max-width: 640px) {
            .topnav { padding: 12px 20px; }
            .nav-title { font-size: 0.75em; }
            .hero { padding-top: 90px; }
        }
    </style>
</head>
<body>
    <div class="bg-orb orb1"></div>
    <div class="bg-orb orb2"></div>

    <!-- Top Nav -->
    <nav class="topnav">
        <a href="/" class="nav-brand" style="text-decoration:none;">
            <div class="nav-logo"><i class="fa-solid fa-mosque"></i></div>
            <div>
                <div class="nav-title">MTs Nurul Islam Gunung Toar</div>
                <div class="nav-sub">E-Learning Platform</div>
            </div>
        </a>
        <div class="nav-actions">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/home') }}" class="btn-nav btn-nav-solid">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-nav btn-nav-outline">Masuk</a>
                @endauth
            @endif
        </div>
    </nav>

    <!-- Hero -->
    <div class="hero">
        <div class="hero-badge">
            <i class="fas fa-graduation-cap" style="color:#fbbf24;"></i>
            Platform E-Learning Resmi MTs Nurul Islam
        </div>
        <h1 class="hero-title">
            Belajar Lebih <span class="gold-text">Cerdas</span>,<br>
            Raih Prestasi Terbaik
        </h1>
        <p class="hero-desc">
            Platform pembelajaran digital terpadu untuk siswa/i MTs Nurul Islam Gunung Toar.<br>
            Akses materi, quiz, ujian, dan pantau perkembangan belajarmu kapan saja.
        </p>
        @if (Route::has('login'))
            @guest
                <a href="{{ route('login') }}" class="hero-cta">
                    <i class="fas fa-sign-in-alt"></i> Mulai Belajar Sekarang
                </a>
            @endguest
        @endif
    </div>

    <!-- Features -->
    <div class="features">
        <div class="feature-card">
            <span class="feature-icon"><i class="fa-solid fa-book-open"></i></span>
            <div class="feature-label">Materi Digital</div>
            <div class="feature-sub">Video & modul lengkap</div>
        </div>
        <div class="feature-card">
            <span class="feature-icon"><i class="fa-solid fa-pen-nib"></i></span>
            <div class="feature-label">Quiz Interaktif</div>
            <div class="feature-sub">Latihan soal online</div>
        </div>
        <div class="feature-card">
            <span class="feature-icon"><i class="fa-solid fa-trophy"></i></span>
            <div class="feature-label">Ujian Online</div>
            <div class="feature-sub">Evaluasi belajar</div>
        </div>
        <div class="feature-card">
            <span class="feature-icon"><i class="fa-solid fa-gamepad"></i></span>
            <div class="feature-label">Mini Game</div>
            <div class="feature-sub">Belajar menyenangkan</div>
        </div>
    </div>

    <div class="footer-text">
        &copy; {{ date('Y') }} MTs Nurul Islam Gunung Toar — Kuantan Singingi, Riau
    </div>
</body>
</html>
