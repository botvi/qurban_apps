<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduVerse — Login</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600;700;900&family=Nunito:wght@400;600;700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg: #050a18;
            --card: #0d1526;
            --border: #1a2d55;
            --nb: #00c8ff;
            --np: #a855f7;
            --ng: #00ff88;
            --tx: #e2e8f0;
            --mu: #64748b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: var(--bg);
            color: var(--tx);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: linear-gradient(rgba(0, 200, 255, .05) 1px, transparent 1px), linear-gradient(90deg, rgba(0, 200, 255, .05) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: grid 25s linear infinite;
            pointer-events: none;
        }

        @keyframes grid {
            to {
                transform: translateY(50px)
            }
        }

        .orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(100px);
            opacity: .15;
            pointer-events: none;
        }

        .o1 {
            width: 450px;
            height: 450px;
            background: var(--nb);
            top: -150px;
            left: -150px;
            animation: fl 10s ease-in-out infinite;
        }

        .o2 {
            width: 400px;
            height: 400px;
            background: var(--np);
            bottom: -130px;
            right: -130px;
            animation: fl 8s ease-in-out infinite reverse;
        }

        @keyframes fl {

            0%,
            100% {
                transform: translate(0, 0)
            }

            50% {
                transform: translate(25px, -25px)
            }
        }

        .card {
            background: rgba(13, 21, 38, .85);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 44px 40px;
            width: 100%;
            max-width: 440px;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(16px);
            box-shadow: 0 0 60px rgba(0, 200, 255, .08), 0 0 0 1px rgba(0, 200, 255, .07);
            animation: popIn .6s cubic-bezier(.175, .885, .32, 1.275);
            margin: 20px;
        }

        @keyframes popIn {
            0% {
                transform: scale(.9);
                opacity: 0
            }

            100% {
                transform: scale(1);
                opacity: 1
            }
        }

        .brand {
            text-align: center;
            margin-bottom: 30px;
        }

        .brand-logo {
            height: 64px;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .brand-name {
            font-family: 'Orbitron', monospace;
            font-size: 1.6em;
            font-weight: 900;
            background: linear-gradient(135deg, var(--nb), var(--np));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: 3px;
        }

        .brand-sub {
            color: var(--mu);
            font-size: .88em;
            margin-top: 4px;
        }

        .alert-err {
            background: rgba(255, 79, 123, .1);
            border: 1px solid rgba(255, 79, 123, .4);
            color: #ff7fa0;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: .88em;
            margin-bottom: 18px;
        }

        .alert-err ul {
            list-style: none;
            padding: 0;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            font-size: .82em;
            font-weight: 700;
            color: var(--mu);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 7px;
        }

        .form-input {
            width: 100%;
            background: rgba(255, 255, 255, .04);
            border: 1px solid var(--border);
            color: var(--tx);
            padding: 12px 16px;
            border-radius: 12px;
            font-family: 'Nunito';
            font-size: .95em;
            outline: none;
            transition: .2s;
        }

        .form-input:focus {
            border-color: var(--nb);
            box-shadow: 0 0 14px rgba(0, 200, 255, .15);
        }

        .form-input::placeholder {
            color: var(--mu);
        }

        .pw-wrap {
            position: relative;
        }

        .pw-wrap .form-input {
            padding-right: 44px;
        }

        .pw-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--mu);
            cursor: pointer;
            font-size: 1em;
            transition: .2s;
        }

        .pw-toggle:hover {
            color: var(--nb);
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            margin-top: 6px;
            background: linear-gradient(135deg, var(--nb), var(--np));
            color: #fff;
            border: none;
            border-radius: 12px;
            font-family: 'Orbitron', monospace;
            font-size: .9em;
            font-weight: 700;
            letter-spacing: 2px;
            cursor: pointer;
            transition: .3s;
            box-shadow: 0 0 20px rgba(0, 200, 255, .25);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 30px rgba(0, 200, 255, .4);
        }

        .footer-link {
            text-align: center;
            margin-top: 20px;
            font-size: .88em;
            color: var(--mu);
        }

        .footer-link a {
            color: var(--nb);
            font-weight: 700;
            text-decoration: none;
            transition: .2s;
        }

        .footer-link a:hover {
            color: var(--np);
        }

        .divider {
            border: none;
            border-top: 1px solid var(--border);
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="orb o1"></div>
    <div class="orb o2"></div>

    <div class="card">
        <div class="brand">
            <img src="{{ asset('env/logo.png') }}" alt="EduVerse" class="brand-logo">
            <div class="brand-name">EDUVERSE</div>
            <div class="brand-sub">Platform Belajar Interaktif Generasi Z</div>
        </div>

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
                <label class="form-label"><i class="fas fa-user"></i> Username atau Email</label>
                <input type="text" name="username" class="form-input" placeholder="Masukkan username atau email"
                    value="{{ old('username') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label"><i class="fas fa-lock"></i> Password</label>
                <div class="pw-wrap">
                    <input type="password" name="password" id="pw" class="form-input"
                        placeholder="Masukkan password" required>
                    <button type="button" class="pw-toggle" onclick="togglePw()"><i class="fas fa-eye"
                            id="pwIcon"></i></button>
                </div>
            </div>
            <button type="submit" class="btn-login"><i class="fas fa-sign-in-alt"></i> &nbsp; MASUK</button>
        </form>

        <hr class="divider">
        {{-- <div class="footer-link">Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a></div> --}}
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
