<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMP Negeri 1 Benai — Pilih Mapel</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600;700;900&family=Nunito:wght@400;600;700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg: #f8fafc;
            --card: #ffffff;
            --border: #e2e8f0;
            --neon-b: #0ea5e9;
            --neon-p: #8b5cf6;
            --neon-g: #10b981;
            --neon-y: #eab308;
            --neon-r: #f43f5e;
            --text: #0f172a;
            --muted: #64748b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            padding: 0;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: linear-gradient(rgba(14, 165, 233, 0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(14, 165, 233, 0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: gridMove 20s linear infinite;
            pointer-events: none;
        }

        @keyframes gridMove {
            from {
                transform: translateY(0)
            }

            to {
                transform: translateY(50px)
            }
        }

        .orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(100px);
            pointer-events: none;
            opacity: .12;
            animation: float 8s ease-in-out infinite;
        }

        .orb1 {
            width: 350px;
            height: 350px;
            background: var(--neon-b);
            top: -80px;
            left: -80px;
        }

        .orb2 {
            width: 300px;
            height: 300px;
            background: var(--neon-p);
            bottom: -60px;
            right: -60px;
            animation-delay: 4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0)
            }

            50% {
                transform: translate(15px, -15px)
            }
        }

        .topbar {
            position: sticky;
            top: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 28px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            z-index: 100;
        }

        .logo {
            font-family: 'Orbitron', monospace;
            font-size: 1.2em;
            font-weight: 900;
            background: linear-gradient(90deg, var(--neon-b), var(--neon-p));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: 2px;
        }

        .nav-btns {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .btn-nav {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--muted);
            padding: 8px 16px;
            border-radius: 8px;
            font-family: 'Nunito', sans-serif;
            font-size: 0.88em;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: all .2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-nav:hover {
            border-color: var(--neon-b);
            color: var(--neon-b);
        }

        .btn-out {
            border-color: var(--neon-r);
            color: var(--neon-r);
        }

        .btn-out:hover {
            background: var(--neon-r);
            color: #fff;
            box-shadow: 0 0 14px var(--neon-r);
        }

        .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .page-header h1 {
            font-family: 'Orbitron', monospace;
            font-size: clamp(1.5rem, 4vw, 2.5rem);
            font-weight: 900;
            background: linear-gradient(135deg, var(--neon-b), var(--neon-p));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 8px;
        }

        .page-header p {
            color: var(--muted);
            font-size: 1em;
        }

        .alert {
            background: rgba(255, 79, 123, 0.1);
            border: 1px solid var(--neon-r);
            color: var(--neon-r);
            padding: 12px 24px;
            border-radius: 12px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 700;
        }

        .alert-success {
            background: rgba(0, 255, 136, 0.1);
            border-color: var(--neon-g);
            color: var(--neon-g);
        }

        .books-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 24px;
        }

        .book-card {
            width: 180px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 28px 16px;
            text-align: center;
            text-decoration: none;
            color: var(--text);
            transition: all .3s;
            position: relative;
            overflow: hidden;
        }

        .book-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--neon-b), var(--neon-p));
            opacity: 0;
            transition: opacity .3s;
        }

        .book-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 0 30px rgba(0, 200, 255, 0.2);
            border-color: var(--neon-b);
        }

        .book-card:hover::after {
            opacity: 1;
        }

        .book-card .book-icon {
            font-size: 2.5em;
            margin-bottom: 14px;
            display: block;
        }

        .book-card .book-title {
            font-family: 'Orbitron', monospace;
            font-size: 0.75em;
            font-weight: 700;
            letter-spacing: 1px;
            line-height: 1.4;
            background: linear-gradient(135deg, var(--neon-b), var(--neon-p));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .book-card .book-sub {
            margin-top: 8px;
            font-size: 0.78em;
            color: var(--muted);
            background: rgba(0, 200, 255, 0.08);
            border: 1px solid rgba(0, 200, 255, 0.15);
            padding: 3px 10px;
            border-radius: 20px;
            display: inline-block;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--muted);
        }

        .empty-state i {
            font-size: 4rem;
            color: var(--border);
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="orb orb1"></div>
    <div class="orb orb2"></div>

    <div class="topbar">
        <span class="logo">⬡ SMP NEGERI 1 BENAI</span>
        <div class="nav-btns">
            <a href="{{ route('index') }}" class="btn-nav"><i class="fas fa-home"></i> Menu</a>
            @if (Auth::check())
                <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display:none;">@csrf</form>
                <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                    class="btn-nav btn-out"><i class="fas fa-power-off"></i> Keluar</a>
            @endif
        </div>
    </div>

    <div class="container">
        <div class="page-header">
            <h1><i class="fas fa-satellite-dish"></i> Pilih Mata Pelajaran</h1>
            <p>Pilih pelajaran yang ingin kamu pelajari hari ini!</p>
        </div>

        @if (session('error'))
            <div class="alert"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif

        <div class="books-grid">
            @forelse($mapels as $mapel)
                <a href="{{ route('user.materi.mapel', $mapel->id) }}" class="book-card">
                    <span class="book-icon"><i class="fas fa-atom"></i></span>
                    <div class="book-title">{{ $mapel->nama_mapel }}</div>
                    <div class="book-sub">Kelas {{ $mapel->kelas }}</div>
                </a>
            @empty
                <div class="empty-state"><i class="fas fa-satellite"></i>
                    <p>Belum ada mata pelajaran tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
</body>

</html>
