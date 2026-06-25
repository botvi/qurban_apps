<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berhasil Dikirim — Tabungan Qurban Masjid Nurul Iman</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family:'Poppins',sans-serif;
            min-height:100vh;
            background:linear-gradient(135deg,#064e3b 0%,#0f766e 40%,#115e59 70%,#0d9488 100%);
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            padding:40px 5%;
        }
        body::before {
            content:'';
            position:fixed;inset:0;
            background-image:
                repeating-linear-gradient(45deg,rgba(255,255,255,.012) 0,rgba(255,255,255,.012) 1px,transparent 1px,transparent 30px);
            pointer-events:none;
        }

        .success-card {
            background:#fff;
            border-radius:24px;
            padding:52px 48px;
            text-align:center;
            max-width:520px;
            width:100%;
            box-shadow:0 30px 80px rgba(0,0,0,.35);
            position:relative;
            z-index:1;
            animation:slideUp .5s ease;
        }
        @keyframes slideUp{
            from{opacity:0;transform:translateY(40px);}
            to{opacity:1;transform:translateY(0);}
        }

        .success-icon {
            width:90px;height:90px;
            background:linear-gradient(135deg,#10b981,#059669);
            border-radius:50%;
            display:flex;align-items:center;justify-content:center;
            font-size:2.5em;
            margin:0 auto 24px;
            box-shadow:0 0 30px rgba(16,185,129,.4);
            animation:glow 3s ease-in-out infinite alternate;
        }
        @keyframes glow{
            from{box-shadow:0 0 20px rgba(16,185,129,.3);}
            to{box-shadow:0 0 50px rgba(16,185,129,.6);}
        }

        h1 { font-size:1.7em; font-weight:800; color:#064e3b; margin-bottom:10px; }
        .sub { font-size:.9em; color:#6b7280; line-height:1.7; margin-bottom:28px; }

        .info-box {
            background:#f0fdfa;
            border:1px solid #ccfbf1;
            border-radius:14px;
            padding:18px 20px;
            margin-bottom:28px;
            text-align:left;
        }
        .info-row{display:flex;align-items:flex-start;gap:12px;margin-bottom:12px;}
        .info-row:last-child{margin-bottom:0;}
        .info-icon{
            width:32px;height:32px;flex-shrink:0;
            background:linear-gradient(135deg,#d97706,#f59e0b);
            border-radius:8px;
            display:flex;align-items:center;justify-content:center;
            font-size:.9em;
        }
        .info-row h4{font-size:.82em;font-weight:700;color:#064e3b;margin-bottom:2px;}
        .info-row p{font-size:.78em;color:#6b7280;line-height:1.5;}

        .btn-back{
            display:inline-flex;align-items:center;gap:8px;
            background:linear-gradient(135deg,#064e3b,#0d9488);
            color:#fff;
            padding:13px 28px;
            border-radius:12px;
            text-decoration:none;
            font-weight:700;font-size:.9em;
            box-shadow:0 4px 14px rgba(6,78,59,.3);
            transition:.25s;
            margin-right:10px;
        }
        .btn-back:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(6,78,59,.45);}
        .btn-again{
            display:inline-flex;align-items:center;gap:8px;
            background:transparent;color:#0d9488;
            padding:13px 24px;
            border-radius:12px;
            text-decoration:none;
            font-weight:600;font-size:.88em;
            border:1.5px solid #0d9488;
            transition:.25s;
        }
        .btn-again:hover{background:#f0fdfa;}

        .confetti-emoji{
            font-size:3em;
            display:block;
            margin-bottom:6px;
            animation:bounce 1s ease infinite alternate;
        }
        @keyframes bounce{from{transform:scale(1);}to{transform:scale(1.2);}}
    </style>
</head>
<body>
    <div class="success-card">
        <span class="confetti-emoji" style="color: #f59e0b;"><i class="bx bxs-party"></i></span>
        <div class="success-icon"><i class="fa-solid fa-check" style="color:white;"></i></div>
        <h1>Bukti Transfer Terkirim!</h1>
        <p class="sub">
            Terima kasih! Bukti transfer Anda telah berhasil dikirim dan sedang dalam proses
            verifikasi oleh pengurus Masjid Nurul Iman Sungai Perupuk.
        </p>

        <div class="info-box">
            <div class="info-row">
                <div class="info-icon" style="color:white;"><i class="fa-solid fa-hourglass-half"></i></div>
                <div>
                    <h4>Proses Verifikasi</h4>
                    <p>Admin akan memverifikasi bukti transfer Anda dalam waktu 1×24 jam kerja (hari Senin–Sabtu).</p>
                </div>
            </div>
            <div class="info-row">
                <div class="info-icon" style="color:white;"><i class="fa-solid fa-clipboard-list"></i></div>
                <div>
                    <h4>Setelah Dikonfirmasi</h4>
                    <p>Setoran Anda akan otomatis tercatat dalam sistem tabungan qurban dan bisa dilihat pengurus masjid.</p>
                </div>
            </div>
            <div class="info-row">
                <div class="info-icon" style="color:white;"><i class="fa-solid fa-phone"></i></div>
                <div>
                    <h4>Butuh Bantuan?</h4>
                    <p>Hubungi pengurus Masjid Nurul Iman Sungai Perupuk untuk pertanyaan lebih lanjut.</p>
                </div>
            </div>
        </div>

        <a href="{{ route('landing') }}" class="btn-back">
            <i class="fas fa-home"></i> Kembali ke Beranda
        </a>
        <a href="{{ route('transfer.create') }}" class="btn-again">
            <i class="fas fa-plus"></i> Kirim Lagi
        </a>
    </div>
</body>
</html>
