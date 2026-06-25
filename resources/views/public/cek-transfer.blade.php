<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status Transfer — Tabungan Qurban Masjid Nurul Iman</title>
    <meta name="description" content="Cek status pengajuan transfer tabungan qurban Anda di Masjid Nurul Iman Sungai Perupuk.">
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
            position:fixed;inset:0;
            background-image:
                repeating-linear-gradient(45deg,rgba(255,255,255,.012) 0,rgba(255,255,255,.012) 1px,transparent 1px,transparent 30px),
                repeating-linear-gradient(-45deg,rgba(255,255,255,.012) 0,rgba(255,255,255,.012) 1px,transparent 1px,transparent 30px);
            pointer-events:none;
        }

        /* Top bar */
        .top-bar {
            background:rgba(6,78,59,.92);
            backdrop-filter:blur(12px);
            border-bottom:1px solid rgba(255,255,255,.08);
            padding:14px 5%;
            display:flex; align-items:center; justify-content:space-between;
            position:sticky; top:0; z-index:100;
        }
        .top-brand { display:flex; align-items:center; gap:10px; text-decoration:none; }
        .brand-icon { width:36px;height:36px; background:linear-gradient(135deg,#d97706,#f59e0b); border-radius:8px; display:flex;align-items:center;justify-content:center; font-size:1.1em; }
        .brand-info .t1{font-size:.78em;font-weight:800;color:#f59e0b;}
        .brand-info .t2{font-size:.65em;color:rgba(255,255,255,.55);}
        .top-nav { display:flex; gap:8px; }
        .top-btn {
            display:inline-flex; align-items:center; gap:6px;
            color:rgba(255,255,255,.8); text-decoration:none;
            font-size:.8em; font-weight:500;
            background:rgba(255,255,255,.1);
            padding:7px 14px; border-radius:8px; transition:.2s;
        }
        .top-btn:hover{ background:rgba(255,255,255,.18); color:#fff; }
        .top-btn.accent { background:linear-gradient(135deg,#d97706,#f59e0b); color:#fff; }

        /* Main content */
        .page-wrap {
            flex:1; padding:40px 5%;
            display:flex; flex-direction:column; align-items:center;
            position:relative; z-index:1;
        }

        /* Search card */
        .search-card {
            background:#fff;
            border-radius:24px;
            overflow:hidden;
            width:100%;
            max-width:680px;
            box-shadow:0 30px 80px rgba(0,0,0,.35);
            margin-bottom:28px;
        }
        .search-header {
            background:linear-gradient(135deg,#064e3b,#0f766e);
            padding:28px 32px;
            text-align:center;
            position:relative;
            overflow:hidden;
        }
        .search-header::before {
            content:'\f002';
            font-family:'Font Awesome 6 Free';
            font-weight:900;
            position:absolute; font-size:5em; opacity:.07;
            right:-10px; top:-10px; line-height:1;
        }
        .search-header .icon { font-size:2em; margin-bottom:8px; }
        .search-header h1 { font-size:1.3em; font-weight:800; color:#fff; margin-bottom:4px; }
        .search-header p  { font-size:.82em; color:rgba(255,255,255,.7); }
        .search-body { padding:28px 32px; }

        /* Autocomplete */
        .search-wrap { position:relative; }
        .search-input {
            width:100%; padding:13px 16px 13px 42px;
            background:#f0fdfa; border:1.5px solid #ccfbf1;
            border-radius:14px; font-family:'Poppins',sans-serif;
            font-size:.92em; color:#1a1a2e; outline:none; transition:.25s;
        }
        .search-input:focus {
            border-color:var(--green-bright); background:#fff;
            box-shadow:0 0 0 3px rgba(13,148,136,.12);
        }
        .search-icon {
            position:absolute; left:14px; top:50%;
            transform:translateY(-50%);
            color:var(--green-light); font-size:.9em;
            pointer-events:none;
        }
        .ac-list {
            position:absolute; top:calc(100% + 6px); left:0; right:0;
            background:#fff; border:1.5px solid #ccfbf1; border-radius:14px;
            box-shadow:0 12px 36px rgba(0,0,0,.12);
            z-index:999; overflow:hidden; display:none;
            max-height:280px; overflow-y:auto;
        }
        .ac-list.show { display:block; }
        .ac-item {
            padding:12px 16px; cursor:pointer;
            border-bottom:1px solid #f0fdfa; transition:.15s;
            display:flex; align-items:center; gap:12px;
        }
        .ac-item:last-child{border-bottom:none;}
        .ac-item:hover,.ac-item.active{background:#f0fdfa;}
        .ac-avatar {
            width:38px;height:38px;flex-shrink:0;
            background:linear-gradient(135deg,#0f766e,#0d9488);
            border-radius:50%; display:flex;align-items:center;justify-content:center;
            color:#fff;font-weight:700;font-size:.9em;
        }
        .ac-name{font-size:.88em;font-weight:700;color:#064e3b;}
        .ac-nik{font-size:.76em;color:#6b7280;margin-top:1px;}
        .ac-msg{padding:16px;text-align:center;font-size:.82em;color:#6b7280;font-style:italic;}

        .btn-cek {
            width:100%; padding:13px;
            background:linear-gradient(135deg,var(--green-dark),var(--green-light));
            color:#fff; border:none; border-radius:12px;
            font-family:'Poppins',sans-serif; font-size:.93em; font-weight:700;
            cursor:pointer; transition:.3s; margin-top:14px;
            box-shadow:0 4px 14px rgba(6,78,59,.3);
            display:flex;align-items:center;justify-content:center;gap:8px;
        }
        .btn-cek:hover:not(:disabled){transform:translateY(-2px);box-shadow:0 8px 24px rgba(6,78,59,.45);}
        .btn-cek:disabled{opacity:.55;cursor:not-allowed;transform:none;}

        .selected-info {
            display:none;
            align-items:center; gap:10px;
            background:#f0fdf4; border:1.5px solid #10b981;
            border-radius:12px; padding:10px 14px; margin-top:10px;
            font-size:.83em;
        }
        .selected-info.show{display:flex;}
        .selected-info .si-name{font-weight:700;color:#064e3b;}
        .selected-info .si-nik{color:#6b7280;font-size:.9em;}
        .si-clear{margin-left:auto;background:none;border:none;color:#6b7280;cursor:pointer;padding:2px 6px;border-radius:6px;transition:.15s;font-size:.9em;}
        .si-clear:hover{background:#fee2e2;color:#dc2626;}

        /* Result card */
        .result-wrap { width:100%; max-width:800px; }

        .peserta-header {
            background:#fff; border-radius:20px;
            padding:22px 28px; margin-bottom:20px;
            box-shadow:0 8px 30px rgba(0,0,0,.15);
            display:flex; align-items:center; gap:16px;
        }
        .peserta-avatar {
            width:56px;height:56px;flex-shrink:0;
            background:linear-gradient(135deg,#064e3b,#0f766e);
            border-radius:50%; display:flex;align-items:center;justify-content:center;
            font-size:1.6em; color:#fff; font-weight:800;
        }
        .peserta-meta h2{font-size:1.1em;font-weight:800;color:#064e3b;margin-bottom:2px;}
        .peserta-meta p{font-size:.8em;color:#6b7280;}

        /* Summary pills */
        .summary-row {
            display:flex; gap:12px; flex-wrap:wrap; margin-bottom:20px;
        }
        .sum-pill {
            background:#fff; border-radius:14px;
            padding:14px 20px; flex:1; min-width:130px;
            box-shadow:0 6px 20px rgba(0,0,0,.12);
            text-align:center;
        }
        .sum-pill .pill-num{font-size:1.6em;font-weight:900;line-height:1;margin-bottom:3px;}
        .sum-pill .pill-lbl{font-size:.72em;color:#6b7280;text-transform:uppercase;letter-spacing:.5px;font-weight:600;}
        .pill-pending  .pill-num{color:#d97706;}
        .pill-approved .pill-num{color:#10b981;}
        .pill-rejected .pill-num{color:#ef4444;}
        .pill-total    .pill-num{color:#0d9488;font-size:1.2em;}

        /* Transfer cards */
        .transfer-list{display:flex;flex-direction:column;gap:12px;}
        .tf-card {
            background:#fff; border-radius:16px;
            padding:0; overflow:hidden;
            box-shadow:0 6px 20px rgba(0,0,0,.1);
            transition:.25s;
        }
        .tf-card:hover{box-shadow:0 10px 32px rgba(0,0,0,.16);}
        .tf-card-top {
            display:flex; align-items:center; gap:14px;
            padding:16px 20px;
        }
        .tf-card-icon{font-size:1.5em;flex-shrink:0;}
        .tf-card-main{flex:1;}
        .tf-card-main .tf-jumlah{font-size:1.15em;font-weight:800;color:#064e3b;}
        .tf-card-main .tf-meta{font-size:.77em;color:#6b7280;margin-top:2px;}
        .tf-badge {
            padding:5px 14px; border-radius:50px;
            font-size:.76em; font-weight:700;
            white-space:nowrap;
        }
        .tf-badge.pending  {background:#fef3c7;color:#b45309;}
        .tf-badge.approved {background:#d1fae5;color:#065f46;}
        .tf-badge.rejected {background:#fee2e2;color:#991b1b;}

        .tf-card-bottom {
            display:none;
            border-top:1px solid #f0fdfa;
            padding:12px 20px;
            font-size:.8em;
            color:#6b7280;
            background:#fafffe;
            gap:16px;
            flex-wrap:wrap;
        }
        .tf-card-bottom.show{display:flex;}
        .tf-detail-item{}
        .tf-detail-item strong{color:#374151;display:block;margin-bottom:1px;}
        .tf-card-bottom .catatan-admin{
            flex-basis:100%;
            background:#fef2f2; border-left:3px solid #ef4444;
            padding:8px 12px; border-radius:0 8px 8px 0;
            color:#991b1b; font-size:.9em;
        }
        .tf-card-bottom .catatan-acc{
            flex-basis:100%;
            background:#f0fdf4; border-left:3px solid #10b981;
            padding:8px 12px; border-radius:0 8px 8px 0;
            color:#065f46; font-size:.9em;
        }

        .tf-toggle{
            background:none;border:none;color:#0d9488;
            font-size:.75em;font-weight:600;cursor:pointer;
            padding:0 20px 12px; display:block; width:100%; text-align:left;
            transition:.15s;
        }
        .tf-toggle:hover{color:#064e3b;}

        /* Empty state */
        .empty-state{
            background:#fff; border-radius:20px;
            padding:48px 32px; text-align:center;
            box-shadow:0 8px 30px rgba(0,0,0,.12);
        }
        .empty-state .e-icon{font-size:3em;margin-bottom:14px;}
        .empty-state h3{font-size:1.1em;font-weight:700;color:#064e3b;margin-bottom:6px;}
        .empty-state p{font-size:.85em;color:#6b7280;line-height:1.7;}
        .empty-state a{
            display:inline-flex;align-items:center;gap:8px;
            background:linear-gradient(135deg,#064e3b,#0d9488);
            color:#fff;padding:11px 22px;border-radius:10px;
            text-decoration:none;font-size:.85em;font-weight:700;
            margin-top:16px;box-shadow:0 4px 12px rgba(6,78,59,.3);
            transition:.25s;
        }
        .empty-state a:hover{transform:translateY(-2px);}

        /* Loading spinner */
        .loading-state{
            background:rgba(255,255,255,.12); border-radius:16px;
            padding:36px; text-align:center; color:#fff;
        }

        /* Error state */
        .error-state{
            background:#fff; border-radius:16px;
            padding:24px; text-align:center;
            box-shadow:0 6px 20px rgba(0,0,0,.12);
        }

        @media(max-width:600px){
            .search-body,.search-header{padding:22px 20px;}
            .peserta-header{flex-direction:column;text-align:center;}
            .summary-row{flex-direction:column;}
            .top-nav .top-btn span{display:none;}
        }
    </style>
</head>
<body>

<!-- Top Bar -->
<div class="top-bar">
    <a href="{{ route('landing') }}" class="top-brand">
        <div class="brand-icon"><i class="fa-solid fa-mosque"></i></div>
        <div class="brand-info">
            <div class="t1">MASJID NURUL IMAN</div>
            <div class="t2">Tabungan Qurban</div>
        </div>
    </a>
    <div class="top-nav">
        <a href="{{ route('landing') }}" class="top-btn">
            <i class="fas fa-home"></i> <span>Beranda</span>
        </a>
        <a href="{{ route('transfer.create') }}" class="top-btn accent">
            <i class="fas fa-paper-plane"></i> <span>Kirim Transfer</span>
        </a>
    </div>
</div>

<div class="page-wrap">

    <!-- Search Card -->
    <div class="search-card">
        <div class="search-header">
            <div class="icon" style="color:white;"><i class="fa-solid fa-magnifying-glass"></i></div>
            <h1>Cek Status Transfer</h1>
            <p>Masukkan nama atau NIK Anda untuk melihat riwayat dan status pengajuan transfer tabungan qurban.</p>
        </div>
        <div class="search-body">
            <div class="search-wrap" id="searchWrap">
                <i class="fas fa-search search-icon"></i>
                <input type="text" id="searchInput" class="search-input"
                    placeholder="Ketik nama atau NIK Anda..."
                    autocomplete="off">
                <div class="ac-list" id="acList"></div>
            </div>

            <div class="selected-info" id="selectedInfo">
                <i class="fas fa-check-circle" style="color:#10b981;flex-shrink:0;"></i>
                <div>
                    <div class="si-name" id="siName"></div>
                    <div class="si-nik" id="siNik"></div>
                </div>
                <button class="si-clear" onclick="clearSearch()">
                    <i class="fas fa-times"></i> Ubah
                </button>
            </div>

            <div id="errMsg" style="display:none;font-size:.8em;color:#dc2626;margin-top:8px;">
                <i class="fas fa-exclamation-circle"></i> Pilih nama Anda dari hasil pencarian terlebih dahulu.
            </div>

            <button class="btn-cek" id="btnCek" disabled onclick="loadRiwayat()">
                <i class="fas fa-search"></i> Lihat Status Transfer Saya
            </button>
        </div>
    </div>

    <!-- Result Area -->
    <div class="result-wrap" id="resultWrap" style="display:none;"></div>

</div>

<script>
    const searchInput  = document.getElementById('searchInput');
    const acList       = document.getElementById('acList');
    const selectedInfo = document.getElementById('selectedInfo');
    const siName       = document.getElementById('siName');
    const siNik        = document.getElementById('siNik');
    const btnCek       = document.getElementById('btnCek');
    const errMsg       = document.getElementById('errMsg');
    const resultWrap   = document.getElementById('resultWrap');

    let debounce = null;
    let items    = [];
    let selectedId = null;

    searchInput.addEventListener('input', function() {
        const q = this.value.trim();
        clearTimeout(debounce);
        errMsg.style.display = 'none';

        if (selectedId) {
            selectedId = null;
            selectedInfo.classList.remove('show');
            btnCek.disabled = true;
            resultWrap.style.display = 'none';
            resultWrap.innerHTML = '';
        }

        if (q.length < 2) { hideList(); return; }

        acList.innerHTML = '<div class="ac-msg"><i class="fas fa-spinner fa-spin"></i> Mencari...</div>';
        acList.classList.add('show');

        debounce = setTimeout(() => {
            fetch('/api/peserta/cari?q=' + encodeURIComponent(q))
                .then(r => r.json())
                .then(data => { items = data; renderList(data, q); })
                .catch(() => { acList.innerHTML = '<div class="ac-msg">Gagal mencari. Periksa koneksi.</div>'; });
        }, 300);
    });

    function renderList(data, q) {
        if (!data.length) {
            acList.innerHTML = '<div class="ac-msg"><i class="fa-solid fa-circle-exclamation text-warning me-1"></i> Nama/NIK <strong>"' + escHtml(q) + '"</strong> tidak ditemukan dalam daftar peserta.</div>';
            acList.classList.add('show');
            return;
        }
        acList.innerHTML = data.map((p, i) =>
            '<div class="ac-item" onclick="selectPeserta(' + i + ')">' +
            '<div class="ac-avatar">' + p.nama.charAt(0).toUpperCase() + '</div>' +
            '<div><div class="ac-name">' + hl(escHtml(p.nama), q) + '</div>' +
            '<div class="ac-nik">NIK: ' + hl(escHtml(p.nik), q) + '</div></div></div>'
        ).join('');
        acList.classList.add('show');
    }

    function selectPeserta(idx) {
        const p = items[idx];
        if (!p) return;
        selectedId = p.id;
        searchInput.value = p.nama;
        siName.textContent = p.nama;
        siNik.textContent  = 'NIK: ' + p.nik;
        selectedInfo.classList.add('show');
        btnCek.disabled = false;
        errMsg.style.display = 'none';
        hideList();
    }

    function clearSearch() {
        selectedId = null;
        searchInput.value = '';
        selectedInfo.classList.remove('show');
        btnCek.disabled = true;
        resultWrap.style.display = 'none';
        resultWrap.innerHTML = '';
        searchInput.focus();
    }

    function hideList() {
        acList.classList.remove('show');
        acList.innerHTML = '';
    }

    document.addEventListener('click', e => {
        if (!e.target.closest('#searchWrap')) hideList();
    });

    searchInput.addEventListener('keydown', function(e) {
        const its = acList.querySelectorAll('.ac-item');
        if (!its.length) return;
        let active = Array.from(its).findIndex(el => el.classList.contains('active'));
        if (e.key === 'ArrowDown') { e.preventDefault(); active = Math.min(active+1, its.length-1); its.forEach((el,i)=>el.classList.toggle('active',i===active)); }
        else if (e.key === 'ArrowUp') { e.preventDefault(); active = Math.max(active-1, 0); its.forEach((el,i)=>el.classList.toggle('active',i===active)); }
        else if (e.key === 'Enter' && active >= 0) { e.preventDefault(); selectPeserta(active); }
        else if (e.key === 'Escape') hideList();
    });

    // Load riwayat transfer
    function loadRiwayat() {
        if (!selectedId) { errMsg.style.display='block'; return; }

        resultWrap.style.display = 'block';
        resultWrap.innerHTML = '<div class="loading-state"><i class="fas fa-spinner fa-spin" style="font-size:2em;margin-bottom:10px;display:block;"></i>Memuat data transfer...</div>';
        resultWrap.scrollIntoView({ behavior:'smooth', block:'start' });

        fetch('/api/transfer/riwayat?participant_id=' + selectedId)
            .then(r => r.json())
            .then(data => {
                if (data.error) { renderError(data.error); return; }
                renderResult(data);
            })
            .catch(() => renderError('Terjadi kesalahan. Periksa koneksi internet Anda.'));
    }

    function renderResult(data) {
        const p  = data.peserta;
        const tf = data.transfers;

        let html = `
        <div class="peserta-header">
            <div class="peserta-avatar">${p.nama.charAt(0).toUpperCase()}</div>
            <div class="peserta-meta">
                <h2>${escHtml(p.nama)}</h2>
                <p>NIK: ${escHtml(p.nik)} &bull; ${escHtml(p.alamat || 'Peserta Tabungan Qurban')}</p>
            </div>
        </div>

        <div class="summary-row">
            <div class="sum-pill pill-pending">
                <div class="pill-num">${data.count_pending}</div>
                <div class="pill-lbl"><i class="fa-solid fa-hourglass-half me-1" style="color:#d97706;"></i> Menunggu</div>
            </div>
            <div class="sum-pill pill-approved">
                <div class="pill-num">${data.count_approved}</div>
                <div class="pill-lbl"><i class="fa-solid fa-circle-check me-1" style="color:#10b981;"></i> Dikonfirmasi</div>
            </div>
            <div class="sum-pill pill-rejected">
                <div class="pill-num">${data.count_rejected}</div>
                <div class="pill-lbl"><i class="fa-solid fa-circle-xmark me-1" style="color:#ef4444;"></i> Ditolak</div>
            </div>
            <div class="sum-pill pill-total">
                <div class="pill-num">${data.total_disetujui}</div>
                <div class="pill-lbl"><i class="fa-solid fa-money-bill-wave me-1" style="color:#0d9488;"></i> Total Diterima</div>
            </div>
        </div>`;

        if (!tf.length) {
            html += `
            <div class="empty-state">
                <div class="e-icon"><i class="fa-solid fa-inbox text-muted"></i></div>
                <h3>Belum Ada Pengajuan Transfer</h3>
                <p>Anda belum pernah mengirim bukti transfer melalui sistem ini.<br>Klik tombol di bawah untuk mulai mengirim bukti transfer.</p>
                <a href="{{ route('transfer.create') }}">
                    <i class="fas fa-paper-plane"></i> Kirim Bukti Transfer Sekarang
                </a>
            </div>`;
        } else {
            html += `<div class="transfer-list">`;
            tf.forEach((t, i) => {
                const badgeClass = t.status === 'approved' ? 'approved' : (t.status === 'rejected' ? 'rejected' : 'pending');
                const badgeText  = t.status === 'approved' ? '<i class="fa-solid fa-circle-check me-1"></i> Dikonfirmasi' : (t.status === 'rejected' ? '<i class="fa-solid fa-circle-xmark me-1"></i> Ditolak' : '<i class="fa-solid fa-hourglass-half me-1"></i> Menunggu Konfirmasi');
                const icon       = t.status === 'approved' ? '<i class="fa-solid fa-circle text-success"></i>' : (t.status === 'rejected' ? '<i class="fa-solid fa-circle text-danger"></i>' : '<i class="fa-solid fa-circle text-warning"></i>');

                let bottomContent = `
                    <div class="tf-detail-item"><strong>Tanggal Transfer</strong>${escHtml(t.tanggal_transfer)}</div>
                    <div class="tf-detail-item"><strong>Bank Pengirim</strong>${escHtml(t.nama_bank)}</div>
                    <div class="tf-detail-item"><strong>Dikirim Pada</strong>${escHtml(t.created_at)}</div>`;

                if (t.reviewed_at) {
                    bottomContent += `<div class="tf-detail-item"><strong>Diproses Pada</strong>${escHtml(t.reviewed_at)}</div>`;
                }
                if (t.status === 'rejected' && t.catatan_admin) {
                    bottomContent += `<div class="catatan-admin"><i class="fas fa-comment-alt"></i> <strong>Alasan Ditolak:</strong> ${escHtml(t.catatan_admin)}</div>`;
                }
                if (t.status === 'approved') {
                    bottomContent += `<div class="catatan-acc"><i class="fas fa-check-circle"></i> Transfer Anda telah dikonfirmasi dan otomatis tercatat sebagai setoran tabungan.</div>`;
                }
                if (t.status === 'pending') {
                    bottomContent += `<div class="catatan-acc" style="background:#fffbeb;border-color:#f59e0b;color:#92400e;"><i class="fas fa-clock"></i> Transfer Anda sedang dalam proses verifikasi oleh pengurus masjid (1&times;24 jam kerja).</div>`;
                }

                html += `
                <div class="tf-card" id="card-${i}">
                    <div class="tf-card-top">
                        <div class="tf-card-icon">${icon}</div>
                        <div class="tf-card-main">
                            <div class="tf-jumlah">${escHtml(t.jumlah_fmt)}</div>
                            <div class="tf-meta">${escHtml(t.tanggal_transfer)} &bull; ${escHtml(t.nama_bank)}</div>
                        </div>
                        <span class="tf-badge ${badgeClass}">${badgeText}</span>
                    </div>
                    <div class="tf-card-bottom" id="bottom-${i}">
                        ${bottomContent}
                    </div>
                    <button class="tf-toggle" onclick="toggleDetail(${i})">
                        <i class="fas fa-chevron-down" id="chevron-${i}"></i> Detail Transaksi
                    </button>
                </div>`;
            });
            html += `</div>`;

            // CTA kirim lagi
            html += `
            <div style="text-align:center;margin-top:20px;">
                <a href="{{ route('transfer.create') }}" style="display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,.15);backdrop-filter:blur(8px);color:#fff;padding:12px 24px;border-radius:12px;text-decoration:none;font-size:.85em;font-weight:600;border:1.5px solid rgba(255,255,255,.3);transition:.25s;" onmouseover="this.style.background='rgba(255,255,255,.25)'" onmouseout="this.style.background='rgba(255,255,255,.15)'">
                    <i class="fas fa-plus"></i> Kirim Transfer Baru
                </a>
            </div>`;
        }

        resultWrap.innerHTML = html;
    }

    function toggleDetail(i) {
        const bottom  = document.getElementById('bottom-' + i);
        const chevron = document.getElementById('chevron-' + i);
        const isOpen  = bottom.classList.contains('show');
        bottom.classList.toggle('show', !isOpen);
        chevron.style.transform = isOpen ? '' : 'rotate(180deg)';
        chevron.style.transition = '.2s';
    }

    function renderError(msg) {
        resultWrap.innerHTML = `<div class="error-state"><i class="fas fa-exclamation-triangle" style="font-size:2em;color:#ef4444;margin-bottom:10px;display:block;"></i><p style="color:#6b7280;font-size:.88em;">${escHtml(msg)}</p></div>`;
    }

    function escHtml(str) {
        if (!str) return '';
        return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }
    function hl(text, q) {
        const re = new RegExp('(' + q.replace(/[.*+?^${}()|[\]\\]/g,'\\$&') + ')', 'gi');
        return text.replace(re, '<mark style="background:#fef3c7;border-radius:3px;padding:0 2px;">$1</mark>');
    }
</script>
</body>
</html>
