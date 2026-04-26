<?php

namespace App\Http\Controllers\superadmin;

use App\Models\Quiz;
use App\Models\Materi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with('materi')->latest()->get();
        return view('pagesuperadmin.master_quiz.index', compact('quizzes'));
    }

    public function create()
    {
        $materis = Materi::with('mapel')->get();
        return view('pagesuperadmin.master_quiz.create', compact('materis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'materi_id' => 'required|exists:materis,id',
            'pertanyaan' => 'required|array',
            'a' => 'required|array',
            'b' => 'required|array',
            'c' => 'required|array',
            'd' => 'required|array',
            'jawaban' => 'required|array',
        ]);

        $soal = [];
        for ($i = 0; $i < count($request->pertanyaan); $i++) {
            $soal[] = [
                'pertanyaan' => $request->pertanyaan[$i],
                'a' => $request->a[$i],
                'b' => $request->b[$i],
                'c' => $request->c[$i],
                'd' => $request->d[$i],
                'jawaban' => $request->jawaban[$i],
            ];
        }

        Quiz::create([
            'materi_id' => $request->materi_id,
            'soal' => $soal,
        ]);

        Alert::success('Success', 'Quiz berhasil ditambahkan');
        return redirect()->route('quiz.index');
    }

    public function edit(Quiz $quiz)
    {
        $materis = Materi::with('mapel')->get();
        return view('pagesuperadmin.master_quiz.edit', compact('quiz', 'materis'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
            'materi_id' => 'required|exists:materis,id',
            'pertanyaan' => 'required|array',
            'a' => 'required|array',
            'b' => 'required|array',
            'c' => 'required|array',
            'd' => 'required|array',
            'jawaban' => 'required|array',
        ]);

        $soal = [];
        for ($i = 0; $i < count($request->pertanyaan); $i++) {
            $soal[] = [
                'pertanyaan' => $request->pertanyaan[$i],
                'a' => $request->a[$i],
                'b' => $request->b[$i],
                'c' => $request->c[$i],
                'd' => $request->d[$i],
                'jawaban' => $request->jawaban[$i],
            ];
        }

        $quiz->update([
            'materi_id' => $request->materi_id,
            'soal' => $soal,
        ]);

        Alert::success('Success', 'Quiz berhasil diupdate');
        return redirect()->route('quiz.index');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        Alert::success('Success', 'Quiz berhasil dihapus');
        return back();
    }
}
