<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\Mapel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MapelController extends Controller
{
    public function index()
    {
        $mapels = Mapel::latest()->get();
        return view('pagesuperadmin.master_mapel.index', compact('mapels'));
    }

    public function create()
    {
        return view('pagesuperadmin.master_mapel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:255',
            'kelas'      => 'required|array|min:1',
            'kelas.*'    => 'required|in:VII A,VII B,VII C,VIII A,VIII B,VIII C,IX A,IX B,IX C',
        ], [
            'kelas.required' => 'Pilih minimal satu kelas.',
            'kelas.array'    => 'Format kelas tidak valid.',
        ]);

        $kelasList = $request->input('kelas');
        $count = 0;

        foreach ($kelasList as $kelas) {
            // Hindari duplikat: skip jika nama_mapel + kelas sudah ada
            $exists = Mapel::where('nama_mapel', $request->nama_mapel)
                           ->where('kelas', $kelas)
                           ->exists();
            if (!$exists) {
                Mapel::create([
                    'nama_mapel' => $request->nama_mapel,
                    'kelas'      => $kelas,
                ]);
                $count++;
            }
        }

        if ($count > 0) {
            Alert::success('Success', "Mata Pelajaran berhasil ditambahkan untuk {$count} kelas.");
        } else {
            Alert::warning('Perhatian', 'Semua kelas yang dipilih sudah memiliki mapel ini (tidak ada yang ditambahkan).');
        }

        return redirect()->route('mapel.index');
    }

    public function edit(Mapel $mapel)
    {
        return view('pagesuperadmin.master_mapel.edit', compact('mapel'));
    }

    public function update(Request $request, Mapel $mapel)
    {
        $request->validate([
            'nama_mapel' => 'required',
            'kelas' => 'required|in:VII A,VII B,VII C,VIII A,VIII B,VIII C,IX A,IX B,IX C',
        ]);

        $mapel->update($request->all());
        Alert::success('Success', 'Mata Pelajaran berhasil diupdate');
        return redirect()->route('mapel.index');
    }

    public function destroy(Mapel $mapel)
    {
        $mapel->delete();
        Alert::success('Success', 'Mata Pelajaran berhasil dihapus');
        return back();
    }
}
