<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Deposit;
use App\Models\QurbanCategory;
use App\Models\ParticipantTarget;
use App\Models\TransferSubmission;

class LandingController extends Controller
{
    public function index()
    {
        // Statistik umum
        $totalPeserta = Participant::where('status', 'aktif')->count();
        $totalTerkumpul = Deposit::sum('jumlah');

        // Info qurban per kategori (mushola)
        $kategoris = QurbanCategory::withCount([
            'targets as jumlah_peserta' => function ($q) {
                $q->whereYear('created_at', date('Y'));
            }
        ])->get();

        // Hitung berapa yang sudah lunas per kategori
        $qurbanStats = $kategoris->map(function ($kat) {
            $targets = ParticipantTarget::where('category_id', $kat->id)
                ->whereYear('created_at', date('Y'))
                ->with('participant')
                ->get();

            $lunas = 0;
            foreach ($targets as $t) {
                $totalPaid = Deposit::where('participant_id', $t->participant_id)->sum('jumlah');
                if ($totalPaid >= $t->target_dana) $lunas++;
            }

            return (object)[
                'nama_kategori' => $kat->nama_kategori,
                'kode_kategori' => $kat->kode_kategori,
                'target_dana'   => $kat->target_dana,
                'jumlah_peserta'=> $kat->jumlah_peserta,
                'jumlah_lunas'  => $lunas,
                'keterangan'    => $kat->keterangan,
            ];
        });

        // Jumlah pengajuan transfer pending
        $pendingTransfers = TransferSubmission::where('status', 'pending')->count();

        return view('landing', compact(
            'totalPeserta',
            'totalTerkumpul',
            'qurbanStats',
            'pendingTransfers'
        ));
    }
}
