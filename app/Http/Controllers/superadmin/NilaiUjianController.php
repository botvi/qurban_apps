<?php

namespace App\Http\Controllers\superadmin;

use App\Models\NilaiUjian;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;

class NilaiUjianController extends Controller
{
    public function index()
    {
        $nilais = NilaiUjian::with(['user', 'ujian', 'ujian.mapel'])->latest()->get();
        return view('pagesuperadmin.nilai_ujian.index', compact('nilais'));
    }

    public function destroy(NilaiUjian $nilaiUjian)
    {
        $nilaiUjian->delete();
        Alert::success('Success', 'Nilai Ujian berhasil dihapus');
        return back();
    }
}
