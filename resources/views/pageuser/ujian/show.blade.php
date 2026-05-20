<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMP Negeri 1 Benai — Ujian</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600;700;900&family=Nunito:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root{--bg:#f8fafc;--card:#ffffff;--border:#e2e8f0;--neon-b:#0ea5e9;--neon-p:#8b5cf6;--neon-g:#10b981;--neon-y:#eab308;--neon-r:#f43f5e;--text:#0f172a;--muted:#64748b;}
        *{margin:0;padding:0;box-sizing:border-box;}
        body{font-family:'Nunito',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;}
        body::before{content:'';position:fixed;inset:0;background-image:linear-gradient(rgba(139,92,246,0.1) 1px,transparent 1px),linear-gradient(90deg,rgba(139,92,246,0.1) 1px,transparent 1px);background-size:50px 50px;animation:gridMove 20s linear infinite;pointer-events:none;}
        @keyframes gridMove{from{transform:translateY(0)}to{transform:translateY(50px)}}

        .topbar{position:sticky;top:0;display:flex;justify-content:space-between;align-items:center;padding:14px 28px;background:rgba(255,255,255,0.9);backdrop-filter:blur(12px);border-bottom:1px solid var(--border);z-index:100;}
        .logo{font-family:'Orbitron',monospace;font-size:1.2em;font-weight:900;background:linear-gradient(90deg,var(--neon-b),var(--neon-p));-webkit-background-clip:text;-webkit-text-fill-color:transparent;letter-spacing:2px;}
        .btn-nav{background:transparent;border:1px solid var(--border);color:var(--muted);padding:8px 16px;border-radius:8px;font-family:'Nunito',sans-serif;font-size:0.88em;font-weight:700;cursor:pointer;text-decoration:none;transition:all .2s;display:inline-flex;align-items:center;gap:6px;}
        .btn-nav:hover{border-color:var(--neon-p);color:var(--neon-p);}
        .zone-label{font-family:'Orbitron',monospace;font-size:0.85em;color:var(--neon-p);letter-spacing:2px;}

        .container{max-width:800px;margin:0 auto;padding:36px 20px;}

        .exam-header{text-align:center;margin-bottom:32px;}
        .exam-header h1{font-family:'Orbitron',monospace;font-size:clamp(1.2rem,3vw,1.8rem);font-weight:900;background:linear-gradient(135deg,var(--neon-p),var(--neon-r));-webkit-background-clip:text;-webkit-text-fill-color:transparent;margin-bottom:8px;}
        .exam-meta{display:flex;justify-content:center;gap:16px;flex-wrap:wrap;margin-top:10px;}
        .meta-chip{background:rgba(168,85,247,0.1);border:1px solid rgba(168,85,247,0.3);color:var(--neon-p);padding:5px 14px;border-radius:20px;font-size:0.82em;font-weight:700;}

        .question-card{background:var(--card);border:1px solid var(--border);border-radius:18px;padding:28px;margin-bottom:24px;position:relative;transition:border-color .3s;}
        .question-card:hover{border-color:rgba(168,85,247,0.3);}

        .q-num{position:absolute;top:-14px;left:20px;background:linear-gradient(135deg,var(--neon-p),var(--neon-r));color:#fff;font-family:'Orbitron',monospace;font-size:0.8em;font-weight:700;padding:4px 14px;border-radius:20px;letter-spacing:1px;}
        .q-text{font-size:1.05em;font-weight:700;color:var(--text);margin-bottom:20px;line-height:1.6;}

        .options-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px;}
        @media(max-width:600px){.options-grid{grid-template-columns:1fr;}}

        .option-label{display:block;cursor:pointer;}
        .option-label input[type="radio"]{position:absolute;opacity:0;pointer-events:none;}
        .option-box{background:rgba(0,0,0,0.03);border:1px solid var(--border);border-radius:12px;padding:14px 16px;display:flex;align-items:center;gap:12px;transition:all .2s;font-weight:700;}
        .option-label:hover .option-box{border-color:var(--neon-p);background:rgba(168,85,247,0.07);}
        .option-label input:checked ~ .option-box{border-color:var(--neon-p);background:rgba(168,85,247,0.14);box-shadow:0 0 12px rgba(168,85,247,0.2);}

        .opt-letter{width:32px;height:32px;border-radius:50%;border:2px solid var(--border);display:flex;justify-content:center;align-items:center;font-family:'Orbitron',monospace;font-size:0.8em;font-weight:700;color:var(--muted);flex-shrink:0;transition:all .2s;}
        .option-label input:checked ~ .option-box .opt-letter{background:var(--neon-p);border-color:var(--neon-p);color:#fff;}

        .submit-area{text-align:center;margin:40px 0 60px;}
        .btn-submit{background:linear-gradient(135deg,var(--neon-p),var(--neon-r));color:#fff;border:none;padding:16px 50px;border-radius:50px;font-family:'Orbitron',monospace;font-size:1em;font-weight:700;cursor:pointer;letter-spacing:2px;transition:all .3s;box-shadow:0 0 20px rgba(168,85,247,0.3);}
        .btn-submit:hover{transform:translateY(-4px);box-shadow:0 0 30px rgba(168,85,247,0.5);}
    </style>
</head>
<body>
<div class="topbar">
    <span class="logo">⬡ SMP NEGERI 1 BENAI</span>
    <a href="{{ route('user.ujian.index') }}" class="btn-nav"><i class="fas fa-arrow-left"></i> Daftar Ujian</a>
    <span class="zone-label"><i class="fas fa-shield-alt"></i> ZONA UJIAN</span>
</div>

<div class="container">
    <div class="exam-header">
        <h1>{{ $ujian->judul }}</h1>
        <div class="exam-meta">
            <span class="meta-chip"><i class="fas fa-book"></i> {{ $ujian->mapel->nama_mapel ?? '-' }}</span>
            <span class="meta-chip"><i class="fas fa-users"></i> Kelas {{ $ujian->mapel->kelas ?? '-' }}</span>
            <span class="meta-chip"><i class="fas fa-list"></i> {{ count($soals) }} Soal</span>
        </div>
    </div>

    <form action="{{ route('user.ujian.submit', $ujian->id) }}" method="POST">
        @csrf
        @if(count($soals) > 0)
            @foreach($soals as $index => $q)
                @php $orig = $q['original_index'] ?? $index; @endphp
                <div class="question-card">
                    <div class="q-num">SOAL {{ $index + 1 }}</div>
                    @if(!empty($q['gambar_pertanyaan']))
                        <div style="margin-bottom: 15px;"><img src="{{ asset($q['gambar_pertanyaan']) }}" style="max-width: 100%; border-radius: 8px;" alt="Gambar Pertanyaan"></div>
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
                                <div style="display: flex; flex-direction: column; gap: 8px;">
                                    @if(!empty($q['gambar_'.$val]))
                                        <img src="{{ asset($q['gambar_'.$val]) }}" style="max-width: 150px; border-radius: 4px;" alt="Pilihan {{ $lbl }}">
                                    @endif
                                    @if(!empty($q[$val]))
                                        <span>{{ $q[$val] }}</span>
                                    @endif
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
            <div style="text-align:center;padding:60px;color:var(--muted);"><i class="fas fa-satellite" style="font-size:3rem;margin-bottom:16px;display:block;"></i>Belum ada soal.</div>
        @endif
    </form>
</div>
</body>
</html>
