<?php

namespace App\Http\Controllers\superadmin;

use App\Models\NilaiQuiz;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;

class NilaiQuizController extends Controller
{
    public function index()
    {
        $nilais = NilaiQuiz::with(['user', 'materi'])->latest()->get();
        return view('pagesuperadmin.nilai_quiz.index', compact('nilais'));
    }

    public function destroy(NilaiQuiz $nilaiQuiz)
    {
        $nilaiQuiz->delete();
        Alert::success('Success', 'Nilai Quiz berhasil dihapus');
        return back();
    }
}
