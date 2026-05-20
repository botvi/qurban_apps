<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMP Negeri 1 Benai — Papan Nilai</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600;700;900&family=Nunito:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root{--bg:#050a18;--card:#0d1526;--border:#1a2d55;--neon-b:#00c8ff;--neon-p:#a855f7;--neon-g:#00ff88;--neon-y:#ffd700;--neon-r:#ff4f7b;--text:#e2e8f0;--muted:#64748b;}
        *{margin:0;padding:0;box-sizing:border-box;}
        body{font-family:'Nunito',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;}
        body::before{content:'';position:fixed;inset:0;background-image:linear-gradient(rgba(0,200,255,0.04) 1px,transparent 1px),linear-gradient(90deg,rgba(0,200,255,0.04) 1px,transparent 1px);background-size:50px 50px;animation:gridMove 20s linear infinite;pointer-events:none;}
        @keyframes gridMove{from{transform:translateY(0)}to{transform:translateY(50px)}}
        .orb{position:fixed;border-radius:50%;filter:blur(100px);pointer-events:none;opacity:.12;}
        .orb1{width:350px;height:350px;background:var(--neon-b);top:-80px;right:-80px;}
        .orb2{width:300px;height:300px;background:var(--neon-g);bottom:-60px;left:-60px;}

        .topbar{position:sticky;top:0;display:flex;justify-content:space-between;align-items:center;padding:14px 28px;background:rgba(5,10,24,0.88);backdrop-filter:blur(12px);border-bottom:1px solid var(--border);z-index:100;}
        .logo{font-family:'Orbitron',monospace;font-size:1.2em;font-weight:900;background:linear-gradient(90deg,var(--neon-b),var(--neon-p));-webkit-background-clip:text;-webkit-text-fill-color:transparent;letter-spacing:2px;}
        .nav-btns{display:flex;gap:10px;}
        .btn-nav{background:transparent;border:1px solid var(--border);color:var(--muted);padding:8px 16px;border-radius:8px;font-family:'Nunito',sans-serif;font-size:0.88em;font-weight:700;cursor:pointer;text-decoration:none;transition:all .2s;display:inline-flex;align-items:center;gap:6px;}
        .btn-nav:hover{border-color:var(--neon-b);color:var(--neon-b);}
        .btn-out{border-color:var(--neon-r);color:var(--neon-r);}
        .btn-out:hover{background:var(--neon-r);color:#fff;box-shadow:0 0 14px var(--neon-r);}

        .container{max-width:750px;margin:0 auto;padding:40px 20px;}

        .page-header{text-align:center;margin-bottom:40px;}
        .page-header h1{font-family:'Orbitron',monospace;font-size:clamp(1.4rem,4vw,2.2rem);font-weight:900;background:linear-gradient(135deg,var(--neon-y),var(--neon-r));-webkit-background-clip:text;-webkit-text-fill-color:transparent;margin-bottom:8px;}
        .page-header p{color:var(--muted);}

        .nilai-card{
            background:var(--card);
            border:1px solid var(--border);
            border-radius:16px;
            padding:20px 24px;
            margin-bottom:16px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:16px;
            transition:all .3s;
            position:relative;
            overflow:hidden;
        }
        .nilai-card::before{content:'';position:absolute;left:0;top:0;bottom:0;width:4px;}
        .nilai-card.score-high::before{background:var(--neon-g);}
        .nilai-card.score-mid::before{background:var(--neon-y);}
        .nilai-card.score-low::before{background:var(--neon-r);}
        .nilai-card:hover{transform:translateX(6px);border-color:var(--neon-b);}

        .materi-bab{font-size:0.75em;color:var(--neon-p);font-weight:700;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;}
        .materi-judul{font-family:'Orbitron',monospace;font-size:0.95em;font-weight:700;color:var(--text);margin-bottom:8px;}
        .stars i{color:var(--neon-y);font-size:0.9em;filter:drop-shadow(0 0 4px var(--neon-y));}
        .stars i.empty{color:var(--border);filter:none;}

        .score-circle{
            width:72px;height:72px;border-radius:50%;
            display:flex;flex-direction:column;justify-content:center;align-items:center;
            border:2px solid;flex-shrink:0;
        }
        .score-circle.high{border-color:var(--neon-g);background:rgba(0,255,136,0.08);}
        .score-circle.mid{border-color:var(--neon-y);background:rgba(255,215,0,0.08);}
        .score-circle.low{border-color:var(--neon-r);background:rgba(255,79,123,0.08);}
        .score-num{font-family:'Orbitron',monospace;font-size:1.4em;font-weight:900;line-height:1;}
        .score-circle.high .score-num{color:var(--neon-g);}
        .score-circle.mid .score-num{color:var(--neon-y);}
        .score-circle.low .score-num{color:var(--neon-r);}
        .score-label{font-size:0.65em;color:var(--muted);margin-top:2px;}

        .empty-state{text-align:center;padding:60px 20px;color:var(--muted);}
        .empty-state i{font-size:4rem;color:var(--border);margin-bottom:20px;display:block;}
        .empty-state p{font-size:1.1em;font-weight:700;}
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
        <h1><i class="fas fa-trophy"></i> Papan Nilai</h1>
        <p>Rekap nilai kuis kamu selama belajar di SMP Negeri 1 Benai</p>
    </div>

    @if(count($nilaiQuizzes) > 0)
        @foreach($nilaiQuizzes as $nilai)
            @php
                $score = $nilai->nilai_quiz;
                $stars = $score >= 75 ? 3 : ($score >= 50 ? 2 : 1);
                $cls   = $score >= 75 ? 'high' : ($score >= 50 ? 'mid' : 'low');
            @endphp
            <div class="nilai-card score-{{ $cls }}">
                <div>
                    <div class="materi-bab">{{ $nilai->materi->bab ?? 'Bab' }}</div>
                    <div class="materi-judul">{{ $nilai->materi->judul ?? 'Kuis' }}</div>
                    <div class="stars" style="margin-bottom: 8px;">
                        @for($s=1;$s<=3;$s++)
                            <i class="fas fa-star {{ $s > $stars ? 'empty' : '' }}"></i>
                        @endfor
                    </div>
                    @if($score < 72)
                        <span style="background:var(--neon-r);color:#fff;padding:2px 8px;border-radius:4px;font-size:0.75em;font-weight:bold;letter-spacing:1px;box-shadow:0 0 8px var(--neon-r);">TIDAK LULUS</span>
                    @else
                        <span style="background:var(--neon-g);color:#050a18;padding:2px 8px;border-radius:4px;font-size:0.75em;font-weight:bold;letter-spacing:1px;box-shadow:0 0 8px var(--neon-g);">LULUS</span>
                    @endif
                </div>
                <div class="score-circle {{ $cls }}">
                    <div class="score-num">{{ round($score) }}</div>
                    <div class="score-label">NILAI</div>
                </div>
            </div>
        @endforeach
    @else
        <div class="empty-state">
            <i class="fas fa-satellite-dish"></i>
            <p>Belum ada kuis yang dikerjakan.<br>Mulai belajar sekarang!</p>
        </div>
    @endif
</div>
</body>
</html>
