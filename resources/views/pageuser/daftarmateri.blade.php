<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MTs Nurul Islam Gunung Toar — {{ $materi->judul }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --green-dark: #022c22;
            --green-medium: #064e3b;
            --green: #059669;
            --green-bright: #10b981;
            --green-pale: #e6fbf2;
            --gold: #d97706;
            --gold-light: #f59e0b;
            --bg: #f4fbf7;
            --card: #ffffff;
            --border: #e2f5ec;
            --text: #0f172a;
            --muted: #64748b;
            --red: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            background-image: 
                radial-gradient(at 0% 0%, rgba(16, 185, 129, 0.04) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(245, 158, 11, 0.02) 0px, transparent 50%);
        }

        /* Topbar */
        .topbar {
            position: sticky;
            top: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 40px;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            z-index: 100;
            box-shadow: 0 4px 30px rgba(2, 44, 34, 0.02);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
        }

        .logo-icon {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, var(--green-medium), var(--green));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4em;
        }

        .logo-text .name {
            font-family: 'Outfit', sans-serif;
            font-size: 0.95em;
            font-weight: 800;
            color: var(--green-dark);
            letter-spacing: 0.3px;
        }

        .logo-text .sub {
            font-size: 0.7em;
            color: var(--muted);
            font-weight: 500;
        }

        .nav-btns {
            display: flex;
            gap: 10px;
        }

        .btn-nav {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid var(--border);
            color: var(--muted);
            padding: 9px 18px;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.85em;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-nav:hover {
            border-color: var(--green);
            color: var(--green-dark);
            background: #fff;
            transform: translateY(-1px);
        }

        .btn-out {
            border-color: rgba(239, 68, 68, 0.2);
            color: var(--red);
        }

        .btn-out:hover {
            background: var(--red);
            color: #fff;
            border-color: var(--red);
        }

        /* Container */
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 40px 24px;
        }

        .alert {
            padding: 16px 24px;
            border-radius: 16px;
            margin-bottom: 30px;
            font-size: 0.92em;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
        }

        .alert-err {
            background: rgba(239, 68, 68, 0.06);
            border: 1px solid rgba(239, 68, 68, 0.15);
            color: var(--red);
        }

        /* Study Desk Card */
        .study-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 16px 48px rgba(2, 44, 34, 0.05);
        }

        /* Card Header banner */
        .study-header {
            background: linear-gradient(135deg, var(--green-dark) 0%, var(--green-medium) 100%);
            padding: 40px 48px;
            color: white;
            text-align: center;
            position: relative;
        }

        .study-header::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top right, rgba(16, 185, 129, 0.15), transparent 60%);
        }

        .chapter-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: var(--green-pale);
            padding: 6px 20px;
            border-radius: 30px;
            font-size: 0.8em;
            font-weight: 800;
            margin-bottom: 14px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .study-title {
            font-family: 'Outfit', sans-serif;
            font-size: clamp(1.5rem, 5vw, 2.2rem);
            font-weight: 850;
            color: white;
            margin-bottom: 12px;
            line-height: 1.25;
        }

        .study-desc {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95em;
            font-style: italic;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Interactive Tabs Bar */
        .tabs-bar {
            display: flex;
            background: #f8fafc;
            border-bottom: 1px solid var(--border);
            padding: 12px 24px;
            gap: 10px;
        }

        .tab-btn {
            background: transparent;
            border: none;
            font-family: 'Poppins', sans-serif;
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--muted);
            padding: 10px 20px;
            border-radius: 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .tab-btn:hover {
            color: var(--green);
            background: rgba(16, 185, 129, 0.05);
        }

        .tab-btn.active {
            color: white;
            background: linear-gradient(135deg, var(--green-medium), var(--green));
            box-shadow: 0 4px 12px rgba(6, 78, 59, 0.15);
        }

        /* Study Body */
        .study-body {
            padding: 40px;
        }

        .tab-content {
            animation: tabFadeIn 0.5s ease-out;
        }

        @keyframes tabFadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Video Frame Wrapper */
        .video-container {
            position: relative;
            overflow: hidden;
            padding-top: 56.25%;
            border-radius: 20px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid var(--border);
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        /* PDF Frame Wrapper */
        .pdf-container {
            position: relative;
            overflow: hidden;
            padding-top: 130%; /* Standard aspect ratio for portrait A4 document */
            border-radius: 20px;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.08);
            border: 1px solid var(--border);
        }

        .pdf-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        .pdf-action-footer {
            text-align: center;
            margin-top: 20px;
        }

        .btn-expand-view {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1.5px solid var(--green);
            color: var(--green-medium);
            background: transparent;
            padding: 10px 24px;
            border-radius: 12px;
            font-size: 0.88em;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s;
            cursor: pointer;
        }

        .btn-expand-view:hover {
            background: var(--green-pale);
            transform: translateY(-1px);
        }

        /* Empty States */
        .empty-file-alert {
            background: rgba(239, 68, 68, 0.04);
            border: 1px dashed rgba(239, 68, 68, 0.2);
            border-radius: 16px;
            padding: 40px;
            text-align: center;
            color: var(--muted);
        }

        .empty-file-alert i {
            font-size: 2.5rem;
            color: rgba(239, 68, 68, 0.2);
            margin-bottom: 12px;
            display: block;
        }

        /* Action footer card */
        .footer-action-area {
            text-align: center;
            padding: 40px;
            border-top: 1px solid var(--border);
            background: #fafdfb;
        }

        .footer-action-area h3 {
            font-family: 'Outfit', sans-serif;
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--green-dark);
            margin-bottom: 6px;
        }

        .footer-action-area p {
            color: var(--muted);
            font-size: 0.85em;
            margin-bottom: 24px;
        }

        .btn-quiz-primary {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: linear-gradient(135deg, var(--green-medium), var(--green));
            color: white;
            text-decoration: none;
            padding: 16px 44px;
            border-radius: 16px;
            font-size: 1em;
            font-weight: 800;
            letter-spacing: 0.3px;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 10px 24px rgba(6, 78, 59, 0.25);
            position: relative;
        }

        .btn-quiz-primary::before {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 20px;
            border: 2px solid var(--green-bright);
            opacity: 0;
            transition: all 0.3s;
        }

        .btn-quiz-primary:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 30px rgba(6, 78, 59, 0.35);
        }

        .btn-quiz-primary:hover::before {
            opacity: 1;
            transform: scale(1.04);
        }

        @media (max-width: 600px) {
            .study-header {
                padding: 30px 20px;
            }
            .study-body {
                padding: 24px 16px;
            }
            .tabs-bar {
                padding: 10px 16px;
                gap: 5px;
            }
            .tab-btn {
                padding: 8px 12px;
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="topbar">
        <a href="{{ route('user.materi.index') }}" class="logo">
            <div class="logo-icon">🕌</div>
            <div class="logo-text">
                <div class="name">MTs Nurul Islam Gunung Toar</div>
                <div class="sub">E-Learning Platform</div>
            </div>
        </a>
        <div class="nav-btns">
            <a href="{{ route('user.materi.mapel', $materi->mapel_id) }}" class="btn-nav"><i class="fas fa-arrow-left"></i> Peta Belajar</a>
            <a href="{{ route('index') }}" class="btn-nav"><i class="fas fa-home"></i></a>
            @if(Auth::check())
                <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display:none;">@csrf</form>
                <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn-nav btn-out"><i class="fas fa-power-off"></i> Keluar</a>
            @endif
        </div>
    </div>

    <div class="container">
        @if(session('error'))
            <div class="alert alert-err"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
        @endif

        <div class="study-card">
            <!-- Header banner -->
            <div class="study-header">
                <div class="chapter-badge">{{ $materi->bab }}</div>
                <h1 class="study-title">{{ $materi->judul }}</h1>
                @if($materi->deskripsi)
                    <div class="study-desc">{{ $materi->deskripsi }}</div>
                @endif
            </div>

            @php
                $youtubeEmbed = null;
                if ($materi->link_youtube) {
                    $url = $materi->link_youtube;
                    if (str_contains($url, 'youtube.com/watch')) {
                        parse_str(parse_url($url, PHP_URL_QUERY), $queryVars);
                        if (isset($queryVars['v'])) { 
                            $youtubeEmbed = 'https://www.youtube.com/embed/' . $queryVars['v']; 
                        }
                    } elseif (str_contains($url, 'youtu.be/')) {
                        $path = parse_url($url, PHP_URL_PATH);
                        $youtubeEmbed = 'https://www.youtube.com/embed/' . ltrim($path, '/');
                    } else {
                        $youtubeEmbed = $url;
                    }
                }
            @endphp

            <!-- Tabs Navigation -->
            @if($youtubeEmbed || $materi->isi_materi)
                <div class="tabs-bar">
                    @if($youtubeEmbed)
                        <button class="tab-btn active" id="btn-video" onclick="switchTab('video')">
                            <i class="fab fa-youtube"></i> Video Pembelajaran
                        </button>
                    @endif
                    @if($materi->isi_materi)
                        <button class="tab-btn {{ !$youtubeEmbed ? 'active' : '' }}" id="btn-pdf" onclick="switchTab('pdf')">
                            <i class="fas fa-file-pdf"></i> Modul Pembaca PDF
                        </button>
                    @endif
                </div>
            @endif

            <!-- Body Study Content -->
            <div class="study-body">
                @if($youtubeEmbed)
                    <div class="tab-content" id="content-video" style="display: block;">
                        <div class="video-container">
                            <iframe src="{{ $youtubeEmbed }}" allowfullscreen></iframe>
                        </div>
                    </div>
                @endif

                @if($materi->isi_materi)
                    <div class="tab-content" id="content-pdf" style="display: {{ $youtubeEmbed ? 'none' : 'block' }};">
                        <div class="pdf-container">
                            <iframe src="{{ asset('uploads/pdf/' . $materi->isi_materi) }}#toolbar=0" allowfullscreen></iframe>
                        </div>
                        <div class="pdf-action-footer">
                            <a href="{{ asset('uploads/pdf/' . $materi->isi_materi) }}" target="_blank" class="btn-expand-view">
                                <i class="fas fa-external-link-alt"></i> Buka Layar Penuh (Tab Baru)
                            </a>
                        </div>
                    </div>
                @endif

                @if(!$youtubeEmbed && !$materi->isi_materi)
                    <div class="empty-file-alert">
                        <i class="fas fa-file-excel"></i>
                        File materi pembelajaran belum diunggah oleh guru.
                    </div>
                @endif
            </div>

            <!-- Quiz Action Footer -->
            <div class="footer-action-area">
                <h3>Sudah paham dengan materinya?</h3>
                <p>Uji pemahamanmu sekarang dengan mengerjakan kuis interaktif bab ini!</p>
                <a href="{{ route('user.materi.quiz', $materi->id) }}" class="btn-quiz-primary">
                    <i class="fas fa-graduation-cap"></i> Kerjakan Kuis Bab Ini
                </a>
            </div>
        </div>
    </div>

    <!-- Tabs Switching Logic -->
    @if($youtubeEmbed && $materi->isi_materi)
        <script>
            function switchTab(tabName) {
                const videoBtn = document.getElementById('btn-video');
                const pdfBtn = document.getElementById('btn-pdf');
                const videoCont = document.getElementById('content-video');
                const pdfCont = document.getElementById('content-pdf');

                if (tabName === 'video') {
                    videoBtn.classList.add('active');
                    pdfBtn.classList.remove('active');
                    videoCont.style.display = 'block';
                    pdfCont.style.display = 'none';
                } else if (tabName === 'pdf') {
                    pdfBtn.classList.add('active');
                    videoBtn.classList.remove('active');
                    pdfCont.style.display = 'block';
                    videoCont.style.display = 'none';
                }
            }
        </script>
    @endif
</body>
</html>
