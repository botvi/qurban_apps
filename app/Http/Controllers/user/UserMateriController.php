<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\NilaiQuiz;
use App\Models\Quiz;
use App\Models\Mapel;
use Illuminate\Support\Facades\Auth;

class UserMateriController extends Controller
{
    public function index()
    {
        $user_id = Auth::id() ?? 1;
        $siswa = \App\Models\Siswa::where('user_id', $user_id)->first();
        $kelasSiswa = $siswa ? $siswa->kelas : 'VII'; // Default if not found

        // Get mapels matching student's class
        $mapels = Mapel::where('kelas', $kelasSiswa)->get();
                    
        return view('pageuser.materi', compact('mapels'));
    }

    public function mapel($mapel_id)
    {
        $mapel = Mapel::findOrFail($mapel_id);
        
        $materis = Materi::where('mapel_id', $mapel_id)
                         ->orderBy('id', 'asc')
                         ->get();
                         
        $user_id = Auth::id() ?? 1; // Default to 1 if not auth for safety
        
        $nilaiQuizzes = NilaiQuiz::where('user_id', $user_id)->get()->keyBy('materi_id');

        $materiStatus = [];
        $isUnlocked = true; // First materi is always unlocked
        
        foreach ($materis as $materi) {
            $record = $nilaiQuizzes->get($materi->id);
            $isCompleted = !is_null($record);
            $score = $isCompleted ? $record->nilai_quiz : 0;
            
            $stars = 0;
            if ($isCompleted) {
                if ($score < 50) {
                    $stars = 1;
                } elseif ($score < 75) {
                    $stars = 2;
                } else {
                    $stars = 3;
                }
            }

            $materiStatus[] = (object)[
                'materi' => $materi,
                'is_unlocked' => $isUnlocked,
                'is_completed' => $isCompleted,
                'score' => $score,
                'stars' => $stars
            ];
            
            // Next chapter is unlocked only if this chapter is completed
            $isUnlocked = $isCompleted;
        }

        return view('pageuser.mapel', compact('materiStatus', 'mapel'));
    }

    public function profil()
    {
        $user = Auth::user();
        $siswa = \App\Models\Siswa::where('user_id', Auth::id() ?? 1)->first();
        return view('pageuser.profil', compact('user', 'siswa'));
    }

    public function papanNilai()
    {
        $user_id = Auth::id() ?? 1;
        $nilaiQuizzes = NilaiQuiz::with('materi')->where('user_id', $user_id)->get();
        return view('pageuser.nilaiquiz', compact('nilaiQuizzes'));
    }

    public function show($id)
    {
        $materi = Materi::findOrFail($id);
        
        // Ensure it's unlocked logic
        $user_id = Auth::id() ?? 1;
        $materis = Materi::where('mapel_id', $materi->mapel_id)
                         ->orderBy('id', 'asc')
                         ->get();
                         
        $completedMateriIds = NilaiQuiz::where('user_id', $user_id)->pluck('materi_id')->toArray();
        
        $isUnlocked = true;
        $unlockedIds = [];
        foreach ($materis as $m) {
            if ($isUnlocked) {
                $unlockedIds[] = $m->id;
            }
            $isUnlocked = in_array($m->id, $completedMateriIds);
        }

        if (!in_array($id, $unlockedIds)) {
            return redirect()->route('user.materi.mapel', $materi->mapel_id)->with('error', 'Materi ini masih terkunci!');
        }

        return view('pageuser.daftarmateri', compact('materi'));
    }

    public function quiz($id)
    {
        $materi = Materi::with('quizzes')->findOrFail($id);
        
        if ($materi->quizzes->isEmpty()) {
            return redirect()->route('user.materi.show', $id)->with('error', 'Quiz belum tersedia untuk bab ini.');
        }
        
        $quiz = $materi->quizzes->first();
        
        $soals = is_array($quiz->soal) ? $quiz->soal : [];
        foreach ($soals as $index => $soal) {
            $soals[$index]['original_index'] = $index;
        }
        shuffle($soals);
        
        return view('pageuser.quiz', compact('materi', 'quiz', 'soals'));
    }

    public function submitQuiz(Request $request, $id)
    {
        $materi = Materi::with('quizzes')->findOrFail($id);
        $quiz = $materi->quizzes->first();
        
        if (!$quiz) {
            return redirect()->route('user.materi.mapel', $materi->mapel_id);
        }

        $soals = $quiz->soal;
        $jawabanUser = $request->input('jawaban', []);
        
        $benar = 0;
        $total = count($soals);
        
        foreach ($soals as $index => $soal) {
            if (isset($jawabanUser[$index]) && $jawabanUser[$index] === $soal['jawaban']) {
                $benar++;
            }
        }
        
        $nilai = ($total > 0) ? ($benar / $total) * 100 : 0;
        
        $user_id = Auth::id() ?? 1;

        NilaiQuiz::updateOrCreate(
            ['user_id' => $user_id, 'materi_id' => $id],
            ['nilai_quiz' => $nilai]
        );

        return redirect()->route('user.materi.mapel', $materi->mapel_id)->with('success', "Quiz Selesai! Nilai Anda: " . round($nilai));
    }
}
