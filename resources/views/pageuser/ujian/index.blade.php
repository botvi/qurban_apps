<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MTs Nurul Islam Gunung Toar — Daftar Ujian</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root{--green-dark:#064e3b;--green:#059669;--green-bright:#10b981;--green-pale:#d1fae5;--gold:#d97706;--gold-light:#f59e0b;--bg:#f0fdf4;--card:#ffffff;--border:#d1fae5;--text:#111827;--muted:#6b7280;--red:#dc2626;--blue:#1d4ed8;--blue-pale:#dbeafe;}
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

        .container{max-width:980px;margin:0 auto;padding:40px 20px;position:relative;z-index:1;}

        .page-header{margin-bottom:32px;}
        .page-header-inner{display:flex;align-items:center;gap:14px;margin-bottom:4px;}
        .page-header-icon{width:48px;height:48px;background:linear-gradient(135deg,var(--blue),#3b82f6);border-radius:14px;display:flex;align-items:center;justify-content:center;color:white;font-size:1.3em;box-shadow:0 4px 12px rgba(29,78,216,0.25);}
        .page-header h1{font-size:1.6em;font-weight:800;color:var(--green-dark);}
        .page-header p{color:var(--muted);font-size:0.88em;margin-left:62px;}

        .alert{padding:12px 20px;border-radius:12px;margin-bottom:20px;font-size:0.88em;font-weight:600;display:flex;align-items:center;gap:8px;}
        .alert-err{background:rgba(220,38,38,0.08);border:1px solid #fca5a5;color:var(--red);}
        .alert-success{background:rgba(5,150,105,0.08);border:1px solid var(--green-pale);color:var(--green-dark);}

        .exam-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(230px,1fr));gap:18px;}

        .exam-card{background:var(--card);border:1.5px solid var(--border);border-radius:18px;padding:24px 18px;text-align:center;text-decoration:none;color:var(--text);transition:all .3s;position:relative;overflow:hidden;box-shadow:0 2px 8px rgba(6,78,59,0.04);}
        .exam-card::before{content:'';position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,var(--blue),#3b82f6);opacity:0;transition:opacity .3s;}
        .exam-card:not(.done):hover{transform:translateY(-8px);box-shadow:0 12px 28px rgba(29,78,216,0.14);border-color:rgba(59,130,246,0.4);}
        .exam-card:not(.done):hover::before{opacity:1;}
        .exam-card.done{opacity:.75;pointer-events:none;border-color:var(--green);}

        .exam-icon{font-size:2.4em;margin-bottom:14px;display:block;}
        .exam-card:not(.done) .exam-icon{color:#3b82f6;}
        .exam-card.done .exam-icon{color:var(--green);}

        .exam-title{font-size:0.9em;font-weight:700;line-height:1.4;margin-bottom:12px;color:var(--text);}

        .exam-meta-chip{font-size:0.72em;color:var(--muted);background:var(--bg);border:1px solid var(--border);padding:3px 10px;border-radius:20px;display:inline-block;margin:2px;}

        .exam-score{margin-top:12px;font-size:1.05em;font-weight:800;}
        .score-ok{color:var(--green-dark);}
        .score-fail{color:var(--red);}

        .badge-remedial{display:inline-block;margin-top:8px;background:rgba(217,119,6,0.1);border:1px solid var(--gold);color:var(--gold);padding:2px 10px;border-radius:20px;font-size:0.7em;font-weight:700;}
        .btn-remedial{display:inline-flex;align-items:center;gap:5px;margin-top:8px;padding:5px 12px;border-radius:20px;background:linear-gradient(135deg,var(--gold),var(--gold-light));color:#fff;font-size:0.7em;font-weight:700;text-decoration:none;box-shadow:0 2px 8px rgba(217,119,6,0.3);transition:all .25s;}
        .btn-remedial:hover{transform:translateY(-2px);}

        .empty-state{text-align:center;padding:80px 20px;color:var(--muted);grid-column:1/-1;}
        .empty-state i{font-size:4rem;color:var(--border);margin-bottom:18px;display:block;}
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
            @if (Auth::check())
                <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display:none;">@csrf</form>
                <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn-nav btn-out"><i class="fas fa-power-off"></i> Keluar</a>
            @endif
        </div>
    </div>

    <div class="container">
        <div class="page-header">
            <div class="page-header-inner">
                <div class="page-header-icon"><i class="fas fa-file-signature"></i></div>
                <h1>Daftar Ujian</h1>
            </div>
            <p>Kerjakan ujian yang tersedia untuk kelasmu dengan jujur dan penuh semangat!</p>
        </div>

        @if (session('error'))
            <div class="alert alert-err"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif

        <div class="exam-grid">
            @forelse($ujians as $ujian)
                @php
                    $isDone = isset($nilaiUjians[$ujian->id]);
                    $score = $isDone ? $nilaiUjians[$ujian->id]->nilai_ujian : null;
                    $isRemedial = $isDone && $nilaiUjians[$ujian->id]->is_remedial;
                    $belowKkm = $isDone && $score < 72;
                    $cardDone = $isDone && ($score >= 72 || $isRemedial);
                @endphp
                <a href="{{ $cardDone ? '#' : route('user.ujian.show', $ujian->id) }}" class="exam-card {{ $cardDone ? 'done' : '' }}">
                    <span class="exam-icon">
                        <i class="fas fa-{{ $cardDone ? 'check-circle' : ($isDone ? 'exclamation-circle' : 'file-signature') }}"></i>
                    </span>
                    <div class="exam-title">{{ $ujian->judul }}</div>
                    <div>
                        <span class="exam-meta-chip"><i class="fas fa-book"></i> {{ $ujian->mapel->nama_mapel ?? '-' }}</span>
                        <span class="exam-meta-chip"><i class="fas fa-users"></i> Kelas {{ $ujian->mapel->kelas ?? '-' }}</span>
                        <span class="exam-meta-chip">{{ is_array($ujian->soal) ? count($ujian->soal) : 0 }} Soal</span>
                    </div>
                    @if ($isDone)
                        <div class="exam-score {{ $score >= 72 ? 'score-ok' : 'score-fail' }}">
                            NILAI: {{ $score }}
                        </div>
                        @if ($isRemedial)
                            <div class="badge-remedial"><i class="fas fa-redo"></i> REMEDIAL</div>
                        @endif
                        @if ($belowKkm && !$isRemedial)
                            <a href="{{ route('user.ujian.remedial', $ujian->id) }}" class="btn-remedial" onclick="event.stopPropagation();">
                                <i class="fas fa-redo"></i> REMEDIAL
                            </a>
                        @endif
                    @endif
                </a>
            @empty
                <div class="empty-state">
                    <i class="fas fa-clipboard-list"></i>
                    <p>Tidak ada ujian yang tersedia saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</body>
</html>
