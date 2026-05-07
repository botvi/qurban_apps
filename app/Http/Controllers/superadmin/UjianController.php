<?php

namespace App\Http\Controllers\superadmin;

use App\Models\Ujian;
use App\Models\Mapel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;

class UjianController extends Controller
{
    public function index()
    {
        $ujians = Ujian::with('mapel')->latest()->get();
        return view('pagesuperadmin.master_ujian.index', compact('ujians'));
    }

    public function create()
    {
        $mapels = Mapel::orderBy('nama_mapel')->get();
        return view('pagesuperadmin.master_ujian.create', compact('mapels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mapel_id'   => 'required|exists:mapels,id',
            'judul'      => 'required|string|max:255',
            'status'     => 'required|in:dimulai,belum dimulai',
            'pertanyaan' => 'nullable|array',
            'a'          => 'nullable|array',
            'b'          => 'nullable|array',
            'c'          => 'nullable|array',
            'd'          => 'nullable|array',
            'jawaban'    => 'required|array',
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
                'a'          => $request->a[$i] ?? null,
                'b'          => $request->b[$i] ?? null,
                'c'          => $request->c[$i] ?? null,
                'd'          => $request->d[$i] ?? null,
                'jawaban'    => $request->jawaban[$i] ?? null,
            ];

            $fileFields = ['gambar_pertanyaan', 'gambar_a', 'gambar_b', 'gambar_c', 'gambar_d'];
            foreach ($fileFields as $field) {
                if ($request->hasFile("{$field}.{$i}")) {
                    $file = $request->file("{$field}.{$i}");
                    $filename = time() . "_{$field}_{$i}_" . $file->getClientOriginalName();
                    $file->move(public_path('uploads/ujians'), $filename);
                    $item[$field] = 'uploads/ujians/' . $filename;
                } else {
                    $item[$field] = $request->input("old_{$field}.{$i}") ?? null;
                }
            }
            $soal[] = $item;
        }

        Ujian::create([
            'mapel_id' => $request->mapel_id,
            'judul'    => $request->judul,
            'status'   => $request->status,
            'soal'     => $soal,
        ]);

        Alert::success('Success', 'Ujian berhasil ditambahkan');
        return redirect()->route('ujian.index');
    }

    public function edit(Ujian $ujian)
    {
        $mapels = Mapel::orderBy('nama_mapel')->get();
        return view('pagesuperadmin.master_ujian.edit', compact('ujian', 'mapels'));
    }

    public function update(Request $request, Ujian $ujian)
    {
        $request->validate([
            'mapel_id'   => 'required|exists:mapels,id',
            'judul'      => 'required|string|max:255',
            'status'     => 'required|in:dimulai,belum dimulai',
            'pertanyaan' => 'nullable|array',
            'a'          => 'nullable|array',
            'b'          => 'nullable|array',
            'c'          => 'nullable|array',
            'd'          => 'nullable|array',
            'jawaban'    => 'required|array',
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
                'a'          => $request->a[$i] ?? null,
                'b'          => $request->b[$i] ?? null,
                'c'          => $request->c[$i] ?? null,
                'd'          => $request->d[$i] ?? null,
                'jawaban'    => $request->jawaban[$i] ?? null,
            ];

            $fileFields = ['gambar_pertanyaan', 'gambar_a', 'gambar_b', 'gambar_c', 'gambar_d'];
            foreach ($fileFields as $field) {
                if ($request->hasFile("{$field}.{$i}")) {
                    $file = $request->file("{$field}.{$i}");
                    $filename = time() . "_{$field}_{$i}_" . $file->getClientOriginalName();
                    $file->move(public_path('uploads/ujians'), $filename);
                    $item[$field] = 'uploads/ujians/' . $filename;
                } else {
                    $item[$field] = $request->input("old_{$field}.{$i}") ?? null;
                }
            }
            $soal[] = $item;
        }

        $ujian->update([
            'mapel_id' => $request->mapel_id,
            'judul'    => $request->judul,
            'status'   => $request->status,
            'soal'     => $soal,
        ]);

        Alert::success('Success', 'Ujian berhasil diupdate');
        return redirect()->route('ujian.index');
    }

    public function destroy(Ujian $ujian)
    {
        $ujian->delete();
        Alert::success('Success', 'Ujian berhasil dihapus');
        return back();
    }
}
