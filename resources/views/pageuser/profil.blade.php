<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduVerse — Profil</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600;700;900&family=Nunito:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root{--bg:#050a18;--card:#0d1526;--border:#1a2d55;--neon-b:#00c8ff;--neon-p:#a855f7;--neon-g:#00ff88;--neon-y:#ffd700;--neon-r:#ff4f7b;--text:#e2e8f0;--muted:#64748b;}
        *{margin:0;padding:0;box-sizing:border-box;}
        body{font-family:'Nunito',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;display:flex;flex-direction:column;align-items:center;justify-content:center;position:relative;}
        body::before{content:'';position:fixed;inset:0;background-image:linear-gradient(rgba(0,200,255,0.04) 1px,transparent 1px),linear-gradient(90deg,rgba(0,200,255,0.04) 1px,transparent 1px);background-size:50px 50px;animation:gridMove 20s linear infinite;pointer-events:none;}
        @keyframes gridMove{from{transform:translateY(0)}to{transform:translateY(50px)}}
        .orb{position:fixed;border-radius:50%;filter:blur(100px);pointer-events:none;opacity:.12;animation:float 8s ease-in-out infinite;}
        .orb1{width:350px;height:350px;background:var(--neon-b);top:-80px;left:-80px;}
        .orb2{width:300px;height:300px;background:var(--neon-y);bottom:-60px;right:-60px;animation-delay:4s;}
        @keyframes float{0%,100%{transform:translate(0,0)}50%{transform:translate(15px,-15px)}}

        .topbar{position:fixed;top:0;left:0;right:0;display:flex;justify-content:space-between;align-items:center;padding:14px 28px;background:rgba(5,10,24,0.88);backdrop-filter:blur(12px);border-bottom:1px solid var(--border);z-index:100;}
        .logo{font-family:'Orbitron',monospace;font-size:1.2em;font-weight:900;background:linear-gradient(90deg,var(--neon-b),var(--neon-p));-webkit-background-clip:text;-webkit-text-fill-color:transparent;letter-spacing:2px;}
        .btn-nav{background:transparent;border:1px solid var(--border);color:var(--muted);padding:8px 16px;border-radius:8px;font-family:'Nunito',sans-serif;font-size:0.88em;font-weight:700;cursor:pointer;text-decoration:none;transition:all .2s;display:inline-flex;align-items:center;gap:6px;}
        .btn-nav:hover{border-color:var(--neon-b);color:var(--neon-b);}

        .profile-card{
            background:var(--card);
            border:1px solid var(--border);
            border-radius:24px;
            padding:40px 36px;
            width:90%;max-width:480px;
            text-align:center;
            position:relative;z-index:1;
            animation:bounceIn .6s cubic-bezier(0.175,0.885,0.32,1.275);
            box-shadow:0 0 40px rgba(0,200,255,0.1);
            margin-top:70px;
        }
        @keyframes bounceIn{0%{transform:scale(0.85);opacity:0}100%{transform:scale(1);opacity:1}}

        .avatar{
            width:100px;height:100px;border-radius:50%;
            background:linear-gradient(135deg,var(--neon-b),var(--neon-p));
            margin:0 auto 20px;
            display:flex;justify-content:center;align-items:center;
            font-size:3em;color:#fff;
            box-shadow:0 0 30px rgba(0,200,255,0.4);
        }

        .profile-name{font-family:'Orbitron',monospace;font-size:1.4em;font-weight:900;background:linear-gradient(135deg,var(--neon-b),var(--neon-p));-webkit-background-clip:text;-webkit-text-fill-color:transparent;margin-bottom:4px;}
        .profile-email{color:var(--muted);font-size:0.9em;margin-bottom:24px;}

        .divider{border:none;border-top:1px solid var(--border);margin:20px 0;}

        .info-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px;text-align:left;}

        .info-box{background:rgba(255,255,255,0.03);border:1px solid var(--border);border-radius:14px;padding:14px 16px;}
        .info-box.full{grid-column:span 2;}
        .info-label{font-size:0.7em;color:var(--neon-b);font-weight:700;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;display:flex;align-items:center;gap:5px;}
        .info-value{font-family:'Orbitron',monospace;font-size:1em;font-weight:700;color:var(--text);}
    </style>
</head>
<body>
<div class="orb orb1"></div><div class="orb orb2"></div>

<div class="topbar">
    <span class="logo">⬡ EDUVERSE</span>
    <a href="{{ route('index') }}" class="btn-nav"><i class="fas fa-arrow-left"></i> Menu Utama</a>
</div>

<div class="profile-card">
    <div class="avatar"><i class="fas fa-user-astronaut"></i></div>
    <div class="profile-name">{{ $user->name ?? 'Pemain Misterius' }}</div>
    <div class="profile-email"><i class="fas fa-envelope"></i> {{ $user->email ?? '-' }}</div>
    <hr class="divider">
    <div class="info-grid">
        <div class="info-box">
            <div class="info-label"><i class="fas fa-id-card"></i> NISN</div>
            <div class="info-value">{{ $siswa->nisn ?? '-' }}</div>
        </div>
        <div class="info-box">
            <div class="info-label"><i class="fas fa-school"></i> Kelas</div>
            <div class="info-value">{{ $siswa->kelas ?? '-' }}</div>
        </div>
        <div class="info-box full">
            <div class="info-label"><i class="fas fa-map-marker-alt"></i> Alamat</div>
            <div class="info-value" style="font-size:0.85em;">{{ $siswa->alamat ?? '-' }}</div>
        </div>
    </div>
</div>
</body>
</html>
