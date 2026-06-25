<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Bukti Transfer — Tabungan Qurban Masjid Nurul Iman</title>
    <meta name="description" content="Form upload bukti transfer tabungan qurban Masjid Nurul Iman Sungai Perupuk.">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        :root {
            --green-dark:  #064e3b;
            --green-mid:   #0f766e;
            --green-light: #0d9488;
            --green-bright:#2dd4bf;
            --gold:        #d97706;
            --gold-light:  #f59e0b;
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family:'Poppins',sans-serif;
            min-height:100vh;
            background:linear-gradient(135deg,#064e3b 0%,#0f766e 40%,#115e59 70%,#0d9488 100%);
            display:flex;
            flex-direction:column;
        }
        body::before {
            content:'';
            position:fixed;
            inset:0;
            background-image:
                repeating-linear-gradient(45deg,rgba(255,255,255,.012) 0,rgba(255,255,255,.012) 1px,transparent 1px,transparent 30px),
                repeating-linear-gradient(-45deg,rgba(255,255,255,.012) 0,rgba(255,255,255,.012) 1px,transparent 1px,transparent 30px);
            pointer-events:none;
        }

        /* Navbar */
        .top-bar {
            background:rgba(6,78,59,.9);
            backdrop-filter:blur(12px);
            border-bottom:1px solid rgba(255,255,255,.08);
            padding:14px 5%;
            display:flex;
            align-items:center;
            justify-content:space-between;
        }
        .top-brand {
            display:flex;
            align-items:center;
            gap:10px;
            text-decoration:none;
        }
        .brand-icon {
            width:36px;height:36px;
            background:linear-gradient(135deg,#d97706,#f59e0b);
            border-radius:8px;
            display:flex;align-items:center;justify-content:center;
            font-size:1.1em;
        }
        .brand-info .t1{font-size:.78em;font-weight:800;color:#f59e0b;}
        .brand-info .t2{font-size:.65em;color:rgba(255,255,255,.55);}
        .top-back {
            display:inline-flex;align-items:center;gap:6px;
            color:rgba(255,255,255,.75);text-decoration:none;
            font-size:.82em;font-weight:500;
            background:rgba(255,255,255,.1);
            padding:7px 14px;border-radius:8px;
            transition:.2s;
        }
        .top-back:hover{background:rgba(255,255,255,.18);color:#fff;}

        /* Main */
        .page-wrap {
            flex:1;
            display:flex;
            align-items:flex-start;
            justify-content:center;
            padding:40px 5%;
            position:relative;
            z-index:1;
        }
        .form-container {
            background:#fff;
            border-radius:24px;
            overflow:hidden;
            width:100%;
            max-width:720px;
            box-shadow:0 30px 80px rgba(0,0,0,0.35);
        }
        .form-header {
            background:linear-gradient(135deg,#064e3b,#0f766e);
            padding:32px 36px;
            text-align:center;
            position:relative;
            overflow:hidden;
        }
        .form-header::before {
            content:'\f666';
            font-family:'Font Awesome 6 Free';
            font-weight:900;
            position:absolute;
            font-size:6em;
            opacity:.06;
            right:-20px;
            top:-10px;
            line-height:1;
        }
        .form-header h1 {
            font-size:1.5em;
            font-weight:800;
            color:#fff;
            margin-bottom:6px;
        }
        .form-header p {
            font-size:.82em;
            color:rgba(255,255,255,.7);
        }
        .form-body { padding:36px; }

        .alert-err {
            background:rgba(239,68,68,.08);
            border:1px solid rgba(239,68,68,.3);
            color:#dc2626;
            padding:14px 16px;
            border-radius:12px;
            margin-bottom:24px;
            font-size:.85em;
        }
        .alert-err ul{list-style:none;padding:0;}
        .alert-err ul li{margin-bottom:4px;}

        .alert-info {
            background:rgba(245,158,11,.08);
            border:1px solid rgba(245,158,11,.3);
            color:#b45309;
            padding:14px 16px;
            border-radius:12px;
            margin-bottom:24px;
            font-size:.83em;
            line-height:1.7;
        }
        .alert-info strong{color:var(--gold);}

        .form-group{margin-bottom:20px;}
        .form-label{
            display:block;
            font-size:.78em;
            font-weight:700;
            color:var(--green-dark);
            text-transform:uppercase;
            letter-spacing:.8px;
            margin-bottom:7px;
        }
        .input-wrap{position:relative;}
        .input-icon{
            position:absolute;left:13px;top:50%;
            transform:translateY(-50%);
            color:var(--green-light);font-size:.9em;
        }
        .form-input, .form-select, .form-textarea {
            width:100%;
            background:#f0fdfa;
            border:1.5px solid #ccfbf1;
            color:#1a1a2e;
            padding:11px 14px 11px 38px;
            border-radius:12px;
            font-family:'Poppins',sans-serif;
            font-size:.9em;
            outline:none;
            transition:.25s;
        }
        .form-select{padding-left:38px;}
        .form-textarea{padding-left:14px;resize:vertical;min-height:80px;}
        .form-input:focus,.form-select:focus,.form-textarea:focus {
            border-color:var(--green-bright);
            background:#fff;
            box-shadow:0 0 0 3px rgba(13,148,136,.12);
        }
        .form-input.is-invalid,.form-select.is-invalid {
            border-color:#ef4444;
        }
        .invalid-msg{font-size:.78em;color:#dc2626;margin-top:4px;}

        .row-2{display:grid;grid-template-columns:1fr 1fr;gap:16px;}

        /* Autocomplete Search */
        .search-wrap { position: relative; }
        .search-input {
            width:100%;
            background:#f0fdfa;
            border:1.5px solid #ccfbf1;
            color:#1a1a2e;
            padding:11px 14px 11px 38px;
            border-radius:12px;
            font-family:'Poppins',sans-serif;
            font-size:.9em;
            outline:none;
            transition:.25s;
        }
        .search-input:focus {
            border-color:var(--green-bright);
            background:#fff;
            box-shadow:0 0 0 3px rgba(13,148,136,.12);
        }
        .search-input.is-invalid { border-color:#ef4444; }
        .search-input.found {
            border-color:#10b981;
            background:#f0fdf4;
            box-shadow:0 0 0 3px rgba(16,185,129,.12);
        }
        .autocomplete-list {
            position:absolute;
            top:calc(100% + 6px);
            left:0;right:0;
            background:#fff;
            border:1.5px solid #ccfbf1;
            border-radius:14px;
            box-shadow:0 12px 36px rgba(0,0,0,.12);
            z-index:999;
            overflow:hidden;
            display:none;
            max-height:280px;
            overflow-y:auto;
        }
        .autocomplete-list.show { display:block; }
        .ac-item {
            padding:12px 16px;
            cursor:pointer;
            border-bottom:1px solid #f0fdfa;
            transition:.15s;
            display:flex;
            align-items:center;
            gap:12px;
        }
        .ac-item:last-child { border-bottom:none; }
        .ac-item:hover, .ac-item.active { background:#f0fdfa; }
        .ac-avatar {
            width:36px;height:36px;flex-shrink:0;
            background:linear-gradient(135deg,#0f766e,#0d9488);
            border-radius:50%;
            display:flex;align-items:center;justify-content:center;
            color:#fff;font-weight:700;font-size:.85em;
        }
        .ac-info .ac-name { font-size:.88em; font-weight:700; color:#064e3b; }
        .ac-info .ac-nik  { font-size:.76em; color:#6b7280; margin-top:1px; }
        .ac-empty {
            padding:16px;
            text-align:center;
            font-size:.82em;
            color:#6b7280;
            font-style:italic;
        }
        .ac-loading {
            padding:14px 16px;
            text-align:center;
            font-size:.82em;
            color:#0d9488;
        }
        .selected-badge {
            display:none;
            align-items:center;
            gap:8px;
            background:#f0fdf4;
            border:1.5px solid #10b981;
            border-radius:10px;
            padding:9px 14px;
            margin-top:8px;
            font-size:.82em;
        }
        .selected-badge.show { display:flex; }
        .selected-badge .badge-name { font-weight:700; color:#064e3b; }
        .selected-badge .badge-nik  { color:#6b7280; font-size:.9em; }
        .selected-badge .badge-clear {
            margin-left:auto;
            background:none;border:none;
            color:#6b7280;cursor:pointer;
            font-size:.9em;padding:2px 6px;
            border-radius:6px;transition:.15s;
        }
        .selected-badge .badge-clear:hover { background:#fee2e2;color:#dc2626; }

        /* File Upload Zone */
        .upload-zone {
            border:2px dashed #99f6e4;
            border-radius:14px;
            padding:32px 20px;
            text-align:center;
            background:#f0fdfa;
            cursor:pointer;
            transition:.25s;
            position:relative;
        }
        .upload-zone:hover,.upload-zone.drag-over {
            border-color:var(--green-light);
            background:#e6faf7;
        }
        .upload-zone input[type="file"] {
            position:absolute;inset:0;
            opacity:0;cursor:pointer;width:100%;height:100%;
        }
        .upload-icon{font-size:2.5em;margin-bottom:10px;}
        .upload-zone h4{font-size:.92em;font-weight:700;color:var(--green-dark);margin-bottom:4px;}
        .upload-zone p{font-size:.78em;color:#6b7280;}
        .preview-wrap{margin-top:14px;display:none;}
        .preview-wrap img{width:100%;max-height:220px;object-fit:contain;border-radius:10px;border:1px solid #99f6e4;}
        .preview-name{font-size:.78em;color:var(--green-mid);margin-top:6px;font-weight:600;}

        /* Submit button */
        .btn-submit {
            width:100%;
            padding:15px;
            background:linear-gradient(135deg,var(--green-dark),var(--green-light));
            color:#fff;border:none;border-radius:12px;
            font-family:'Poppins',sans-serif;
            font-size:.95em;font-weight:700;
            cursor:pointer;transition:.3s;
            box-shadow:0 4px 16px rgba(6,78,59,.3);
            display:flex;align-items:center;justify-content:center;gap:10px;
            margin-top:8px;
        }
        .btn-submit:hover{
            transform:translateY(-2px);
            box-shadow:0 8px 24px rgba(6,78,59,.45);
        }
        .btn-submit:disabled{opacity:.6;cursor:not-allowed;transform:none;}

        /* Rekening hint */
        .rekening-hint{
            background:linear-gradient(135deg,#064e3b,#0f766e);
            border-radius:14px;
            padding:20px;
            color:#fff;
            margin-bottom:24px;
            font-size:.82em;
        }
        .rekening-hint h4{font-weight:700;margin-bottom:10px;font-size:.9em;color:var(--gold-light);}
        .rek-item{display:flex;justify-content:space-between;align-items:center;margin-bottom:6px;padding:8px 12px;background:rgba(255,255,255,.1);border-radius:8px;}
        .rek-item span:first-child{color:rgba(255,255,255,.65);font-size:.85em;}
        .rek-item span:last-child{font-weight:700;color:#fff;letter-spacing:1.5px;}

        @media(max-width:600px){
            .row-2{grid-template-columns:1fr;}
            .form-body{padding:24px 20px;}
            .form-header{padding:24px 20px;}
        }
    </style>
</head>
<body>
    <!-- Top bar -->
    <div class="top-bar">
        <a href="{{ route('landing') }}" class="top-brand">
            <div class="brand-icon"><i class="fa-solid fa-mosque"></i></div>
            <div class="brand-info">
                <div class="t1">MASJID NURUL IMAN</div>
                <div class="t2">Tabungan Qurban</div>
            </div>
        </a>
        <a href="{{ route('landing') }}" class="top-back">
            <i class="fas fa-arrow-left"></i> Kembali ke Beranda
        </a>
    </div>

    <div class="page-wrap">
        <div class="form-container">
            <div class="form-header">
                <div style="font-size:2em;margin-bottom:10px;color:white;"><i class="fa-solid fa-money-bill-wave"></i></div>
                <h1>Kirim Bukti Transfer</h1>
                <p>Upload bukti transfer tabungan qurban Anda untuk diverifikasi oleh pengurus masjid.</p>
            </div>

            <div class="form-body">
                <!-- Info rekening -->
                <div class="rekening-hint">
                    <h4><i class="fas fa-university"></i> Rekening Tujuan Masjid Nurul Iman</h4>
                    <div class="rek-item">
                        <span>Bank Nagari</span>
                        <span>2100 1234 5678</span>
                    </div>
                    <div class="rek-item">
                        <span>Bank BRI</span>
                        <span>0032 0100 0012 309</span>
                    </div>
                    <div style="margin-top:8px;font-size:.8em;color:rgba(255,255,255,.6);">
                        a.n. Masjid Nurul Iman Sungai Perupuk
                    </div>
                </div>

                <div class="alert-info">
                    <strong><i class="fa-solid fa-circle-info me-1"></i> Petunjuk Pengisian:</strong><br>
                    Pastikan nama peserta yang Anda pilih sudah terdaftar sebagai peserta tabungan qurban.
                    Jika belum terdaftar, silakan hubungi pengurus masjid untuk pendaftaran terlebih dahulu.
                </div>

                @if($errors->any())
                <div class="alert-err">
                    <ul>
                        @foreach($errors->all() as $err)
                        <li><i class="fas fa-exclamation-circle"></i> {{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('transfer.store') }}" enctype="multipart/form-data" id="tfForm">
                    @csrf

                    <!-- Peserta — Live Search Autocomplete -->
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-search"></i> Cari Nama atau NIK Peserta</label>

                        {{-- Hidden field yang dikirim ke server --}}
                        <input type="hidden" name="participant_id" id="participant_id"
                            value="{{ old('participant_id') }}">

                        <div class="search-wrap">
                            <i class="fas fa-search input-icon" style="pointer-events:none;"></i>
                            <input type="text" id="pesertaSearch"
                                class="search-input @error('participant_id') is-invalid @enderror"
                                placeholder="Ketik nama atau NIK peserta..."
                                autocomplete="off"
                                value="{{ old('participant_id') ? ($participants->firstWhere('id', old('participant_id'))->nama ?? '') : '' }}">

                            <div class="autocomplete-list" id="acList"></div>
                        </div>

                        {{-- Badge peserta terpilih --}}
                        <div class="selected-badge" id="selectedBadge">
                            <i class="fas fa-check-circle" style="color:#10b981;"></i>
                            <div>
                                <div class="badge-name" id="badgeName"></div>
                                <div class="badge-nik" id="badgeNik"></div>
                            </div>
                            <button type="button" class="badge-clear" onclick="clearPeserta()" title="Ubah peserta">
                                <i class="fas fa-times"></i> Ubah
                            </button>
                        </div>

                        @error('participant_id')
                        <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                        <div class="invalid-msg" id="notFoundMsg" style="display:none;">
                            <i class="fas fa-exclamation-circle"></i>
                            Peserta tidak ditemukan. Hubungi pengurus masjid untuk mendaftar terlebih dahulu.
                        </div>
                    </div>

                    <!-- Jumlah & Tanggal -->
                    <div class="row-2">
                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-money-bill"></i> Jumlah Transfer (Rp)</label>
                            <div class="input-wrap">
                                <i class="fas fa-rupiah-sign input-icon"></i>
                                <input type="number" name="jumlah" id="jumlah"
                                    class="form-input @error('jumlah') is-invalid @enderror"
                                    value="{{ old('jumlah') }}"
                                    placeholder="Contoh: 500000"
                                    min="10000" required>
                            </div>
                            @error('jumlah')
                            <div class="invalid-msg">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-calendar"></i> Tanggal Transfer</label>
                            <div class="input-wrap">
                                <i class="fas fa-calendar-alt input-icon"></i>
                                <input type="date" name="tanggal_transfer" id="tanggal_transfer"
                                    class="form-input @error('tanggal_transfer') is-invalid @enderror"
                                    value="{{ old('tanggal_transfer', date('Y-m-d')) }}" required>
                            </div>
                            @error('tanggal_transfer')
                            <div class="invalid-msg">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- No Rekening & Bank -->
                    <div class="row-2">
                        <div class="form-group">
                            <label class="form-label">No. Rekening Pengirim</label>
                            <div class="input-wrap">
                                <i class="fas fa-credit-card input-icon"></i>
                                <input type="text" name="no_rekening_pengirim"
                                    class="form-input @error('no_rekening_pengirim') is-invalid @enderror"
                                    value="{{ old('no_rekening_pengirim') }}"
                                    placeholder="Opsional">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nama Bank Pengirim</label>
                            <div class="input-wrap">
                                <i class="fas fa-building-columns input-icon"></i>
                                <input type="text" name="nama_bank"
                                    class="form-input @error('nama_bank') is-invalid @enderror"
                                    value="{{ old('nama_bank') }}"
                                    placeholder="Contoh: BRI, BNI, Mandiri">
                            </div>
                        </div>
                    </div>

                    <!-- Upload Bukti TF -->
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-image"></i> Upload Bukti Transfer <span style="color:#ef4444;">*</span></label>
                        <div class="upload-zone" id="uploadZone">
                            <input type="file" name="bukti_tf" id="bukti_tf" accept="image/*" required>
                            <div class="upload-icon"><i class="fa-solid fa-paperclip" style="color:var(--green-light);"></i></div>
                            <h4>Klik atau seret foto bukti transfer ke sini</h4>
                            <p>Format: JPG, PNG, WEBP &bull; Maks. 5 MB</p>
                            <div class="preview-wrap" id="previewWrap">
                                <img id="imgPreview" src="#" alt="Preview">
                                <div class="preview-name" id="fileName"></div>
                            </div>
                        </div>
                        @error('bukti_tf')
                        <div class="invalid-msg">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Keterangan -->
                    <div class="form-group">
                        <label class="form-label">Keterangan Tambahan</label>
                        <textarea name="keterangan" class="form-textarea"
                            placeholder="Contoh: Setoran tabungan bulan Juni, untuk kategori kambing...">{{ old('keterangan') }}</textarea>
                    </div>

                    <button type="submit" class="btn-submit" id="submitBtn">
                        <i class="fas fa-paper-plane"></i>
                        Kirim Bukti Transfer
                    </button>
                </form>
            </div>
        </div>
    </div>

<script>
    // ===== File Preview =====
    const fileInput = document.getElementById('bukti_tf');
    const preview   = document.getElementById('imgPreview');
    const prevWrap  = document.getElementById('previewWrap');
    const fileName  = document.getElementById('fileName');
    const zone      = document.getElementById('uploadZone');

    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const f = this.files[0];
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                prevWrap.style.display = 'block';
                fileName.textContent = f.name + ' (' + (f.size/1024/1024).toFixed(2) + ' MB)';
            };
            reader.readAsDataURL(f);
        }
    });
    zone.addEventListener('dragover', e => { e.preventDefault(); zone.classList.add('drag-over'); });
    zone.addEventListener('dragleave', () => zone.classList.remove('drag-over'));
    zone.addEventListener('drop', e => {
        e.preventDefault();
        zone.classList.remove('drag-over');
        if (e.dataTransfer.files.length) {
            fileInput.files = e.dataTransfer.files;
            fileInput.dispatchEvent(new Event('change'));
        }
    });

    document.getElementById('jumlah').addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g,'');
    });

    // ===== Autocomplete Peserta =====
    const searchInput   = document.getElementById('pesertaSearch');
    const hiddenId      = document.getElementById('participant_id');
    const acList        = document.getElementById('acList');
    const selectedBadge = document.getElementById('selectedBadge');
    const badgeName     = document.getElementById('badgeName');
    const badgeNik      = document.getElementById('badgeNik');
    const notFoundMsg   = document.getElementById('notFoundMsg');

    let debounceTimer = null;
    let activeIdx = -1;
    let currentItems = [];

    // Jika ada nilai lama (setelah validasi gagal server)
    @if(old('participant_id') && $participants->firstWhere('id', old('participant_id')))
    @php $oldP = $participants->firstWhere('id', old('participant_id')); @endphp
    (function() {
        hiddenId.value    = '{{ $oldP->id }}';
        searchInput.value = '{{ addslashes($oldP->nama) }}';
        searchInput.classList.add('found');
        badgeName.textContent = '{{ addslashes($oldP->nama) }}';
        badgeNik.textContent  = 'NIK: {{ $oldP->nik }}';
        selectedBadge.classList.add('show');
    })();
    @endif

    searchInput.addEventListener('input', function() {
        const q = this.value.trim();
        clearTimeout(debounceTimer);
        notFoundMsg.style.display = 'none';

        if (hiddenId.value) {
            hiddenId.value = '';
            searchInput.classList.remove('found');
            selectedBadge.classList.remove('show');
        }

        if (q.length < 2) { hideList(); return; }

        acList.innerHTML = '<div class="ac-loading"><i class="fas fa-spinner fa-spin"></i> Mencari...</div>';
        acList.classList.add('show');

        debounceTimer = setTimeout(() => {
            fetch('/api/peserta/cari?q=' + encodeURIComponent(q))
                .then(r => r.json())
                .then(data => { currentItems = data; renderList(data, q); })
                .catch(() => { acList.innerHTML = '<div class="ac-empty">Terjadi kesalahan. Coba lagi.</div>'; });
        }, 300);
    });

    function renderList(data, q) {
        activeIdx = -1;
        if (!data.length) {
            acList.innerHTML = '<div class="ac-empty">&#9888; Tidak ada peserta dengan nama/NIK <strong>"' + escHtml(q) + '"</strong>.<br>Hubungi pengurus masjid untuk mendaftar.</div>';
            notFoundMsg.style.display = 'block';
            acList.classList.add('show');
            return;
        }
        notFoundMsg.style.display = 'none';
        acList.innerHTML = data.map((p, i) =>
            '<div class="ac-item" data-idx="' + i + '" onclick="selectPeserta(' + i + ')">' +
            '<div class="ac-avatar">' + p.nama.charAt(0).toUpperCase() + '</div>' +
            '<div class="ac-info">' +
            '<div class="ac-name">' + highlightMatch(escHtml(p.nama), q) + '</div>' +
            '<div class="ac-nik">NIK: ' + highlightMatch(escHtml(p.nik), q) + '</div>' +
            '</div></div>'
        ).join('');
        acList.classList.add('show');
    }

    function selectPeserta(idx) {
        const p = currentItems[idx];
        if (!p) return;
        hiddenId.value = p.id;
        searchInput.value = p.nama;
        searchInput.classList.add('found');
        searchInput.classList.remove('is-invalid');
        badgeName.textContent = p.nama;
        badgeNik.textContent  = 'NIK: ' + p.nik;
        selectedBadge.classList.add('show');
        notFoundMsg.style.display = 'none';
        hideList();
    }

    function clearPeserta() {
        hiddenId.value = '';
        searchInput.value = '';
        searchInput.classList.remove('found');
        selectedBadge.classList.remove('show');
        searchInput.focus();
    }

    function hideList() {
        acList.classList.remove('show');
        acList.innerHTML = '';
        activeIdx = -1;
    }

    searchInput.addEventListener('keydown', function(e) {
        const items = acList.querySelectorAll('.ac-item');
        if (!items.length) return;
        if (e.key === 'ArrowDown')  { e.preventDefault(); activeIdx = Math.min(activeIdx+1, items.length-1); items.forEach((el,i)=>el.classList.toggle('active',i===activeIdx)); }
        else if (e.key === 'ArrowUp')   { e.preventDefault(); activeIdx = Math.max(activeIdx-1, 0); items.forEach((el,i)=>el.classList.toggle('active',i===activeIdx)); }
        else if (e.key === 'Enter' && activeIdx >= 0) { e.preventDefault(); selectPeserta(activeIdx); }
        else if (e.key === 'Escape') { hideList(); }
    });

    document.addEventListener('click', function(e) {
        if (!e.target.closest('.search-wrap')) hideList();
    });

    function escHtml(str) {
        return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }
    function highlightMatch(text, q) {
        const re = new RegExp('(' + q.replace(/[.*+?^${}()|[\]\\]/g,'\\$&') + ')', 'gi');
        return text.replace(re, '<mark style="background:#fef3c7;border-radius:3px;padding:0 2px;">$1</mark>');
    }

    // ===== Form Validation =====
    document.getElementById('tfForm').addEventListener('submit', function(e) {
        if (!hiddenId.value) {
            e.preventDefault();
            searchInput.classList.add('is-invalid');
            notFoundMsg.style.display = 'block';
            notFoundMsg.innerHTML = '<i class="fas fa-exclamation-circle"></i> Pilih peserta dari hasil pencarian terlebih dahulu.';
            searchInput.focus();
            searchInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
            return;
        }
        const btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
    });
</script>
</body>
</html>
