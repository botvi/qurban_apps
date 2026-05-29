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
            'nama_mapel' => 'required|string|max:255',
            'kelas'      => 'required|array|min:1',
            'kelas.*'    => 'required|in:VII A,VII B,VII C,VIII A,VIII B,VIII C,IX A,IX B,IX C',
        ], [
            'kelas.required' => 'Pilih minimal satu kelas.',
            'kelas.array'    => 'Format kelas tidak valid.',
        ]);

        $kelasList   = $request->input('kelas');
        $namaMapel   = $request->input('nama_mapel');
        $kelasLama   = $mapel->kelas;
        $newCount    = 0;

        // Tentukan kelas utama: jika kelas lama masih dicentang → pakai itu,
        // jika tidak → pakai kelas pertama yang dipilih
        $kelasPrimary = in_array($kelasLama, $kelasList) ? $kelasLama : $kelasList[0];

        // Update record yang sedang diedit
        $mapel->update([
            'nama_mapel' => $namaMapel,
            'kelas'      => $kelasPrimary,
        ]);

        // Buat record baru untuk kelas tambahan (duplikasi)
        foreach ($kelasList as $kelas) {
            if ($kelas === $kelasPrimary) continue; // skip kelas utama (sudah diupdate)

            $exists = Mapel::where('nama_mapel', $namaMapel)
                           ->where('kelas', $kelas)
                           ->exists();
            if (!$exists) {
                Mapel::create([
                    'nama_mapel' => $namaMapel,
                    'kelas'      => $kelas,
                ]);
                $newCount++;
            }
        }

        $msg = 'Mata Pelajaran berhasil diupdate.';
        if ($newCount > 0) {
            $msg .= " Diduplikasi ke {$newCount} kelas baru.";
        }

        Alert::success('Success', $msg);
        return redirect()->route('mapel.index');
    }

    public function destroy(Mapel $mapel)
    {
        $mapel->delete();
        Alert::success('Success', 'Mata Pelajaran berhasil dihapus');
        return back();
    }
}
