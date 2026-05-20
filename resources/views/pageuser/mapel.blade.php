<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMP Negeri 1 Benai — Peta Level</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600;700;900&family=Nunito:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root{--bg:#050a18;--card:#0d1526;--border:#1a2d55;--neon-b:#00c8ff;--neon-p:#a855f7;--neon-g:#00ff88;--neon-y:#ffd700;--neon-r:#ff4f7b;--text:#e2e8f0;--muted:#64748b;}
        *{margin:0;padding:0;box-sizing:border-box;}
        body{font-family:'Nunito',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;}
        body::before{content:'';position:fixed;inset:0;background-image:linear-gradient(rgba(0,200,255,0.04) 1px,transparent 1px),linear-gradient(90deg,rgba(0,200,255,0.04) 1px,transparent 1px);background-size:50px 50px;animation:gridMove 20s linear infinite;pointer-events:none;}
        @keyframes gridMove{from{transform:translateY(0)}to{transform:translateY(50px)}}
        .orb{position:fixed;border-radius:50%;filter:blur(100px);pointer-events:none;opacity:.12;}
        .orb1{width:350px;height:350px;background:var(--neon-b);top:-80px;left:-80px;}
        .orb2{width:300px;height:300px;background:var(--neon-p);bottom:-60px;right:-60px;}

        .topbar{position:sticky;top:0;display:flex;justify-content:space-between;align-items:center;padding:14px 28px;background:rgba(5,10,24,0.88);backdrop-filter:blur(12px);border-bottom:1px solid var(--border);z-index:100;}
        .logo{font-family:'Orbitron',monospace;font-size:1.2em;font-weight:900;background:linear-gradient(90deg,var(--neon-b),var(--neon-p));-webkit-background-clip:text;-webkit-text-fill-color:transparent;letter-spacing:2px;}
        .nav-btns{display:flex;gap:10px;}
        .btn-nav{background:transparent;border:1px solid var(--border);color:var(--muted);padding:8px 16px;border-radius:8px;font-family:'Nunito',sans-serif;font-size:0.88em;font-weight:700;cursor:pointer;text-decoration:none;transition:all .2s;display:inline-flex;align-items:center;gap:6px;}
        .btn-nav:hover{border-color:var(--neon-b);color:var(--neon-b);}
        .btn-out{border-color:var(--neon-r);color:var(--neon-r);}
        .btn-out:hover{background:var(--neon-r);color:#fff;box-shadow:0 0 14px var(--neon-r);}

        .container{max-width:600px;margin:0 auto;padding:40px 20px;}

        .page-header{text-align:center;margin-bottom:40px;}
        .page-header h1{font-family:'Orbitron',monospace;font-size:clamp(1.3rem,4vw,2rem);font-weight:900;background:linear-gradient(135deg,var(--neon-b),var(--neon-p));-webkit-background-clip:text;-webkit-text-fill-color:transparent;margin-bottom:8px;}
        .page-header p{color:var(--muted);}

        .alert{background:rgba(255,79,123,0.1);border:1px solid var(--neon-r);color:var(--neon-r);padding:12px 24px;border-radius:12px;margin-bottom:20px;text-align:center;font-weight:700;}
        .alert-success{background:rgba(0,255,136,0.1);border-color:var(--neon-g);color:var(--neon-g);}

        /* PATH LINE */
        .map-container{position:relative;display:flex;flex-direction:column;align-items:center;gap:50px;padding:20px 0 40px;}
        .map-container::before{content:'';position:absolute;top:0;bottom:0;left:50%;width:2px;background:linear-gradient(180deg,var(--neon-b),var(--neon-p),var(--neon-g));transform:translateX(-50%);opacity:.3;}

        .level-wrapper{position:relative;z-index:2;width:100%;display:flex;justify-content:center;}
        .level-wrapper:nth-child(odd){transform:translateX(-80px);}
        .level-wrapper:nth-child(even){transform:translateX(80px);}

        .level-node{
            width:110px;height:110px;border-radius:50%;
            display:flex;flex-direction:column;justify-content:center;align-items:center;
            text-decoration:none;font-weight:900;
            border:2px solid var(--border);
            background:var(--card);
            transition:all .3s;
            position:relative;
        }

        .level-node.unlocked{border-color:var(--neon-b);cursor:pointer;background:rgba(0,200,255,0.08);}
        .level-node.unlocked:hover{transform:scale(1.12);box-shadow:0 0 30px rgba(0,200,255,0.4);border-color:var(--neon-b);}
        .level-node.completed{border-color:var(--neon-g);background:rgba(0,255,136,0.08);}
        .level-node.locked{opacity:.5;cursor:not-allowed;}

        .node-num{font-family:'Orbitron',monospace;font-size:1.8em;color:var(--neon-b);}
        .level-node.completed .node-num{color:var(--neon-g);}
        .level-node.locked .node-num{color:var(--muted);}

        .node-icon{font-size:1.5em;}
        .level-node.unlocked .node-icon{color:var(--neon-b);}
        .level-node.completed .node-icon{color:var(--neon-g);}
        .level-node.locked .node-icon{color:var(--muted);}

        .node-label{
            position:absolute;bottom:-32px;
            font-family:'Orbitron',monospace;font-size:0.6em;font-weight:700;
            background:var(--card);border:1px solid var(--border);
            color:var(--neon-b);padding:3px 12px;border-radius:20px;
            white-space:nowrap;letter-spacing:1px;
        }

        .node-stars{position:absolute;top:-16px;display:flex;gap:3px;}
        .node-stars i{color:var(--neon-y);font-size:.85em;filter:drop-shadow(0 0 4px var(--neon-y));}

        @media(max-width:600px){
            .level-wrapper:nth-child(odd){transform:translateX(-50px);}
            .level-wrapper:nth-child(even){transform:translateX(50px);}
            .level-node{width:90px;height:90px;}
        }
    </style>
</head>
<body>
<div class="orb orb1"></div><div class="orb orb2"></div>

<div class="topbar">
    <span class="logo">⬡ SMP NEGERI 1 BENAI</span>
    <div class="nav-btns">
        <a href="{{ route('user.materi.index') }}" class="btn-nav"><i class="fas fa-arrow-left"></i> Mapel</a>
        @if(Auth::check())
            <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display:none;">@csrf</form>
            <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn-nav btn-out"><i class="fas fa-power-off"></i> Keluar</a>
        @endif
    </div>
</div>

<div class="container">
    <div class="page-header">
        <h1><i class="fas fa-map-marked-alt"></i> {{ $mapel->nama_mapel }}</h1>
        <p>Kelas {{ $mapel->kelas }} — Selesaikan kuis tiap bab untuk unlock bab berikutnya!</p>
    </div>

    @if(session('error'))<div class="alert"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>@endif
    @if(session('success'))<div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>@endif

    <div class="map-container">
        @foreach($materiStatus as $index => $item)
        <div class="level-wrapper">
            @if($item->is_unlocked)
                <a href="{{ route('user.materi.show', $item->materi->id) }}"
                   class="level-node {{ $item->is_completed ? 'completed' : 'unlocked' }}">
                    @if($item->is_completed)
                        <div class="node-stars">
                            @for($s=0;$s<$item->stars;$s++)<i class="fas fa-star"></i>@endfor
                        </div>
                        <span class="node-icon"><i class="fas fa-check-circle"></i></span>
                    @else
                        <div class="node-num">{{ $index + 1 }}</div>
                        <span class="node-icon"><i class="fas fa-bolt"></i></span>
                    @endif
                    <div class="node-label">{{ Str::limit($item->materi->bab, 12) }}</div>
                </a>
            @else
                <div class="level-node locked" onclick="alert('Selesaikan kuis bab sebelumnya dulu!')">
                    <span class="node-icon"><i class="fas fa-lock"></i></span>
                    <div class="node-label">Terkunci</div>
                </div>
            @endif
        </div>
        @endforeach
    </div>
</div>
</body>
</html>
