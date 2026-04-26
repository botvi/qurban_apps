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
            'pertanyaan' => 'required|array',
            'a'          => 'required|array',
            'b'          => 'required|array',
            'c'          => 'required|array',
            'd'          => 'required|array',
            'jawaban'    => 'required|array',
        ]);

        $soal = [];
        for ($i = 0; $i < count($request->pertanyaan); $i++) {
            $soal[] = [
                'pertanyaan' => $request->pertanyaan[$i],
                'a'          => $request->a[$i],
                'b'          => $request->b[$i],
                'c'          => $request->c[$i],
                'd'          => $request->d[$i],
                'jawaban'    => $request->jawaban[$i],
            ];
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
            'pertanyaan' => 'required|array',
            'a'          => 'required|array',
            'b'          => 'required|array',
            'c'          => 'required|array',
            'd'          => 'required|array',
            'jawaban'    => 'required|array',
        ]);

        $soal = [];
        for ($i = 0; $i < count($request->pertanyaan); $i++) {
            $soal[] = [
                'pertanyaan' => $request->pertanyaan[$i],
                'a'          => $request->a[$i],
                'b'          => $request->b[$i],
                'c'          => $request->c[$i],
                'd'          => $request->d[$i],
                'jawaban'    => $request->jawaban[$i],
            ];
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
