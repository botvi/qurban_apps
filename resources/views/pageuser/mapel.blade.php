<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MTs Nurul Islam Gunung Toar — {{ $mapel->nama_mapel }}</title>
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
            --gold-light: #fbbf24;
            --bg: #f4fbf7;
            --card: #ffffff;
            --border: #e2f5ec;
            --text: #0f172a;
            --muted: #64748b;
            --red: #ef4444;
            --purple: #8b5cf6;
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
                radial-gradient(at 0% 100%, rgba(16, 185, 129, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(245, 158, 11, 0.03) 0px, transparent 50%);
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
            box-shadow: 0 8px 16px rgba(6, 78, 59, 0.15);
        }

        .logo-text {
            display: flex;
            flex-direction: column;
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
            gap: 12px;
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
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.08);
        }

        .btn-out {
            border-color: rgba(239, 68, 68, 0.2);
            color: var(--red);
        }

        .btn-out:hover {
            background: var(--red);
            color: #fff;
            border-color: var(--red);
            box-shadow: 0 6px 15px rgba(239, 68, 68, 0.2);
        }

        /* Container */
        .container {
            max-width: 750px;
            margin: 0 auto;
            padding: 40px 24px;
        }

        /* Course Summary Header */
        .course-header-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 36px;
            box-shadow: 0 10px 30px rgba(2, 44, 34, 0.03);
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
        }

        .course-header-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 8px;
            height: 100%;
            background: linear-gradient(180deg, var(--green), var(--green-bright));
        }

        .course-badge {
            display: inline-block;
            background: var(--green-pale);
            color: var(--green-medium);
            padding: 4px 16px;
            border-radius: 30px;
            font-size: 0.8em;
            font-weight: 700;
            margin-bottom: 14px;
        }

        .course-title {
            font-family: 'Outfit', sans-serif;
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--green-dark);
            margin-bottom: 8px;
        }

        .course-subtitle {
            color: var(--muted);
            font-size: 0.92rem;
            margin-bottom: 24px;
        }

        /* Map Progress */
        .map-progress-box {
            display: flex;
            align-items: center;
            gap: 16px;
            background: #f8fafc;
            border-radius: 16px;
            padding: 16px 20px;
        }

        .progress-circle {
            position: relative;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 0.9em;
            color: var(--green-dark);
            flex-shrink: 0;
        }

        .progress-text-info {
            flex-grow: 1;
        }

        .progress-text-info .progress-label {
            font-size: 0.8em;
            font-weight: 700;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .progress-text-info .progress-desc {
            font-size: 0.88em;
            font-weight: 700;
            color: var(--green-dark);
            margin-top: 2px;
        }

        .map-progress-bar-container {
            width: 150px;
            height: 8px;
            background: #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
        }

        .map-progress-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--green), var(--green-bright));
            border-radius: 10px;
        }

        /* Alerts */
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

        .alert-success {
            background: rgba(16, 185, 129, 0.06);
            border: 1px solid rgba(16, 185, 129, 0.15);
            color: var(--green-medium);
        }

        /* GAMIFIED ROADMAP PATH */
        .roadmap-container {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 56px;
            padding: 20px 0 60px;
        }

        /* Curved Pathway Line */
        .roadmap-container::before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 50%;
            width: 6px;
            background: #e2e8f0;
            background-image: linear-gradient(to bottom, var(--green-pale), #cbd5e1 50%, var(--green-pale));
            transform: translateX(-50%);
            border-radius: 10px;
            z-index: 1;
        }

        .level-node-wrapper {
            position: relative;
            z-index: 2;
            width: 100%;
            display: flex;
            justify-content: center;
        }

        /* Alternate path translations for snake winding effect */
        .level-node-wrapper:nth-child(odd) {
            transform: translateX(-90px);
        }

        .level-node-wrapper:nth-child(even) {
            transform: translateX(90px);
        }

        .level-node-wrapper:nth-child(odd)::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 90px;
            height: 40px;
            border-bottom: 4px dashed #cbd5e1;
            border-right: 4px dashed #cbd5e1;
            border-bottom-right-radius: 30px;
            transform: translate(0, -100%);
            z-index: -1;
            opacity: 0.6;
        }

        .level-node-wrapper:nth-child(even)::after {
            content: '';
            position: absolute;
            top: 50%;
            right: 50%;
            width: 90px;
            height: 40px;
            border-bottom: 4px dashed #cbd5e1;
            border-left: 4px dashed #cbd5e1;
            border-bottom-left-radius: 30px;
            transform: translate(0, -100%);
            z-index: -1;
            opacity: 0.6;
        }

        .level-node {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            position: relative;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            background: white;
            border: 6px solid #e2e8f0;
            box-shadow: 0 10px 24px rgba(2, 44, 34, 0.08);
        }

        /* STATES */
        /* 1. Locked */
        .level-node.locked {
            opacity: 0.75;
            cursor: not-allowed;
            background: #f1f5f9;
            border-color: #cbd5e1;
            box-shadow: none;
        }

        .level-node.locked .node-icon {
            color: #94a3b8;
            font-size: 1.6rem;
        }

        /* 2. Unlocked / Active */
        .level-node.unlocked {
            border-color: var(--green-bright);
            background: white;
            cursor: pointer;
        }

        .level-node.unlocked .node-num {
            font-family: 'Outfit', sans-serif;
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--green-dark);
            line-height: 1;
        }

        .level-node.unlocked .node-icon {
            color: var(--green-bright);
            font-size: 0.95em;
            margin-top: 4px;
        }

        /* Aura Pulsing effect for active unlocked node */
        .level-node.unlocked::before {
            content: '';
            position: absolute;
            inset: -12px;
            border-radius: 50%;
            border: 2px solid var(--green-bright);
            animation: pulse-ring 2s cubic-bezier(0.215, 0.610, 0.355, 1) infinite;
            pointer-events: none;
        }

        .level-node.unlocked::after {
            content: '';
            position: absolute;
            inset: -6px;
            border-radius: 50%;
            background: rgba(16, 185, 129, 0.08);
            z-index: -1;
            animation: pulse-gla 2s ease-in-out infinite;
        }

        /* Active Tooltip Badge */
        .active-tooltip {
            position: absolute;
            top: -42px;
            background: linear-gradient(135deg, var(--purple), #8b5cf6);
            color: white;
            font-size: 0.72rem;
            font-weight: 800;
            padding: 6px 14px;
            border-radius: 12px;
            white-space: nowrap;
            box-shadow: 0 6px 16px rgba(139, 92, 246, 0.3);
            letter-spacing: 0.5px;
            animation: bounce-small 2s ease-in-out infinite;
        }

        .active-tooltip::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-top: 6px solid var(--purple);
        }

        /* 3. Completed */
        .level-node.completed {
            border-color: var(--gold-light);
            background: linear-gradient(135deg, #fffbeb, #fef3c7);
            cursor: pointer;
        }

        .level-node.completed .node-icon {
            color: var(--gold);
            font-size: 1.8rem;
        }

        .level-node.completed:hover {
            border-color: #f59e0b;
        }

        /* Animations */
        @keyframes pulse-ring {
            0% { transform: scale(0.85); opacity: 0.8; }
            100% { transform: scale(1.25); opacity: 0; }
        }

        @keyframes pulse-gla {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.08); }
        }

        @keyframes bounce-small {
            0%, 100% { transform: translate(-50%, 0); }
            50% { transform: translate(-50%, -6px); }
        }

        /* Node Hover Effects */
        .level-node:not(.locked):hover {
            transform: scale(1.1);
            box-shadow: 0 14px 30px rgba(6, 78, 59, 0.15);
            z-index: 10;
        }

        /* Node labels and details */
        .node-label {
            position: absolute;
            bottom: -32px;
            font-family: 'Outfit', sans-serif;
            font-size: 0.72em;
            font-weight: 800;
            background: var(--card);
            border: 1px solid var(--border);
            color: var(--green-dark);
            padding: 4px 16px;
            border-radius: 20px;
            white-space: nowrap;
            box-shadow: 0 4px 10px rgba(0,0,0,0.02);
            transition: all 0.3s;
        }

        .level-node:hover .node-label {
            background: var(--green-dark);
            color: white;
            border-color: var(--green-dark);
        }

        /* Stars on completed node */
        .node-stars {
            position: absolute;
            top: -18px;
            display: flex;
            gap: 2px;
            filter: drop-shadow(0 2px 5px rgba(217, 119, 6, 0.25));
        }

        .node-stars i {
            color: var(--gold-light);
            font-size: 0.88rem;
        }

        @media(max-width: 600px) {
            .level-node-wrapper:nth-child(odd) { transform: translateX(-45px); }
            .level-node-wrapper:nth-child(even) { transform: translateX(45px); }
            .level-node-wrapper:nth-child(odd)::after,
            .level-node-wrapper:nth-child(even)::after { display: none; }
            .level-node { width: 92px; height: 92px; }
            .level-node.unlocked::before { inset: -8px; }
            .level-node.unlocked::after { inset: -4px; }
            .roadmap-container::before { width: 4px; }
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
            <a href="{{ route('user.materi.index') }}" class="btn-nav"><i class="fas fa-arrow-left"></i> Pelajaran</a>
            <a href="{{ route('index') }}" class="btn-nav"><i class="fas fa-home"></i></a>
            @if(Auth::check())
                <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display:none;">@csrf</form>
                <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn-nav btn-out"><i class="fas fa-power-off"></i> Keluar</a>
            @endif
        </div>
    </div>

    <div class="container">
        @php
            $totalMateri = count($materiStatus);
            $completedMateri = collect($materiStatus)->where('is_completed', true)->count();
            $progressPercent = $totalMateri > 0 ? round(($completedMateri / $totalMateri) * 100) : 0;
        @endphp

        <!-- Subject details card -->
        <div class="course-header-card">
            <span class="course-badge">Kelas {{ $mapel->kelas }}</span>
            <h1 class="course-title">{{ $mapel->nama_mapel }}</h1>
            <p class="course-subtitle">Selesaikan setiap bab materi dan kerjakan kuisnya untuk membuka bab selanjutnya.</p>

            <!-- Learning path completion indicator -->
            <div class="map-progress-box">
                <div class="progress-circle">
                    <span>{{ $progressPercent }}%</span>
                </div>
                <div class="progress-text-info">
                    <div class="progress-label">Progres Kursus</div>
                    <div class="progress-desc">{{ $completedMateri }} dari {{ $totalMateri }} Bab Selesai</div>
                </div>
                <div class="map-progress-bar-container">
                    <div class="map-progress-bar-fill" style="width: {{ $progressPercent }}%;"></div>
                </div>
            </div>
        </div>

        @if(session('error'))<div class="alert alert-err"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>@endif
        @if(session('success'))<div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>@endif

        <!-- Roadmap -->
        <div class="roadmap-container">
            @foreach($materiStatus as $index => $item)
            <div class="level-node-wrapper">
                @if($item->is_unlocked)
                    <a href="{{ route('user.materi.show', $item->materi->id) }}"
                       class="level-node {{ $item->is_completed ? 'completed' : 'unlocked' }}">
                        
                        @if($item->is_completed)
                            <div class="node-stars">
                                @for($s = 0; $s < $item->stars; $s++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </div>
                            <span class="node-icon"><i class="fas fa-check-circle"></i></span>
                        @else
                            <!-- Active/Current Node -->
                            <span class="active-tooltip">Ayo Mulai!</span>
                            <div class="node-num">{{ $index + 1 }}</div>
                            <span class="node-icon"><i class="fas fa-play-circle"></i></span>
                        @endif
                        
                        <div class="node-label">{{ Str::limit($item->materi->bab, 16) }}</div>
                    </a>
                @else
                    <!-- Locked Node -->
                    <div class="level-node locked" onclick="alert('Selesaikan kuis bab sebelumnya terlebih dahulu!')">
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
