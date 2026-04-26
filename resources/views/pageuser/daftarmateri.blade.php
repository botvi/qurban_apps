<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $materi->judul }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #FF9A9E 0%, #FECFEF 99%, #FECFEF 100%);
            min-height: 100vh;
            color: #333;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.9);
            padding: 15px 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .back-btn {
            font-family: 'Fredoka One', cursive;
            text-decoration: none;
            color: #FF6B6B;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: transform 0.2s;
        }

        .back-btn:hover {
            transform: translateX(-5px);
        }

        .content-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .materi-card {
            background: #FFF;
            border-radius: 30px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            border: 8px solid rgba(255, 255, 255, 0.5);
            background-clip: padding-box;
        }

        .materi-header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 4px dashed #FECFEF;
        }

        .materi-header h1 {
            font-family: 'Fredoka One', cursive;
            color: #FF6B6B;
            font-size: 2.5rem;
            margin: 0 0 10px 0;
        }

        .materi-header .bab-badge {
            background: #4ECDC4;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: 900;
            display: inline-block;
            margin-bottom: 10px;
            font-family: 'Fredoka One', cursive;
        }

        .materi-body {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #444;
        }

        .materi-body img {
            max-width: 100%;
            height: auto;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin: 20px 0;
        }

        .action-area {
            text-align: center;
            margin-top: 50px;
        }

        .btn-quiz {
            display: inline-block;
            background: #FFD166;
            color: #333;
            font-family: 'Fredoka One', cursive;
            font-size: 1.5rem;
            padding: 15px 40px;
            border-radius: 40px;
            text-decoration: none;
            box-shadow: 0 8px 0 #E5B85C, 0 15px 20px rgba(0,0,0,0.2);
            transition: all 0.2s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-quiz:hover {
            transform: translateY(4px);
            box-shadow: 0 4px 0 #E5B85C, 0 10px 15px rgba(0,0,0,0.2);
        }

        .btn-quiz:active {
            transform: translateY(8px);
            box-shadow: 0 0px 0 #E5B85C, 0 5px 10px rgba(0,0,0,0.2);
        }

        .btn-quiz i {
            margin-left: 10px;
        }
        
        /* Alert */
        .alert {
            background: #FF6B6B;
            color: white;
            padding: 15px 30px;
            border-radius: 30px;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 1.2rem;
            text-align: center;
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="{{ route('user.materi.index') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Peta Belajar
        </a>
        <div style="font-family: 'Fredoka One'; color: #4ECDC4; font-size: 1.2rem;">
            Zona Belajar
        </div>
    </nav>

    <div class="content-container">
        @if(session('error'))
            <div class="alert">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        <div class="materi-card">
            <div class="materi-header">
                <div class="bab-badge">{{ $materi->bab }}</div>
                <h1>{{ $materi->judul }}</h1>
                <p style="color: #888; font-style: italic;">{{ $materi->deskripsi }}</p>
            </div>
            
            <div class="materi-body">
                {!! $materi->isi_materi !!}
            </div>
            
            <div class="action-area">
                <a href="{{ route('user.materi.quiz', $materi->id) }}" class="btn-quiz">
                    Lanjut Kuis! <i class="fas fa-gamepad"></i>
                </a>
            </div>
        </div>
    </div>

</body>
</html>
