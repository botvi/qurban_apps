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
            'materi_ids'         => 'required|array|min:1',
            'materi_ids.*'       => 'required|exists:materis,id',
            'pertanyaan'         => 'nullable|array',
            'a'                  => 'nullable|array',
            'b'                  => 'nullable|array',
            'c'                  => 'nullable|array',
            'd'                  => 'nullable|array',
            'jawaban'            => 'required|array',
            'gambar_pertanyaan'  => 'nullable|array',
            'gambar_pertanyaan.*' => 'nullable|image|max:2048',
            'gambar_a'           => 'nullable|array',
            'gambar_a.*'         => 'nullable|image|max:2048',
            'gambar_b'           => 'nullable|array',
            'gambar_b.*'         => 'nullable|image|max:2048',
            'gambar_c'           => 'nullable|array',
            'gambar_c.*'         => 'nullable|image|max:2048',
            'gambar_d'           => 'nullable|array',
            'gambar_d.*'         => 'nullable|image|max:2048',
        ], [
            'materi_ids.required' => 'Pilih minimal satu materi / kelas.',
        ]);

        // Proses semua soal + upload gambar sekali dulu
        $soal = [];
        $jawabanCount = count($request->jawaban ?? []);
        $fileFields = ['gambar_pertanyaan', 'gambar_a', 'gambar_b', 'gambar_c', 'gambar_d'];

        for ($i = 0; $i < $jawabanCount; $i++) {
            $item = [
                'pertanyaan' => $request->pertanyaan[$i] ?? null,
                'a'          => $request->a[$i] ?? null,
                'b'          => $request->b[$i] ?? null,
                'c'          => $request->c[$i] ?? null,
                'd'          => $request->d[$i] ?? null,
                'jawaban'    => $request->jawaban[$i] ?? null,
            ];

            foreach ($fileFields as $field) {
                if ($request->hasFile("{$field}.{$i}")) {
                    $file     = $request->file("{$field}.{$i}");
                    $filename = time() . "_{$field}_{$i}_" . $file->getClientOriginalName();
                    $file->move(public_path('uploads/quizzes'), $filename);
                    $item[$field] = 'uploads/quizzes/' . $filename;
                } else {
                    $item[$field] = null;
                }
            }
            $soal[] = $item;
        }

        // Buat 1 quiz per materi yang dipilih, gambar di-copy untuk kelas ke-2 dst
        $materiIds = $request->input('materi_ids');
        $count     = 0;

        foreach ($materiIds as $idx => $materi_id) {
            $soalForThis = $soal;

            // Untuk kelas ke-2 dan seterusnya, salin file gambar agar path unik
            if ($idx > 0) {
                foreach ($soalForThis as &$item) {
                    foreach ($fileFields as $field) {
                        if (!empty($item[$field])) {
                            $originalPath = public_path($item[$field]);
                            if (file_exists($originalPath)) {
                                $newName = time() . "_{$idx}_" . basename($item[$field]);
                                $newPath = public_path('uploads/quizzes/' . $newName);
                                copy($originalPath, $newPath);
                                $item[$field] = 'uploads/quizzes/' . $newName;
                            }
                        }
                    }
                }
                unset($item);
            }

            Quiz::create([
                'materi_id' => $materi_id,
                'soal'      => $soalForThis,
            ]);
            $count++;
        }

        Alert::success('Success', "Quiz berhasil ditambahkan untuk {$count} kelas.");
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
            'pertanyaan' => 'nullable|array',
            'a' => 'nullable|array',
            'b' => 'nullable|array',
            'c' => 'nullable|array',
            'd' => 'nullable|array',
            'jawaban' => 'required|array',
            'gambar_pertanyaan' => 'nullable|array',
            'gambar_pertanyaan.*' => 'nullable|image|max:2048',
            'gambar_a' => 'nullable|array',
            'gambar_a.*' => 'nullable|image|max:2048',
            'gambar_b' => 'nullable|array',
            'gambar_b.*' => 'nullable|image|max:2048',
            'gambar_c' => 'nullable|array',
            'gambar_c.*' => 'nullable|image|max:2048',
            'gambar_d' => 'nullable|array',
            'gambar_d.*' => 'nullable|image|max:2048',
        ]);

        $soal = [];
        $jawabanCount = count($request->jawaban ?? []);
        for ($i = 0; $i < $jawabanCount; $i++) {
            $item = [
                'pertanyaan' => $request->pertanyaan[$i] ?? null,
                'a' => $request->a[$i] ?? null,
                'b' => $request->b[$i] ?? null,
                'c' => $request->c[$i] ?? null,
                'd' => $request->d[$i] ?? null,
                'jawaban' => $request->jawaban[$i] ?? null,
            ];

            $fileFields = ['gambar_pertanyaan', 'gambar_a', 'gambar_b', 'gambar_c', 'gambar_d'];
            foreach ($fileFields as $field) {
                if ($request->hasFile("{$field}.{$i}")) {
                    $file = $request->file("{$field}.{$i}");
                    $filename = time() . "_{$field}_{$i}_" . $file->getClientOriginalName();
                    $file->move(public_path('uploads/quizzes'), $filename);
                    $item[$field] = 'uploads/quizzes/' . $filename;
                } else {
                    $item[$field] = $request->input("old_{$field}.{$i}") ?? null;
                }
            }
            $soal[] = $item;
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
