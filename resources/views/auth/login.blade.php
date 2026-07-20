<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masjid Nurul Iman Sungai Perupuk — Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        :root {
            --green-dark: #0d5c54;
            --green-mid: #0f766e;
            --green-light: #0d9488;
            --green-bright: #2dd4bf;
            --gold: #d97706;
            --gold-light: #f59e0b;
            --cream: #ccfbf1;
            --white: #ffffff;
            --text-dark: #1a1a2e;
            --text-muted: #6b7280;
            --border: rgba(255,255,255,0.15);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #0d5c54 0%, #0f766e 40%, #115e59 70%, #0d9488 100%);
        }

        /* Decorative circles */
        .bg-circle {
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
        }
        .bc1 {
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(45,212,191,0.25) 0%, transparent 70%);
            top: -200px; left: -200px;
            animation: pulse1 8s ease-in-out infinite;
        }
        .bc2 {
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(217,119,6,0.2) 0%, transparent 70%);
            bottom: -150px; right: -150px;
            animation: pulse2 10s ease-in-out infinite;
        }
        .bc3 {
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(245,158,11,0.15) 0%, transparent 70%);
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            animation: pulse1 12s ease-in-out infinite reverse;
        }
        @keyframes pulse1 {
            0%, 100% { transform: scale(1) translate(0,0); }
            50% { transform: scale(1.1) translate(20px,-20px); }
        }
        @keyframes pulse2 {
            0%, 100% { transform: scale(1) translate(0,0); }
            50% { transform: scale(1.08) translate(-20px,20px); }
        }

        /* Islamic pattern overlay */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                repeating-linear-gradient(45deg, rgba(255,255,255,0.015) 0px, rgba(255,255,255,0.015) 1px, transparent 1px, transparent 30px),
                repeating-linear-gradient(-45deg, rgba(255,255,255,0.015) 0px, rgba(255,255,255,0.015) 1px, transparent 1px, transparent 30px);
            pointer-events: none;
        }

        .wrapper {
            display: flex;
            gap: 0;
            width: 100%;
            max-width: 900px;
            min-height: 540px;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(0,0,0,0.4), 0 0 0 1px rgba(255,255,255,0.08);
            position: relative;
            z-index: 1;
            margin: 20px;
        }

        /* Left panel - branding */
        .panel-left {
            flex: 1;
            background: linear-gradient(160deg, rgba(13,92,84,0.95) 0%, rgba(15,118,110,0.9) 100%);
            backdrop-filter: blur(20px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 50px 40px;
            text-align: center;
            border-right: 1px solid rgba(255,255,255,0.1);
            position: relative;
            overflow: hidden;
        }
        .panel-left::before {
            content: '\f186';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            font-size: 200px;
            color: rgba(255,255,255,0.03);
            top: -30px;
            right: -30px;
            line-height: 1;
        }
        .panel-left::after {
            content: '\f005';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            font-size: 120px;
            color: rgba(245,158,11,0.06);
            bottom: 20px;
            left: 10px;
            line-height: 1;
        }

        .school-emblem {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5em;
            margin-bottom: 24px;
            box-shadow: 0 0 30px rgba(217,119,6,0.5), 0 0 60px rgba(217,119,6,0.2);
            animation: glow 3s ease-in-out infinite alternate;
        }
        @keyframes glow {
            from { box-shadow: 0 0 20px rgba(217,119,6,0.4), 0 0 40px rgba(217,119,6,0.15); }
            to { box-shadow: 0 0 40px rgba(217,119,6,0.7), 0 0 80px rgba(217,119,6,0.3); }
        }

        .school-name {
            font-family: 'Poppins', sans-serif;
            font-size: 1.4em;
            font-weight: 800;
            color: var(--white);
            letter-spacing: 1px;
            line-height: 1.3;
            margin-bottom: 8px;
        }
        .school-name span {
            color: var(--gold-light);
        }
        .school-location {
            font-size: 0.85em;
            color: rgba(255,255,255,0.65);
            font-weight: 400;
            margin-bottom: 28px;
        }
        .tagline {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 12px;
            padding: 14px 20px;
            font-size: 0.82em;
            color: rgba(255,255,255,0.8);
            line-height: 1.7;
            font-style: italic;
        }
        .tagline strong {
            color: var(--gold-light);
            font-style: normal;
        }

        /* Right panel - form */
        .panel-right {
            flex: 1.1;
            background: rgba(255,255,255,0.97);
            backdrop-filter: blur(20px);
            padding: 50px 44px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-title {
            font-size: 1.7em;
            font-weight: 700;
            color: var(--green-dark);
            margin-bottom: 4px;
        }
        .form-subtitle {
            font-size: 0.85em;
            color: var(--text-muted);
            margin-bottom: 30px;
        }

        .alert-err {
            background: rgba(239,68,68,0.08);
            border: 1px solid rgba(239,68,68,0.3);
            color: #dc2626;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: .85em;
            margin-bottom: 18px;
        }
        .alert-err ul { list-style: none; padding: 0; }

        .form-group { margin-bottom: 18px; }

        .form-label {
            display: block;
            font-size: .8em;
            font-weight: 600;
            color: var(--green-dark);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 8px;
        }

        .input-wrap {
            position: relative;
        }
        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--green-light);
            font-size: 0.9em;
        }

        .form-input {
            width: 100%;
            background: #f0fdfa;
            border: 1.5px solid #ccfbf1;
            color: var(--text-dark);
            padding: 12px 16px 12px 40px;
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: .92em;
            outline: none;
            transition: all 0.25s;
        }
        .form-input:focus {
            border-color: var(--green-bright);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(13,148,136,0.12);
        }
        .form-input::placeholder { color: #9ca3af; }

        .pw-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            font-size: 0.9em;
            transition: .2s;
            padding: 4px;
        }
        .pw-toggle:hover { color: var(--green-light); }

        .btn-login {
            width: 100%;
            padding: 14px;
            margin-top: 8px;
            background: linear-gradient(135deg, var(--green-dark) 0%, var(--green-light) 100%);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: .95em;
            font-weight: 600;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(6,78,59,0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(6,78,59,0.45);
            background: linear-gradient(135deg, var(--green-mid) 0%, var(--green-bright) 100%);
        }

        .divider {
            border: none;
            border-top: 1px solid #e5e7eb;
            margin: 24px 0 0;
        }

        @media (max-width: 640px) {
            .panel-left { display: none; }
            .panel-right { padding: 36px 28px; }
            .wrapper { max-width: 420px; }
        }
    </style>
</head>

<body>
    <div class="bg-circle bc1"></div>
    <div class="bg-circle bc2"></div>
    <div class="bg-circle bc3"></div>

    <div class="wrapper">
        <!-- Left branding panel -->
        <div class="panel-left">
            <div class="school-emblem" style="color:white;font-size:2.5em;margin-bottom:15px;"><i class="fa-solid fa-mosque"></i></div>
            <div class="school-name">Masjid <span>Nurul Iman</span></div>
            <div class="school-name" style="font-size:1.1em; margin-top:-6px;">Sungai Perupuk</div>
            <div class="school-location">Kota Padang, Sumatera Barat</div>
            <div class="tagline">
                <strong>Tabungan Qurban</strong><br>
                Sistem pengelolaan tabungan qurban jamaah Masjid Nurul Iman Sungai Perupuk
            </div>
        </div>

        <!-- Right form panel -->
        <div class="panel-right">
            <div class="form-title">Selamat Datang!</div>
            <div class="form-subtitle">Masuk ke Panel Pengelolaan Tabungan Qurban</div>

            @if ($errors->any())
                <div class="alert-err">
                    <ul>
                        @foreach ($errors->all() as $e)
                            <li><i class="fas fa-exclamation-circle"></i> {{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @include('sweetalert::alert')

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label"><i class="fas fa-user"></i> Username</label>
                    <div class="input-wrap">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" name="username" class="form-input" placeholder="Masukkan username"
                            value="{{ old('username') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label"><i class="fas fa-lock"></i> Password</label>
                    <div class="input-wrap">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" name="password" id="pw" class="form-input"
                            placeholder="Masukkan password" required style="padding-right:44px;">
                        <button type="button" class="pw-toggle" onclick="togglePw()">
                            <i class="fas fa-eye" id="pwIcon"></i>
                        </button>
                    </div>
                </div>
                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Masuk Sekarang
                </button>
            </form>

            <hr class="divider">
        </div>
    </div>

    <script>
        function togglePw() {
            var p = document.getElementById('pw');
            var i = document.getElementById('pwIcon');
            p.type = p.type === 'password' ? 'text' : 'password';
            i.className = p.type === 'password' ? 'fas fa-eye' : 'fas fa-eye-slash';
        }
    </script>
</body>

</html>
