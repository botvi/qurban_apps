<?php

namespace App\Http\Controllers\superadmin;

use App\Models\NilaiUjian;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;

class NilaiUjianController extends Controller
{
    public function index(Request $request)
    {
        $query = NilaiUjian::with(['user', 'ujian', 'ujian.mapel'])->latest();

        if ($request->filled('kelas')) {
            $query->whereHas('ujian.mapel', function($q) use ($request) {
                $q->where('kelas', $request->kelas);
            });
        }

        if ($request->filled('mapel_id')) {
            $query->whereHas('ujian', function($q) use ($request) {
                $q->where('mapel_id', $request->mapel_id);
            });
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        $nilais = $query->get();
        $mapels = \App\Models\Mapel::all();

        return view('pagesuperadmin.nilai_ujian.index', compact('nilais', 'mapels'));
    }

    public function destroy(NilaiUjian $nilaiUjian)
    {
        $nilaiUjian->delete();
        Alert::success('Success', 'Nilai Ujian berhasil dihapus');
        return back();
    }

    public function print(Request $request)
    {
        $query = NilaiUjian::with(['user', 'ujian', 'ujian.mapel'])->latest();

        if ($request->filled('kelas')) {
            $query->whereHas('ujian.mapel', function($q) use ($request) {
                $q->where('kelas', $request->kelas);
            });
        }

        if ($request->filled('mapel_id')) {
            $query->whereHas('ujian', function($q) use ($request) {
                $q->where('mapel_id', $request->mapel_id);
            });
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        $nilais = $query->get();
        return view('pagesuperadmin.nilai_ujian.print', compact('nilais'));
    }
}
