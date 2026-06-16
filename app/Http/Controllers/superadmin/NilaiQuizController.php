<?php

namespace App\Http\Controllers\superadmin;

use App\Models\NilaiQuiz;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;

class NilaiQuizController extends Controller
{
    public function index(Request $request)
    {
        $query = NilaiQuiz::with(['user', 'user.siswa', 'materi', 'materi.mapel'])->latest();

        if ($request->filled('kelas')) {
            $query->whereHas('materi.mapel', function($q) use ($request) {
                $q->where('kelas', 'like', $request->kelas . '%');
            });
        }

        if ($request->filled('mapel_id')) {
            $query->whereHas('materi', function($q) use ($request) {
                $q->where('mapel_id', $request->mapel_id);
            });
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        $nilais = $query->get();
        $mapels = \App\Models\Mapel::all();

        return view('pagesuperadmin.nilai_quiz.index', compact('nilais', 'mapels'));
    }

    public function destroy(NilaiQuiz $nilaiQuiz)
    {
        $nilaiQuiz->delete();
        Alert::success('Success', 'Nilai Quiz berhasil dihapus');
        return back();
    }

    public function print(Request $request)
    {
        $query = NilaiQuiz::with(['user', 'user.siswa', 'materi', 'materi.mapel'])->latest();

        if ($request->filled('kelas')) {
            $query->whereHas('materi.mapel', function($q) use ($request) {
                $q->where('kelas', 'like', $request->kelas . '%');
            });
        }

        if ($request->filled('mapel_id')) {
            $query->whereHas('materi', function($q) use ($request) {
                $q->where('mapel_id', $request->mapel_id);
            });
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        $nilais = $query->get();
        return view('pagesuperadmin.nilai_quiz.print', compact('nilais'));
    }
}
