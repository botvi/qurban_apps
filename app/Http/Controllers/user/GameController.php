<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\GameProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    /**
     * Tampilkan halaman game, kirim data progress user ke view
     */
    public function index()
    {
        $userId = Auth::id();

        // Ambil semua progress user ini, key by level
        $progresses = GameProgress::where('user_id', $userId)
            ->get()
            ->keyBy('level');

        // Level 1 selalu unlocked
        if (!$progresses->has(1)) {
            GameProgress::firstOrCreate(
                ['user_id' => $userId, 'level' => 1],
                ['unlocked' => true, 'stars' => 0]
            );
            $progresses = GameProgress::where('user_id', $userId)->get()->keyBy('level');
        }

        // Bangun array progress untuk dikirim ke JS
        $progressData = [];
        $totalLevels = 8;
        for ($lv = 1; $lv <= $totalLevels; $lv++) {
            $rec = $progresses->get($lv);
            $progressData[$lv] = [
                'level'      => $lv,
                'unlocked'   => $rec ? (bool)$rec->unlocked : ($lv === 1),
                'stars'      => $rec ? (int)$rec->stars : 0,
                'best_moves' => $rec ? $rec->best_moves : null,
                'best_time'  => $rec ? $rec->best_time : null,
            ];
        }

        return view('pageuser.game.index', [
            'progressData' => $progressData,
            'userId'       => $userId,
        ]);
    }

    /**
     * AJAX: simpan hasil level yang baru diselesaikan
     */
    public function saveProgress(Request $request)
    {
        $request->validate([
            'level' => 'required|integer|min:1|max:8',
            'stars' => 'required|integer|min:1|max:3',
            'moves' => 'required|integer|min:1',
            'time'  => 'required|string',
        ]);

        $userId = Auth::id();
        $level  = $request->level;
        $stars  = $request->stars;
        $moves  = $request->moves;
        $time   = $request->time;

        // Update atau buat record untuk level ini
        $rec = GameProgress::where('user_id', $userId)->where('level', $level)->first();
        if (!$rec) {
            GameProgress::create([
                'user_id'    => $userId,
                'level'      => $level,
                'stars'      => $stars,
                'best_moves' => $moves,
                'best_time'  => $time,
                'unlocked'   => true,
            ]);
        } else {
            // Update hanya jika lebih baik
            $update = [];
            if ($stars > $rec->stars) {
                $update['stars']      = $stars;
                $update['best_moves'] = $moves;
                $update['best_time']  = $time;
            } elseif ($stars === $rec->stars && $moves < ($rec->best_moves ?? 9999)) {
                $update['best_moves'] = $moves;
                $update['best_time']  = $time;
            }
            if (!empty($update)) $rec->update($update);
        }

        // Unlock level berikutnya
        $nextLevel = $level + 1;
        if ($nextLevel <= 8) {
            GameProgress::firstOrCreate(
                ['user_id' => $userId, 'level' => $nextLevel],
                ['unlocked' => true, 'stars' => 0]
            );
            // Pastikan unlocked = true jika sudah ada
            GameProgress::where('user_id', $userId)
                ->where('level', $nextLevel)
                ->update(['unlocked' => true]);
        }

        return response()->json(['success' => true]);
    }
}
