<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\admin\{
    DashboardController,
    ParticipantController,
    QurbanCategoryController,
    ParticipantTargetController,
    DepositController,
    WithdrawalController,
    ReportController,
    UserController,
    TransferSubmissionController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing Page (Public — no auth required)
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Public Transfer Submission (no auth required)
Route::get('/tabungan/transfer', [TransferSubmissionController::class, 'create'])->name('transfer.create');
Route::post('/tabungan/transfer', [TransferSubmissionController::class, 'store'])->name('transfer.store');
Route::get('/tabungan/transfer/sukses', [TransferSubmissionController::class, 'success'])->name('transfer.success');

// Public participant search (for autocomplete on transfer form)
Route::get('/api/peserta/cari', function (\Illuminate\Http\Request $request) {
    $q = trim($request->get('q', ''));
    if (strlen($q) < 2) return response()->json([]);
    $results = \App\Models\Participant::where('status', 'aktif')
        ->where(function ($query) use ($q) {
            $query->where('nama', 'like', '%' . $q . '%')
                  ->orWhere('nik', 'like', '%' . $q . '%');
        })
        ->select('id', 'nama', 'nik', 'alamat')
        ->orderBy('nama')
        ->limit(10)
        ->get();
    return response()->json($results);
})->name('api.peserta.cari');

// Public cek status transfer
Route::get('/cek-transfer', function () {
    return view('public.cek-transfer');
})->name('cek.transfer');

// API: riwayat transfer milik peserta (publik)
Route::get('/api/transfer/riwayat', function (\Illuminate\Http\Request $request) {
    $participantId = $request->get('participant_id');
    if (!$participantId) return response()->json(['error' => 'participant_id diperlukan'], 422);

    $peserta = \App\Models\Participant::where('id', $participantId)
        ->where('status', 'aktif')
        ->select('id', 'nama', 'nik', 'alamat')
        ->first();

    if (!$peserta) return response()->json(['error' => 'Peserta tidak ditemukan'], 404);

    $transfers = \App\Models\TransferSubmission::where('participant_id', $participantId)
        ->select('id', 'jumlah', 'tanggal_transfer', 'nama_bank', 'status', 'catatan_admin', 'reviewed_at', 'created_at')
        ->latest()
        ->get()
        ->map(function ($t) {
            return [
                'id'               => $t->id,
                'jumlah'           => $t->jumlah,
                'jumlah_fmt'       => 'Rp ' . number_format($t->jumlah, 0, ',', '.'),
                'tanggal_transfer' => \Carbon\Carbon::parse($t->tanggal_transfer)->translatedFormat('d F Y'),
                'nama_bank'        => $t->nama_bank ?? '-',
                'status'           => $t->status,
                'catatan_admin'    => $t->catatan_admin,
                'reviewed_at'      => $t->reviewed_at ? \Carbon\Carbon::parse($t->reviewed_at)->translatedFormat('d F Y, H:i') : null,
                'created_at'       => \Carbon\Carbon::parse($t->created_at)->translatedFormat('d F Y, H:i'),
            ];
        });

    $totalDisetujui = $transfers->where('status', 'approved')->sum('jumlah');

    return response()->json([
        'peserta'         => $peserta,
        'transfers'       => $transfers,
        'total_disetujui' => 'Rp ' . number_format($totalDisetujui, 0, ',', '.'),
        'count_pending'   => $transfers->where('status', 'pending')->count(),
        'count_approved'  => $transfers->where('status', 'approved')->count(),
        'count_rejected'  => $transfers->where('status', 'rejected')->count(),
    ]);
})->name('api.transfer.riwayat');

// Authentication
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected Routes
Route::group(['middleware' => ['auth']], function () {
    
    // Dashboard (shared)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Participants Resource (shared with conditional role check in controller/views)
    Route::resource('participants', ParticipantController::class);

    // Deposit Transactions (shared with conditional role check)
    Route::resource('deposits', DepositController::class)->only(['index', 'create', 'store', 'show', 'destroy']);

    // Withdrawal Transactions (shared with conditional role check)
    Route::resource('withdrawals', WithdrawalController::class)->only(['index', 'create', 'store', 'show', 'destroy']);

    // Reports (shared)
    Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () {
        Route::get('/participants', [ReportController::class, 'participants'])->name('participants');
        Route::get('/deposits', [ReportController::class, 'deposits'])->name('deposits');
        Route::get('/withdrawals', [ReportController::class, 'withdrawals'])->name('withdrawals');
        Route::get('/balances', [ReportController::class, 'balances'])->name('balances');
        Route::get('/financials', [ReportController::class, 'financials'])->name('financials');
    });

    // Admin-Only Routes
    Route::group(['middleware' => ['role:admin']], function () {
        // Qurban Categories
        Route::resource('categories', QurbanCategoryController::class)->except(['show']);

        // Targets Management
        Route::resource('targets', ParticipantTargetController::class);

        // User Management
        Route::resource('users', UserController::class)->except(['show']);

        // Transfer Submissions (Konfirmasi Transfer)
        Route::resource('transfers', TransferSubmissionController::class)->only(['index', 'show']);
        Route::post('transfers/{transfer}/approve', [TransferSubmissionController::class, 'approve'])->name('transfers.approve');
        Route::post('transfers/{transfer}/reject', [TransferSubmissionController::class, 'reject'])->name('transfers.reject');
    });
});
