<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ujian;
use App\Models\NilaiUjian;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class UserUjianController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $siswa   = Siswa::where('user_id', $user_id)->first();
        $kelasSiswa = $siswa ? $siswa->kelas : null;

        // Tampilkan ujian yang sudah dimulai, filter berdasarkan kelas siswa
        $query = Ujian::with('mapel')->where('status', 'dimulai');
        if ($kelasSiswa) {
            $query->whereHas('mapel', fn($q) => $q->where('kelas', $kelasSiswa));
        }
        $ujians = $query->get();

        // Ujian yang sudah dikerjakan oleh user ini
        $nilaiUjians = NilaiUjian::where('user_id', $user_id)->get()->keyBy('ujian_id');

        return view('pageuser.ujian.index', compact('ujians', 'nilaiUjians'));
    }

    public function show($id)
    {
        $ujian = Ujian::with('mapel')
            ->where('id', $id)
            ->where('status', 'dimulai')
            ->firstOrFail();

        $user_id = Auth::id();

        // Cek sudah dikerjakan
        $nilaiUjian = NilaiUjian::where('user_id', $user_id)->where('ujian_id', $id)->first();
        if ($nilaiUjian) {
            return redirect()->route('user.ujian.index')
                ->with('error', 'Anda sudah mengerjakan ujian ini. Nilai: ' . $nilaiUjian->nilai_ujian);
        }

        $soals = is_array($ujian->soal) ? $ujian->soal : [];
        foreach ($soals as $index => $soal) {
            $soals[$index]['original_index'] = $index;
        }
        // Acak urutan soal
        shuffle($soals);

        return view('pageuser.ujian.show', compact('ujian', 'soals'));
    }

    public function submit(Request $request, $id)
    {
        $ujian = Ujian::where('id', $id)->where('status', 'dimulai')->firstOrFail();

        $user_id = Auth::id();

        // Cegah submit ulang
        $sudahAda = NilaiUjian::where('user_id', $user_id)->where('ujian_id', $id)->exists();
        if ($sudahAda) {
            return redirect()->route('user.ujian.index')->with('error', 'Ujian sudah dikerjakan sebelumnya.');
        }

        $soals       = $ujian->soal;
        $jawabanUser = $request->input('jawaban', []);

        $benar = 0;
        $total = count($soals);

        foreach ($soals as $index => $soal) {
            if (isset($jawabanUser[$index]) && $jawabanUser[$index] === $soal['jawaban']) {
                $benar++;
            }
        }

        $nilai = ($total > 0) ? round(($benar / $total) * 100) : 0;

        NilaiUjian::create([
            'user_id'     => $user_id,
            'ujian_id'    => $id,
            'nilai_ujian' => $nilai,
        ]);

        return redirect()->route('user.ujian.index')
            ->with('success', "Ujian Selesai! Nilai Anda: {$nilai}");
    }
}
