<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMP Negeri 1 Benai — Daftar Ujian</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600;700;900&family=Nunito:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root{--bg:#050a18;--card:#0d1526;--border:#1a2d55;--neon-b:#00c8ff;--neon-p:#a855f7;--neon-g:#00ff88;--neon-y:#ffd700;--neon-r:#ff4f7b;--text:#e2e8f0;--muted:#64748b;}
        *{margin:0;padding:0;box-sizing:border-box;}
        body{font-family:'Nunito',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;}
        body::before{content:'';position:fixed;inset:0;background-image:linear-gradient(rgba(168,85,247,0.04) 1px,transparent 1px),linear-gradient(90deg,rgba(168,85,247,0.04) 1px,transparent 1px);background-size:50px 50px;animation:gridMove 20s linear infinite;pointer-events:none;}
        @keyframes gridMove{from{transform:translateY(0)}to{transform:translateY(50px)}}
        .orb{position:fixed;border-radius:50%;filter:blur(100px);pointer-events:none;opacity:.12;}
        .orb1{width:350px;height:350px;background:var(--neon-p);top:-80px;left:-80px;}
        .orb2{width:300px;height:300px;background:var(--neon-r);bottom:-60px;right:-60px;}

        .topbar{position:sticky;top:0;display:flex;justify-content:space-between;align-items:center;padding:14px 28px;background:rgba(5,10,24,0.88);backdrop-filter:blur(12px);border-bottom:1px solid var(--border);z-index:100;}
        .logo{font-family:'Orbitron',monospace;font-size:1.2em;font-weight:900;background:linear-gradient(90deg,var(--neon-b),var(--neon-p));-webkit-background-clip:text;-webkit-text-fill-color:transparent;letter-spacing:2px;}
        .nav-btns{display:flex;gap:10px;}
        .btn-nav{background:transparent;border:1px solid var(--border);color:var(--muted);padding:8px 16px;border-radius:8px;font-family:'Nunito',sans-serif;font-size:0.88em;font-weight:700;cursor:pointer;text-decoration:none;transition:all .2s;display:inline-flex;align-items:center;gap:6px;}
        .btn-nav:hover{border-color:var(--neon-p);color:var(--neon-p);}
        .btn-out{border-color:var(--neon-r);color:var(--neon-r);}
        .btn-out:hover{background:var(--neon-r);color:#fff;box-shadow:0 0 14px var(--neon-r);}

        .container{max-width:960px;margin:0 auto;padding:40px 20px;}
        .page-header{text-align:center;margin-bottom:40px;}
        .page-header h1{font-family:'Orbitron',monospace;font-size:clamp(1.4rem,4vw,2.2rem);font-weight:900;background:linear-gradient(135deg,var(--neon-p),var(--neon-r));-webkit-background-clip:text;-webkit-text-fill-color:transparent;margin-bottom:8px;}
        .page-header p{color:var(--muted);}

        .alert{background:rgba(255,79,123,0.1);border:1px solid var(--neon-r);color:var(--neon-r);padding:12px 24px;border-radius:12px;margin-bottom:20px;text-align:center;font-weight:700;}
        .alert-success{background:rgba(0,255,136,0.1);border-color:var(--neon-g);color:var(--neon-g);}

        .exam-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:20px;}

        .exam-card{
            background:var(--card);
            border:1px solid var(--border);
            border-radius:18px;
            padding:24px 18px;
            text-align:center;
            text-decoration:none;
            color:var(--text);
            transition:all .3s;
            position:relative;
            overflow:hidden;
        }
        .exam-card::before{content:'';position:absolute;bottom:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--neon-p),var(--neon-r));opacity:0;transition:opacity .3s;}
        .exam-card:not(.done):hover{transform:translateY(-8px);box-shadow:0 0 28px rgba(168,85,247,0.25);border-color:var(--neon-p);}
        .exam-card:not(.done):hover::before{opacity:1;}
        .exam-card.done{opacity:.7;pointer-events:none;cursor:default;border-color:var(--neon-g);}

        .exam-icon{font-size:2.5em;margin-bottom:14px;display:block;}
        .exam-card:not(.done) .exam-icon{color:var(--neon-p);filter:drop-shadow(0 0 8px var(--neon-p));}
        .exam-card.done .exam-icon{color:var(--neon-g);filter:drop-shadow(0 0 8px var(--neon-g));}

        .exam-title{font-family:'Orbitron',monospace;font-size:0.8em;font-weight:700;line-height:1.4;margin-bottom:10px;letter-spacing:1px;}
        .exam-meta-chip{font-size:0.75em;color:var(--muted);background:rgba(255,255,255,0.04);border:1px solid var(--border);padding:3px 10px;border-radius:20px;display:inline-block;margin:2px;}
        .exam-score{margin-top:10px;font-family:'Orbitron',monospace;font-size:1em;font-weight:900;color:var(--neon-g);}

        .empty-state{text-align:center;padding:80px 20px;color:var(--muted);}
        .empty-state i{font-size:4rem;color:var(--border);margin-bottom:20px;display:block;}
    </style>
</head>
<body>
<div class="orb orb1"></div><div class="orb orb2"></div>

<div class="topbar">
    <span class="logo">⬡ SMP NEGERI 1 BENAI</span>
    <div class="nav-btns">
        <a href="{{ route('index') }}" class="btn-nav"><i class="fas fa-home"></i> Menu</a>
        @if(Auth::check())
            <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display:none;">@csrf</form>
            <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn-nav btn-out"><i class="fas fa-power-off"></i> Keluar</a>
        @endif
    </div>
</div>

<div class="container">
    <div class="page-header">
        <h1><i class="fas fa-shield-alt"></i> Daftar Ujian</h1>
        <p>Kerjakan ujian yang tersedia untuk kelasmu dengan jujur!</p>
    </div>

    @if(session('error'))<div class="alert"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>@endif
    @if(session('success'))<div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>@endif

    <div class="exam-grid">
        @forelse($ujians as $ujian)
            @php
                $isDone  = isset($nilaiUjians[$ujian->id]);
                $score   = $isDone ? $nilaiUjians[$ujian->id]->nilai_ujian : null;
            @endphp
            <a href="{{ $isDone ? '#' : route('user.ujian.show', $ujian->id) }}" class="exam-card {{ $isDone ? 'done' : '' }}">
                <span class="exam-icon">
                    <i class="fas fa-{{ $isDone ? 'check-circle' : 'file-signature' }}"></i>
                </span>
                <div class="exam-title">{{ $ujian->judul }}</div>
                <div>
                    <span class="exam-meta-chip"><i class="fas fa-book"></i> {{ $ujian->mapel->nama_mapel ?? '-' }}</span>
                    <span class="exam-meta-chip"><i class="fas fa-users"></i> Kelas {{ $ujian->mapel->kelas ?? '-' }}</span>
                    <span class="exam-meta-chip">{{ is_array($ujian->soal) ? count($ujian->soal) : 0 }} Soal</span>
                </div>
                @if($isDone)
                    <div class="exam-score">NILAI: {{ $score }}</div>
                @endif
            </a>
        @empty
            <div class="empty-state" style="grid-column:1/-1;">
                <i class="fas fa-clipboard-list"></i>
                <p>Tidak ada ujian yang tersedia saat ini.</p>
            </div>
        @endforelse
    </div>
</div>
</body>
</html>
