<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MTs Nurul Islam Gunung Toar — Profil</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root{--green-dark:#064e3b;--green:#059669;--green-bright:#10b981;--green-pale:#d1fae5;--gold:#d97706;--gold-light:#f59e0b;--bg:#f0fdf4;--card:#ffffff;--border:#d1fae5;--text:#111827;--muted:#6b7280;--red:#dc2626;}
        *{margin:0;padding:0;box-sizing:border-box;}
        body{font-family:'Poppins',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;display:flex;flex-direction:column;align-items:center;}
        body::before{content:'';position:fixed;inset:0;background-image:linear-gradient(rgba(5,150,105,0.06) 1px,transparent 1px),linear-gradient(90deg,rgba(5,150,105,0.06) 1px,transparent 1px);background-size:50px 50px;pointer-events:none;}

        .topbar{position:fixed;top:0;left:0;right:0;display:flex;justify-content:space-between;align-items:center;padding:13px 28px;background:rgba(255,255,255,0.97);backdrop-filter:blur(12px);border-bottom:2px solid var(--green-pale);z-index:100;box-shadow:0 2px 10px rgba(6,78,59,0.06);}
        .logo{display:flex;align-items:center;gap:10px;text-decoration:none;}
        .logo-icon{width:36px;height:36px;background:linear-gradient(135deg,var(--green-dark),var(--green));border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:1.1em;}
        .logo-text .name{font-size:0.85em;font-weight:700;color:var(--green-dark);}
        .logo-text .sub{font-size:0.62em;color:var(--muted);}
        .btn-nav{background:transparent;border:1.5px solid var(--border);color:var(--muted);padding:7px 14px;border-radius:8px;font-family:'Poppins',sans-serif;font-size:0.82em;font-weight:600;cursor:pointer;text-decoration:none;transition:all .2s;display:inline-flex;align-items:center;gap:6px;}
        .btn-nav:hover{border-color:var(--green);color:var(--green-dark);}

        .profile-wrap{margin-top:88px;width:90%;max-width:480px;position:relative;z-index:1;padding-bottom:40px;}

        .profile-card{background:var(--card);border:1.5px solid var(--border);border-radius:24px;overflow:hidden;box-shadow:0 6px 24px rgba(6,78,59,0.08);}

        .profile-header{background:linear-gradient(135deg,var(--green-dark) 0%,var(--green) 100%);padding:36px 28px;text-align:center;}
        .avatar{width:88px;height:88px;border-radius:50%;background:rgba(255,255,255,0.2);border:3px solid rgba(255,255,255,0.4);margin:0 auto 16px;display:flex;justify-content:center;align-items:center;font-size:2.6em;color:white;}
        .profile-name{font-size:1.3em;font-weight:800;color:white;margin-bottom:6px;}
        .profile-email{color:rgba(255,255,255,0.75);font-size:0.85em;display:flex;align-items:center;justify-content:center;gap:6px;}
        .role-badge{display:inline-block;margin-top:10px;background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.3);color:white;padding:3px 14px;border-radius:20px;font-size:0.75em;font-weight:600;text-transform:capitalize;}

        .profile-body{padding:28px;}
        .info-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px;}
        .info-box{background:var(--bg);border:1px solid var(--border);border-radius:14px;padding:14px 16px;}
        .info-box.full{grid-column:span 2;}
        .info-label{font-size:0.68em;color:var(--green);font-weight:700;text-transform:uppercase;letter-spacing:0.8px;margin-bottom:5px;display:flex;align-items:center;gap:5px;}
        .info-value{font-size:0.95em;font-weight:700;color:var(--text);}

        .btn-back{display:block;text-align:center;margin-top:20px;padding:12px;border-radius:12px;border:1.5px solid var(--border);color:var(--muted);text-decoration:none;font-size:0.85em;font-weight:600;transition:all .2s;display:flex;align-items:center;justify-content:center;gap:8px;}
        .btn-back:hover{border-color:var(--green);color:var(--green-dark);background:var(--green-pale);}
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
        <a href="{{ route('index') }}" class="btn-nav"><i class="fas fa-arrow-left"></i> Menu Utama</a>
    </div>

    <div class="profile-wrap">
        <div class="profile-card">
            <div class="profile-header">
                <div class="avatar"><i class="fas fa-user-graduate"></i></div>
                <div class="profile-name">{{ $user->name ?? 'Siswa' }}</div>
                <div class="profile-email"><i class="fas fa-envelope"></i> {{ $user->email ?? '-' }}</div>
                <div class="role-badge">{{ $user->role ?? 'siswa' }}</div>
            </div>
            <div class="profile-body">
                <div class="info-grid">
                    <div class="info-box">
                        <div class="info-label"><i class="fas fa-id-card"></i> NISN</div>
                        <div class="info-value">{{ $siswa->nisn ?? '-' }}</div>
                    </div>
                    <div class="info-box">
                        <div class="info-label"><i class="fas fa-school"></i> Kelas</div>
                        <div class="info-value">{{ $siswa->kelas ?? '-' }}</div>
                    </div>
                    @if($siswa->no_wa ?? false)
                    <div class="info-box full">
                        <div class="info-label"><i class="fab fa-whatsapp"></i> WhatsApp</div>
                        <div class="info-value">{{ $siswa->no_wa }}</div>
                    </div>
                    @endif
                    <div class="info-box full">
                        <div class="info-label"><i class="fas fa-map-marker-alt"></i> Alamat</div>
                        <div class="info-value" style="font-size:0.85em;">{{ $siswa->alamat ?? '-' }}</div>
                    </div>
                </div>
                <a href="{{ route('index') }}" class="btn-back">
                    <i class="fas fa-home"></i> Kembali ke Menu Utama
                </a>
            </div>
        </div>
    </div>
</body>
</html>
