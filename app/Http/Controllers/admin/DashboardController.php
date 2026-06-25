<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\ParticipantTarget;
use App\Models\QurbanCategory;
use App\Models\TransferSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalParticipants = Participant::where('status', 'aktif')->count();
        $totalDeposits = Deposit::sum('jumlah');
        $totalWithdrawals = Withdrawal::sum('jumlah');
        $netBalance = $totalDeposits - $totalWithdrawals;

        // Progress tabungan peserta untuk target tahun ini (2026)
        $targets = ParticipantTarget::with(['participant', 'category'])
            ->where('tahun_qurban', date('Y'))
            ->get()
            ->map(function ($target) {
                $totalPaid = Deposit::where('participant_id', $target->participant_id)->sum('jumlah') 
                    - Withdrawal::where('participant_id', $target->participant_id)->sum('jumlah');
                
                $percent = $target->target_dana > 0 ? round(($totalPaid / $target->target_dana) * 100, 2) : 0;
                $percent = min(max($percent, 0), 100); // clamp between 0% and 100%

                return (object)[
                    'nama' => $target->participant->nama,
                    'kategori' => $target->category->nama_kategori,
                    'target' => $target->target_dana,
                    'terkumpul' => $totalPaid,
                    'persen' => $percent,
                ];
            });

        // Setoran bulanan tahun ini untuk grafik
        $currentYear = date('Y');
        $monthlyDeposits = Deposit::select(
                DB::raw('MONTH(tanggal) as month'),
                DB::raw('SUM(jumlah) as total')
            )
            ->whereYear('tanggal', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month')
            ->toArray();

        $chartData = [];
        for ($m = 1; $m <= 12; $m++) {
            $chartData[] = isset($monthlyDeposits[$m]) ? (float)$monthlyDeposits[$m] : 0;
        }

        $pendingTransfers = TransferSubmission::where('status', 'pending')->count();

        return view('admin.dashboard', compact(
            'totalParticipants',
            'totalDeposits',
            'totalWithdrawals',
            'netBalance',
            'targets',
            'chartData',
            'pendingTransfers'
        ));
    }
}
