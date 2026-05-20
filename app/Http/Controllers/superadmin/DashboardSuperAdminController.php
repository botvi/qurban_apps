<?php

namespace App\Http\Controllers\superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Testimoni;
use App\Models\Link;

use App\Models\Mapel;
use App\Models\Materi;
use App\Models\Quiz;
use App\Models\Ujian;
use App\Models\NilaiQuiz;
use App\Models\NilaiUjian;

class DashboardSuperAdminController extends Controller
{
   public function index()
   {
      $totalSiswa = User::where('role', 'user')->count();
      $totalMapel = Mapel::count();
      $totalMateri = Materi::count();
      $totalQuiz = Quiz::count();
      $totalUjian = Ujian::count();

      $lulusQuiz = NilaiQuiz::where('nilai_quiz', '>=', 72)->count();
      $tidakLulusQuiz = NilaiQuiz::where('nilai_quiz', '<', 72)->count();

      $lulusUjian = NilaiUjian::where('nilai_ujian', '>=', 72)->count();
      $tidakLulusUjian = NilaiUjian::where('nilai_ujian', '<', 72)->count();

      return view('pagesuperadmin.dashboard.index', compact(
          'totalSiswa', 'totalMapel', 'totalMateri', 'totalQuiz', 'totalUjian',
          'lulusQuiz', 'tidakLulusQuiz', 'lulusUjian', 'tidakLulusUjian'
      ));
   }
}
