<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MTs Nurul Islam Gunung Toar — Papan Nilai</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root{--green-dark:#064e3b;--green:#059669;--green-bright:#10b981;--green-pale:#d1fae5;--gold:#d97706;--gold-light:#f59e0b;--bg:#f0fdf4;--card:#ffffff;--border:#d1fae5;--text:#111827;--muted:#6b7280;--red:#dc2626;}
        *{margin:0;padding:0;box-sizing:border-box;}
        body{font-family:'Poppins',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;}
        body::before{content:'';position:fixed;inset:0;background-image:linear-gradient(rgba(5,150,105,0.06) 1px,transparent 1px),linear-gradient(90deg,rgba(5,150,105,0.06) 1px,transparent 1px);background-size:50px 50px;pointer-events:none;}

        .topbar{position:sticky;top:0;display:flex;justify-content:space-between;align-items:center;padding:13px 28px;background:rgba(255,255,255,0.97);backdrop-filter:blur(12px);border-bottom:2px solid var(--green-pale);z-index:100;box-shadow:0 2px 10px rgba(6,78,59,0.06);}
        .logo{display:flex;align-items:center;gap:10px;text-decoration:none;}
        .logo-icon{width:36px;height:36px;background:linear-gradient(135deg,var(--green-dark),var(--green));border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:1.1em;}
        .logo-text .name{font-size:0.85em;font-weight:700;color:var(--green-dark);}
        .logo-text .sub{font-size:0.62em;color:var(--muted);}
        .nav-btns{display:flex;gap:8px;}
        .btn-nav{background:transparent;border:1.5px solid var(--border);color:var(--muted);padding:7px 14px;border-radius:8px;font-family:'Poppins',sans-serif;font-size:0.82em;font-weight:600;cursor:pointer;text-decoration:none;transition:all .2s;display:inline-flex;align-items:center;gap:6px;}
        .btn-nav:hover{border-color:var(--green);color:var(--green-dark);}
        .btn-out{border-color:#fca5a5;color:var(--red);}
        .btn-out:hover{background:var(--red);color:#fff;border-color:var(--red);}

        .container{max-width:760px;margin:0 auto;padding:40px 20px;position:relative;z-index:1;}

        .page-header{margin-bottom:32px;}
        .page-header-inner{display:flex;align-items:center;gap:14px;margin-bottom:4px;}
        .page-header-icon{width:48px;height:48px;background:linear-gradient(135deg,var(--gold),var(--gold-light));border-radius:14px;display:flex;align-items:center;justify-content:center;color:white;font-size:1.4em;box-shadow:0 4px 12px rgba(217,119,6,0.3);}
        .page-header h1{font-size:1.6em;font-weight:800;color:var(--green-dark);}
        .page-header p{color:var(--muted);font-size:0.88em;margin-left:62px;}

        /* Nilai Card */
        .nilai-card{background:var(--card);border:1.5px solid var(--border);border-radius:16px;padding:18px 22px;margin-bottom:14px;display:flex;justify-content:space-between;align-items:center;gap:14px;transition:all .25s;position:relative;overflow:hidden;box-shadow:0 2px 8px rgba(6,78,59,0.04);}
        .nilai-card::before{content:'';position:absolute;left:0;top:0;bottom:0;width:4px;}
        .nilai-card.score-high::before{background:var(--green);}
        .nilai-card.score-mid::before{background:var(--gold);}
        .nilai-card.score-low::before{background:var(--red);}
        .nilai-card:hover{transform:translateX(4px);border-color:var(--green-pale);}

        .bab-tag{font-size:0.72em;color:var(--green);font-weight:700;text-transform:uppercase;letter-spacing:0.8px;margin-bottom:4px;}
        .materi-judul{font-size:0.92em;font-weight:700;color:var(--text);margin-bottom:8px;}
        .stars i{color:var(--gold-light);font-size:0.88em;}
        .stars i.empty{color:var(--border);}

        .lulus-badge{display:inline-block;padding:2px 10px;border-radius:6px;font-size:0.72em;font-weight:700;letter-spacing:0.5px;}
        .lulus-badge.lulus{background:rgba(5,150,105,0.12);color:var(--green-dark);border:1px solid var(--green-pale);}
        .lulus-badge.tidak-lulus{background:rgba(220,38,38,0.1);color:var(--red);border:1px solid #fca5a5;}

        .score-circle{width:70px;height:70px;border-radius:50%;display:flex;flex-direction:column;justify-content:center;align-items:center;border:2px solid;flex-shrink:0;}
        .score-circle.high{border-color:var(--green);background:rgba(5,150,105,0.06);}
        .score-circle.mid{border-color:var(--gold);background:rgba(217,119,6,0.06);}
        .score-circle.low{border-color:var(--red);background:rgba(220,38,38,0.06);}
        .score-num{font-size:1.35em;font-weight:800;line-height:1;}
        .score-circle.high .score-num{color:var(--green-dark);}
        .score-circle.mid .score-num{color:var(--gold);}
        .score-circle.low .score-num{color:var(--red);}
        .score-label{font-size:0.6em;color:var(--muted);margin-top:2px;}

        .btn-remedial{display:inline-flex;align-items:center;gap:6px;margin-top:10px;padding:7px 16px;border-radius:50px;background:linear-gradient(135deg,var(--gold),var(--gold-light));color:#fff;font-size:0.72em;font-weight:700;text-decoration:none;box-shadow:0 3px 10px rgba(217,119,6,0.3);transition:all .25s;}
        .btn-remedial:hover{transform:translateY(-2px);box-shadow:0 6px 16px rgba(217,119,6,0.4);}
        .badge-remedial{display:inline-block;margin-top:8px;background:rgba(217,119,6,0.1);border:1px solid var(--gold);color:var(--gold);padding:2px 10px;border-radius:20px;font-size:0.7em;font-weight:700;}

        .empty-state{text-align:center;padding:60px 20px;color:var(--muted);}
        .empty-state i{font-size:3.5rem;color:var(--border);margin-bottom:16px;display:block;}
        .empty-state p{font-size:1em;font-weight:600;}
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
            <a href="{{ route('index') }}" class="btn-nav"><i class="fas fa-home"></i> Menu</a>
            @if(Auth::check())
                <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display:none;">@csrf</form>
                <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn-nav btn-out"><i class="fas fa-power-off"></i> Keluar</a>
            @endif
        </div>
    </div>

    <div class="container">
        <div class="page-header">
            <div class="page-header-inner">
                <div class="page-header-icon"><i class="fas fa-trophy"></i></div>
                <h1>Papan Nilai</h1>
            </div>
            <p>Rekap nilai kuis kamu selama belajar di MTs Nurul Islam Gunung Toar</p>
        </div>

        @if(count($nilaiQuizzes) > 0)
            @foreach($nilaiQuizzes as $nilai)
                @php
                    $score = $nilai->nilai_quiz;
                    $stars = $score >= 75 ? 3 : ($score >= 50 ? 2 : 1);
                    $cls   = $score >= 75 ? 'high' : ($score >= 50 ? 'mid' : 'low');
                    $belowKkm = $score < 72;
                    $sudahRemedial = $nilai->is_remedial;
                @endphp
                <div class="nilai-card score-{{ $cls }}">
                    <div>
                        <div class="bab-tag">{{ $nilai->materi->bab ?? 'Bab' }}</div>
                        <div class="materi-judul">{{ $nilai->materi->judul ?? 'Kuis' }}</div>
                        <div class="stars" style="margin-bottom:8px;">
                            @for($s=1;$s<=3;$s++)
                                <i class="fas fa-star {{ $s > $stars ? 'empty' : '' }}"></i>
                            @endfor
                        </div>
                        @if($score < 72)
                            <span class="lulus-badge tidak-lulus">✗ TIDAK LULUS</span>
                        @else
                            <span class="lulus-badge lulus">✓ LULUS</span>
                        @endif
                        @if($sudahRemedial)
                            <div class="badge-remedial"><i class="fas fa-redo"></i> REMEDIAL</div>
                        @elseif($belowKkm)
                            <a href="{{ route('user.materi.remedial_quiz', $nilai->materi_id) }}" class="btn-remedial">
                                <i class="fas fa-redo"></i> REMEDIAL
                            </a>
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
                <i class="fas fa-clipboard-list"></i>
                <p>Belum ada kuis yang dikerjakan.<br>Mulai belajar sekarang!</p>
            </div>
        @endif
    </div>
</body>
</html>
