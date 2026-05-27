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
            'nama_mapel' => 'required',
            'kelas' => 'required|in:VII A,VII B,VII C,VIII A,VIII B,VIII C,IX A,IX B,IX C',
        ]);

        Mapel::create($request->all());
        Alert::success('Success', 'Mata Pelajaran berhasil ditambahkan');
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
