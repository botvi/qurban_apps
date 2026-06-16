<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MTs Nurul Islam Gunung Toar — {{ $ujian->judul }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root{--green-dark:#064e3b;--green:#059669;--green-bright:#10b981;--green-pale:#d1fae5;--gold:#d97706;--gold-light:#f59e0b;--bg:#f0fdf4;--card:#ffffff;--border:#d1fae5;--text:#111827;--muted:#6b7280;--red:#dc2626;--blue:#1d4ed8;}
        *{margin:0;padding:0;box-sizing:border-box;}
        body{font-family:'Poppins',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;}
        body::before{content:'';position:fixed;inset:0;background-image:linear-gradient(rgba(5,150,105,0.06) 1px,transparent 1px),linear-gradient(90deg,rgba(5,150,105,0.06) 1px,transparent 1px);background-size:50px 50px;pointer-events:none;}

        .topbar{position:sticky;top:0;display:flex;justify-content:space-between;align-items:center;padding:13px 28px;background:rgba(255,255,255,0.97);backdrop-filter:blur(12px);border-bottom:2px solid var(--green-pale);z-index:100;box-shadow:0 2px 10px rgba(6,78,59,0.06);}
        .logo{display:flex;align-items:center;gap:10px;text-decoration:none;}
        .logo-icon{width:36px;height:36px;background:linear-gradient(135deg,var(--green-dark),var(--green));border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:1.1em;}
        .logo-text .name{font-size:0.85em;font-weight:700;color:var(--green-dark);}
        .logo-text .sub{font-size:0.62em;color:var(--muted);}
        .topbar-right{display:flex;align-items:center;gap:10px;}
        .btn-nav{background:transparent;border:1.5px solid var(--border);color:var(--muted);padding:7px 14px;border-radius:8px;font-family:'Poppins',sans-serif;font-size:0.82em;font-weight:600;cursor:pointer;text-decoration:none;transition:all .2s;display:inline-flex;align-items:center;gap:6px;}
        .btn-nav:hover{border-color:var(--green);color:var(--green-dark);}
        .zone-badge{background:linear-gradient(135deg,var(--blue),#3b82f6);color:white;padding:6px 16px;border-radius:20px;font-size:0.78em;font-weight:700;letter-spacing:0.5px;}

        .container{max-width:820px;margin:0 auto;padding:36px 20px;position:relative;z-index:1;}

        .exam-header{text-align:center;margin-bottom:32px;padding:28px;background:var(--card);border:1.5px solid var(--border);border-radius:18px;box-shadow:0 2px 10px rgba(6,78,59,0.05);}
        .exam-header h1{font-size:clamp(1.1rem,3vw,1.7rem);font-weight:800;color:var(--green-dark);margin-bottom:10px;}
        .exam-meta{display:flex;justify-content:center;gap:10px;flex-wrap:wrap;}
        .meta-chip{background:var(--blue-pale,#dbeafe);border:1px solid rgba(29,78,216,0.2);color:var(--blue);padding:5px 14px;border-radius:20px;font-size:0.8em;font-weight:600;}
        .remedial-badge{display:inline-block;margin-top:14px;background:rgba(217,119,6,0.1);border:1px solid var(--gold);color:var(--gold);padding:5px 16px;border-radius:20px;font-size:0.78em;font-weight:700;}

        .question-card{background:var(--card);border:1.5px solid var(--border);border-radius:16px;padding:26px;margin-bottom:20px;position:relative;box-shadow:0 2px 8px rgba(6,78,59,0.04);transition:border-color .25s;}
        .question-card:focus-within{border-color:rgba(29,78,216,0.4);}

        .q-num{position:absolute;top:-13px;left:18px;background:linear-gradient(135deg,var(--blue),#3b82f6);color:#fff;font-size:0.78em;font-weight:700;padding:4px 14px;border-radius:20px;letter-spacing:0.5px;}
        .q-text{font-size:1em;font-weight:700;color:var(--text);margin-bottom:18px;line-height:1.65;}

        .options-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
        @media(max-width:600px){.options-grid{grid-template-columns:1fr;}}

        .option-label{display:block;cursor:pointer;}
        .option-label input[type="radio"]{position:absolute;opacity:0;pointer-events:none;}
        .option-box{background:rgba(0,0,0,0.02);border:1.5px solid var(--border);border-radius:10px;padding:12px 14px;display:flex;align-items:center;gap:10px;transition:all .2s;font-weight:500;font-size:0.92em;}
        .option-label:hover .option-box{border-color:rgba(29,78,216,0.4);background:rgba(29,78,216,0.04);}
        .option-label input:checked ~ .option-box{border-color:var(--blue);background:rgba(29,78,216,0.08);box-shadow:0 0 0 3px rgba(29,78,216,0.1);}
        .opt-letter{width:30px;height:30px;border-radius:50%;border:1.5px solid var(--border);display:flex;justify-content:center;align-items:center;font-size:0.8em;font-weight:700;color:var(--muted);flex-shrink:0;transition:all .2s;}
        .option-label input:checked ~ .option-box .opt-letter{background:var(--blue);border-color:var(--blue);color:white;}

        .submit-area{text-align:center;margin:36px 0 50px;}
        .btn-submit{background:linear-gradient(135deg,var(--blue),#3b82f6);color:#fff;border:none;padding:15px 48px;border-radius:50px;font-family:'Poppins',sans-serif;font-size:0.95em;font-weight:700;cursor:pointer;letter-spacing:0.5px;transition:all .3s;box-shadow:0 6px 20px rgba(29,78,216,0.3);}
        .btn-submit:hover{transform:translateY(-3px);box-shadow:0 10px 28px rgba(29,78,216,0.4);}
        .btn-submit:active{transform:translateY(1px);}

        .empty-quiz{text-align:center;padding:60px;color:var(--muted);}
        .empty-quiz i{font-size:3rem;margin-bottom:14px;display:block;color:var(--border);}
    </style>
</head>
<body>
    <div class="topbar">
        <a href="{{ route('user.ujian.index') }}" class="logo">
            <div class="logo-icon">🕌</div>
            <div class="logo-text">
                <div class="name">MTs Nurul Islam Gunung Toar</div>
                <div class="sub">E-Learning Platform</div>
            </div>
        </a>
        <div class="topbar-right">
            <a href="{{ route('user.ujian.index') }}" class="btn-nav"><i class="fas fa-arrow-left"></i> Daftar Ujian</a>
            <span class="zone-badge"><i class="fas fa-shield-alt"></i> Zona Ujian</span>
        </div>
    </div>

    <div class="container">
        <div class="exam-header">
            <h1>{{ isset($isRemedial) && $isRemedial ? '🔄 Remedial: ' : '' }}{{ $ujian->judul }}</h1>
            <div class="exam-meta">
                <span class="meta-chip"><i class="fas fa-book"></i> {{ $ujian->mapel->nama_mapel ?? '-' }}</span>
                <span class="meta-chip"><i class="fas fa-users"></i> Kelas {{ $ujian->mapel->kelas ?? '-' }}</span>
                <span class="meta-chip"><i class="fas fa-list"></i> {{ count($soals) }} Soal</span>
            </div>
            @if(isset($isRemedial) && $isRemedial)
                <div class="remedial-badge"><i class="fas fa-exclamation-triangle"></i> MODE REMEDIAL &mdash; Maks. Nilai 72</div>
            @endif
        </div>

        <form action="{{ isset($isRemedial) && $isRemedial ? route('user.ujian.remedial.submit', $ujian->id) : route('user.ujian.submit', $ujian->id) }}" method="POST">
            @csrf
            @if(count($soals) > 0)
                @foreach($soals as $index => $q)
                    @php $orig = $q['original_index'] ?? $index; @endphp
                    <div class="question-card">
                        <div class="q-num">SOAL {{ $index + 1 }}</div>
                        @if(!empty($q['gambar_pertanyaan']))
                            <div style="margin-bottom:14px;"><img src="{{ asset($q['gambar_pertanyaan']) }}" style="max-width:100%;border-radius:10px;" alt="Gambar"></div>
                        @endif
                        @if(!empty($q['pertanyaan']))
                            <div class="q-text">{!! $q['pertanyaan'] !!}</div>
                        @endif
                        <div class="options-grid">
                            @foreach(['a'=>'A','b'=>'B','c'=>'C','d'=>'D'] as $val => $lbl)
                            <label class="option-label">
                                <input type="radio" name="jawaban[{{ $orig }}]" value="{{ $val }}" required>
                                <div class="option-box">
                                    <span class="opt-letter">{{ $lbl }}</span>
                                    <div style="display:flex;flex-direction:column;gap:6px;">
                                        @if(!empty($q['gambar_'.$val]))
                                            <img src="{{ asset($q['gambar_'.$val]) }}" style="max-width:140px;border-radius:6px;" alt="Pilihan {{ $lbl }}">
                                        @endif
                                        @if(!empty($q[$val]))<span>{{ $q[$val] }}</span>@endif
                                    </div>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                <div class="submit-area">
                    <button type="submit" class="btn-submit"><i class="fas fa-check-double"></i> &nbsp; KUMPULKAN UJIAN</button>
                </div>
            @else
                <div class="empty-quiz"><i class="fas fa-clipboard"></i>Belum ada soal untuk ujian ini.</div>
            @endif
        </form>
    </div>
</body>
</html>
