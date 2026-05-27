<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Mapel;
use App\Models\Materi;
use App\Models\NilaiQuiz;
use App\Models\NilaiUjian;
use App\Models\Ujian;

class NilaiAkhirController extends Controller
{
    /**
     * Hitung nilai akhir per siswa per mapel.
     * Formula:
     *   Rata-rata Quiz × 40% + Nilai UTS × 20% + Nilai UAS × 40%
     */
    public function index(Request $request)
    {
        $kelasFilter  = $request->input('kelas');
        $mapelFilter  = $request->input('mapel_id');

        $mapels = Mapel::orderBy('kelas')->orderBy('nama_mapel')->get();

        // Ambil semua siswa (filter kelas jika ada)
        $siswaQuery = Siswa::with('user');
        if ($kelasFilter) {
            $siswaQuery->where('kelas', $kelasFilter);
        }
        $siswas = $siswaQuery->orderBy('kelas')->orderBy('nama_lengkap')->get();

        $hasil = [];

        foreach ($siswas as $siswa) {
            $user_id = $siswa->user_id;

            // Mapel yang relevan dengan kelas siswa
            $mapelQuery = Mapel::where('kelas', $siswa->kelas);
            if ($mapelFilter) {
                $mapelQuery->where('id', $mapelFilter);
            }
            $mapelSiswa = $mapelQuery->get();

            foreach ($mapelSiswa as $mapel) {
                // --- Rata-rata Quiz ---
                $materiIds = Materi::where('mapel_id', $mapel->id)->pluck('id');

                $nilaiQuizzes = NilaiQuiz::where('user_id', $user_id)
                    ->whereIn('materi_id', $materiIds)
                    ->pluck('nilai_quiz');

                $rataQuiz = $nilaiQuizzes->count() > 0
                    ? round($nilaiQuizzes->avg(), 2)
                    : null;

                // --- Nilai UTS ---
                $ujianUTS = Ujian::where('mapel_id', $mapel->id)
                    ->whereRaw('LOWER(judul) LIKE ?', ['%uts%'])
                    ->first();

                $nilaiUTS = null;
                if ($ujianUTS) {
                    $rec = NilaiUjian::where('user_id', $user_id)
                        ->where('ujian_id', $ujianUTS->id)
                        ->first();
                    $nilaiUTS = $rec ? $rec->nilai_ujian : null;
                }

                // --- Nilai UAS ---
                $ujianUAS = Ujian::where('mapel_id', $mapel->id)
                    ->whereRaw('LOWER(judul) LIKE ?', ['%uas%'])
                    ->first();

                $nilaiUAS = null;
                if ($ujianUAS) {
                    $rec = NilaiUjian::where('user_id', $user_id)
                        ->where('ujian_id', $ujianUAS->id)
                        ->first();
                    $nilaiUAS = $rec ? $rec->nilai_ujian : null;
                }

                // --- Nilai Akhir ---
                // Hanya hitung jika minimal ada satu komponen nilai
                $nilaiAkhir = null;
                if ($rataQuiz !== null || $nilaiUTS !== null || $nilaiUAS !== null) {
                    $q   = $rataQuiz ?? 0;
                    $uts = $nilaiUTS  ?? 0;
                    $uas = $nilaiUAS  ?? 0;
                    $nilaiAkhir = round(($q * 0.4) + ($uts * 0.2) + ($uas * 0.4), 2);
                }

                $hasil[] = [
                    'siswa'       => $siswa,
                    'mapel'       => $mapel,
                    'rata_quiz'   => $rataQuiz,
                    'nilai_uts'   => $nilaiUTS,
                    'nilai_uas'   => $nilaiUAS,
                    'nilai_akhir' => $nilaiAkhir,
                    'lulus'       => $nilaiAkhir !== null && $nilaiAkhir >= 72,
                ];
            }
        }

        return view('pagesuperadmin.nilaiakhirsiswa.rekap', compact('hasil', 'mapels', 'kelasFilter', 'mapelFilter'));
    }

    /**
     * Halaman cetak nilai akhir
     */
    public function print(Request $request)
    {
        $kelasFilter = $request->input('kelas');
        $mapelFilter = $request->input('mapel_id');

        $siswaQuery = Siswa::with('user');
        if ($kelasFilter) {
            $siswaQuery->where('kelas', $kelasFilter);
        }
        $siswas = $siswaQuery->orderBy('kelas')->orderBy('nama_lengkap')->get();

        $hasil = [];

        foreach ($siswas as $siswa) {
            $user_id = $siswa->user_id;

            $mapelQuery = Mapel::where('kelas', $siswa->kelas);
            if ($mapelFilter) {
                $mapelQuery->where('id', $mapelFilter);
            }
            $mapelSiswa = $mapelQuery->get();

            foreach ($mapelSiswa as $mapel) {
                $materiIds = Materi::where('mapel_id', $mapel->id)->pluck('id');

                $nilaiQuizzes = NilaiQuiz::where('user_id', $user_id)
                    ->whereIn('materi_id', $materiIds)
                    ->pluck('nilai_quiz');

                $rataQuiz = $nilaiQuizzes->count() > 0 ? round($nilaiQuizzes->avg(), 2) : null;

                $ujianUTS = Ujian::where('mapel_id', $mapel->id)->whereRaw('LOWER(judul) LIKE ?', ['%uts%'])->first();
                $nilaiUTS = null;
                if ($ujianUTS) {
                    $rec = NilaiUjian::where('user_id', $user_id)->where('ujian_id', $ujianUTS->id)->first();
                    $nilaiUTS = $rec ? $rec->nilai_ujian : null;
                }

                $ujianUAS = Ujian::where('mapel_id', $mapel->id)->whereRaw('LOWER(judul) LIKE ?', ['%uas%'])->first();
                $nilaiUAS = null;
                if ($ujianUAS) {
                    $rec = NilaiUjian::where('user_id', $user_id)->where('ujian_id', $ujianUAS->id)->first();
                    $nilaiUAS = $rec ? $rec->nilai_ujian : null;
                }

                $nilaiAkhir = null;
                if ($rataQuiz !== null || $nilaiUTS !== null || $nilaiUAS !== null) {
                    $nilaiAkhir = round((($rataQuiz ?? 0) * 0.4) + (($nilaiUTS ?? 0) * 0.2) + (($nilaiUAS ?? 0) * 0.4), 2);
                }

                $hasil[] = [
                    'siswa'       => $siswa,
                    'mapel'       => $mapel,
                    'rata_quiz'   => $rataQuiz,
                    'nilai_uts'   => $nilaiUTS,
                    'nilai_uas'   => $nilaiUAS,
                    'nilai_akhir' => $nilaiAkhir,
                    'lulus'       => $nilaiAkhir !== null && $nilaiAkhir >= 72,
                ];
            }
        }

        return view('pagesuperadmin.nilaiakhirsiswa.print_akhir', compact('hasil', 'kelasFilter', 'mapelFilter'));
    }
}
