<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduVerse — Menu Utama</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600;700;900&family=Nunito:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg:       #050a18;
            --card:     #0d1526;
            --border:   #1a2d55;
            --neon-b:   #00c8ff;
            --neon-p:   #a855f7;
            --neon-g:   #00ff88;
            --neon-y:   #ffd700;
            --neon-r:   #ff4f7b;
            --text:     #e2e8f0;
            --muted:    #64748b;
        }

        * { margin:0; padding:0; box-sizing:border-box; }

        body {
            font-family: 'Nunito', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Animated background grid */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(0,200,255,0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0,200,255,0.05) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: gridMove 20s linear infinite;
            pointer-events: none;
        }

        @keyframes gridMove {
            from { transform: translateY(0); }
            to   { transform: translateY(50px); }
        }

        /* Glow orbs */
        .orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(100px);
            pointer-events: none;
            opacity: 0.15;
            animation: float 8s ease-in-out infinite;
        }
        .orb1 { width:400px;height:400px;background:var(--neon-b);top:-100px;left:-100px; animation-delay:0s; }
        .orb2 { width:350px;height:350px;background:var(--neon-p);bottom:-80px;right:-80px; animation-delay:3s; }
        .orb3 { width:250px;height:250px;background:var(--neon-g);top:40%;left:60%; animation-delay:6s; }

        @keyframes float {
            0%,100% { transform: translate(0,0); }
            50%      { transform: translate(20px, -20px); }
        }

        /* TOP BAR */
        .topbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 28px;
            background: rgba(5,10,24,0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            z-index: 100;
        }

        .logo {
            font-family: 'Orbitron', monospace;
            font-size: 1.3em;
            font-weight: 900;
            background: linear-gradient(90deg, var(--neon-b), var(--neon-p));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: 2px;
        }

        .topbar-right { display:flex; gap:10px; align-items:center; }

        .btn-out {
            background: transparent;
            border: 1px solid var(--neon-r);
            color: var(--neon-r);
            padding: 8px 18px;
            border-radius: 8px;
            font-family: 'Nunito', sans-serif;
            font-size: 0.9em;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-out:hover {
            background: var(--neon-r);
            color: #fff;
            box-shadow: 0 0 14px var(--neon-r);
        }

        /* HERO */
        .hero {
            text-align: center;
            margin-bottom: 40px;
            z-index: 1;
        }

        .hero h1 {
            font-family: 'Orbitron', monospace;
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 900;
            background: linear-gradient(135deg, var(--neon-b) 0%, var(--neon-p) 50%, var(--neon-g) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
            letter-spacing: 2px;
        }

        .hero p {
            color: var(--muted);
            font-size: 1.1em;
        }

        .greeting {
            font-size: 1.2em;
            color: var(--neon-b);
            font-weight: 700;
            margin-bottom: 6px;
        }

        /* MENU GRID */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            max-width: 700px;
            width: 90%;
            z-index: 1;
        }

        @media (max-width: 600px) {
            .menu-grid { grid-template-columns: repeat(2, 1fr); gap:14px; }
        }

        .menu-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 30px 15px;
            text-align: center;
            text-decoration: none;
            color: var(--text);
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .menu-card::before {
            content: '';
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 0.3s;
            border-radius: 20px;
        }

        .menu-card:hover { transform: translateY(-8px); }
        .menu-card:hover::before { opacity: 1; }

        .menu-card .icon {
            font-size: 2.6em;
            margin-bottom: 12px;
            display: block;
            filter: drop-shadow(0 0 8px currentColor);
        }

        .menu-card .label {
            font-family: 'Orbitron', monospace;
            font-size: 0.75em;
            font-weight: 700;
            letter-spacing: 1px;
        }

        /* Card variants */
        .mc-blue   { border-color: var(--neon-b); }
        .mc-blue .icon { color: var(--neon-b); }
        .mc-blue:hover { box-shadow: 0 0 30px rgba(0,200,255,0.3); border-color: var(--neon-b); background: rgba(0,200,255,0.07); }

        .mc-purple { border-color: var(--neon-p); }
        .mc-purple .icon { color: var(--neon-p); }
        .mc-purple:hover { box-shadow: 0 0 30px rgba(168,85,247,0.3); background: rgba(168,85,247,0.07); }

        .mc-red    { border-color: var(--neon-r); }
        .mc-red .icon { color: var(--neon-r); }
        .mc-red:hover { box-shadow: 0 0 30px rgba(255,79,123,0.3); background: rgba(255,79,123,0.07); }

        .mc-green  { border-color: var(--neon-g); }
        .mc-green .icon { color: var(--neon-g); }
        .mc-green:hover { box-shadow: 0 0 30px rgba(0,255,136,0.3); background: rgba(0,255,136,0.07); }

        .mc-yellow { border-color: var(--neon-y); }
        .mc-yellow .icon { color: var(--neon-y); }
        .mc-yellow:hover { box-shadow: 0 0 30px rgba(255,215,0,0.3); background: rgba(255,215,0,0.07); }
    </style>
</head>
<body>

<div class="orb orb1"></div>
<div class="orb orb2"></div>
<div class="orb orb3"></div>

<div class="topbar">
    <span class="logo">⬡ EDUVERSE</span>
    <div class="topbar-right">
        @if(Auth::check())
            <span style="color:var(--muted);font-size:0.9em;"><i class="fas fa-user-astronaut"></i> {{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display:none;">@csrf</form>
            <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn-out">
                <i class="fas fa-power-off"></i> Keluar
            </a>
        @else
            <a href="{{ route('login') }}" class="btn-out" style="border-color:var(--neon-b);color:var(--neon-b);">
                <i class="fas fa-sign-in-alt"></i> Masuk
            </a>
        @endif
    </div>
</div>

<div class="hero" style="margin-top:80px;">
    @if(Auth::check())
        <div class="greeting"><i class="fas fa-bolt"></i> Halo, {{ Auth::user()->name }}!</div>
    @endif
    <h1>EDUVERSE</h1>
    <p>Platform Belajar Interaktif Generasi Z</p>
</div>

<div class="menu-grid">
    <a href="{{ route('user.materi.index') }}" class="menu-card mc-blue">
        <span class="icon"><i class="fas fa-book-open"></i></span>
        <div class="label">Materi Belajar</div>
    </a>

    <a href="{{ route('user.ujian.index') }}" class="menu-card mc-purple">
        <span class="icon"><i class="fas fa-file-signature"></i></span>
        <div class="label">Ujian</div>
    </a>

    <a href="{{ route('user.nilaiquiz') }}" class="menu-card mc-red">
        <span class="icon"><i class="fas fa-trophy"></i></span>
        <div class="label">Papan Nilai</div>
    </a>

    <a href="{{ route('user.game') }}" class="menu-card mc-green">
        <span class="icon"><i class="fas fa-gamepad"></i></span>
        <div class="label">Mini Game</div>
    </a>

    <a href="{{ route('user.profil') }}" class="menu-card mc-yellow">
        <span class="icon"><i class="fas fa-user-astronaut"></i></span>
        <div class="label">Profil</div>
    </a>
</div>

</body>
</html>
