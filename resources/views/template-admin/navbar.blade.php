<nav class="pc-sidebar" style="--pc-sidebar-bg:#0f766e; --pc-sidebar-color:#ccfbf1; --pc-sidebar-active-color:#fff;">
    <div class="navbar-wrapper">
        <div class="m-header" style="background: linear-gradient(135deg, #115e59 0%, #0f766e 100%); border-bottom: 1px solid rgba(255,255,255,0.08); padding: 18px 20px;">
            <a href="{{ route('dashboard') }}" class="b-brand" style="display:flex;align-items:center;gap:12px; text-decoration:none;">
                <div style="width:40px;height:40px;background:linear-gradient(135deg,#d97706,#f59e0b);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.3em;box-shadow:0 3px 10px rgba(217,119,6,0.4);flex-shrink:0;"><i class="fa-solid fa-mosque" style="color: #ffffff;"></i></div>
                <div style="line-height:1.2;">
                    <div style="font-family:'Poppins',sans-serif;font-size:0.85em;font-weight:800;color:#f59e0b;letter-spacing:0.5px;">MASJID NURUL IMAN</div>
                    <div style="font-family:'Poppins',sans-serif;font-size:0.7em;font-weight:500;color:rgba(255,255,255,0.6);">Sungai Perupuk</div>
                </div>
            </a>
        </div>

        <div class="navbar-content">
            <ul class="pc-navbar">
                {{-- Dashboard --}}
                <li class="pc-item">
                    <a href="{{ route('dashboard') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-layout-dashboard"></i></span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>

                {{-- Section Data Master --}}
                <li class="pc-item pc-caption">
                    <label>Data Master</label>
                </li>
                <li class="pc-item">
                    <a href="{{ route('participants.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-users"></i></span>
                        <span class="pc-mtext">Data Peserta</span>
                    </a>
                </li>
                @if (auth()->user()->role === 'admin')
                <li class="pc-item">
                    <a href="{{ route('categories.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-tags"></i></span>
                        <span class="pc-mtext">Kategori Qurban</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="{{ route('targets.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-target"></i></span>
                        <span class="pc-mtext">Target Qurban Peserta</span>
                    </a>
                </li>
                @endif

                {{-- Section Transaksi --}}
                <li class="pc-item pc-caption">
                    <label>Transaksi</label>
                </li>
                <li class="pc-item">
                    <a href="{{ route('deposits.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-arrow-up-right" style="color: #4ade80;"></i></span>
                        <span class="pc-mtext">Setoran Tabungan</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="{{ route('withdrawals.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-arrow-down-left" style="color: #f87171;"></i></span>
                        <span class="pc-mtext">Penarikan Dana</span>
                    </a>
                </li>
                @if (auth()->user()->role === 'admin')
                <li class="pc-item">
                    <a href="{{ route('transfers.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-transfer-in" style="color: #f59e0b;"></i></span>
                        <span class="pc-mtext">Konfirmasi Transfer</span>
                    </a>
                </li>
                @endif

                {{-- Section Laporan --}}
                <li class="pc-item pc-caption">
                    <label>Laporan</label>
                </li>
                @if (auth()->user()->role === 'admin')
                <li class="pc-item">
                    <a href="{{ route('reports.participants') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-file-description"></i></span>
                        <span class="pc-mtext">Laporan Peserta</span>
                    </a>
                </li>
                @endif
                <li class="pc-item">
                    <a href="{{ route('reports.deposits') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-file-analytics"></i></span>
                        <span class="pc-mtext">Laporan Setoran</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="{{ route('reports.withdrawals') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-file-report"></i></span>
                        <span class="pc-mtext">Laporan Penarikan</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="{{ route('reports.balances') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-wallet"></i></span>
                        <span class="pc-mtext">Laporan Saldo Peserta</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="{{ route('reports.financials') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-cash"></i></span>
                        <span class="pc-mtext">Laporan Keuangan</span>
                    </a>
                </li>

                {{-- Section Pengaturan (Admin Only) --}}
                @if (auth()->user()->role === 'admin')
                <li class="pc-item pc-caption">
                    <label>Pengaturan</label>
                </li>
                <li class="pc-item">
                    <a href="{{ route('users.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-user-cog"></i></span>
                        <span class="pc-mtext">Manajemen User</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
