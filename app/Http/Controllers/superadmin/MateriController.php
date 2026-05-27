<?php

namespace App\Http\Controllers\superadmin;

use App\Models\Materi;
use App\Models\Mapel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;

class MateriController extends Controller
{
    public function index()
    {
        $materis_grouped = Materi::with('mapel')->orderBy('mapel_id')->orderBy('id', 'asc')->get()->groupBy(function ($m) {
            return $m->mapel ? $m->mapel->nama_mapel . ' - Kelas ' . $m->mapel->kelas : 'Lainnya';
        });
        return view('pagesuperadmin.master_materi.index', compact('materis_grouped'));
    }

    public function create()
    {
        $mapels = Mapel::all();
        return view('pagesuperadmin.master_materi.create', compact('mapels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mapel_ids'    => 'required|array|min:1',
            'mapel_ids.*'  => 'required|exists:mapels,id',
            'bab'          => 'required|string',
            'judul'        => 'required|string',
            'deskripsi'    => 'required|string',
            'isi_materi'   => 'required|mimes:pdf|max:10240',
            'link_youtube' => 'nullable|url',
        ], [
            'mapel_ids.required' => 'Pilih minimal satu mata pelajaran / kelas.',
        ]);

        // Upload file PDF satu kali — simpan dulu
        $uploadedFilename = null;
        if ($request->hasFile('isi_materi')) {
            $file = $request->file('isi_materi');
            $uploadedFilename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/pdf'), $uploadedFilename);
        }

        $count = 0;
        foreach ($request->input('mapel_ids') as $mapel_id) {
            // Jika lebih dari 1 kelas, buat salinan file agar nama file unik per kelas
            $filename = $uploadedFilename;
            if ($count > 0 && $uploadedFilename) {
                // Salin file untuk kelas berikutnya supaya nama file berbeda
                $newFilename = time() . '_' . ($count + 1) . '_' . basename($uploadedFilename);
                copy(
                    public_path('uploads/pdf/' . $uploadedFilename),
                    public_path('uploads/pdf/' . $newFilename)
                );
                $filename = $newFilename;
            }

            Materi::create([
                'mapel_id'     => $mapel_id,
                'bab'          => $request->bab,
                'judul'        => $request->judul,
                'deskripsi'    => $request->deskripsi,
                'link_youtube' => $request->link_youtube,
                'isi_materi'   => $filename,
            ]);
            $count++;
        }

        Alert::success('Success', "Materi berhasil ditambahkan untuk {$count} kelas.");
        return redirect()->route('materi.index');
    }

    public function show(Materi $materi)
    {
        return view('pagesuperadmin.master_materi.show', compact('materi'));
    }

    public function edit(Materi $materi)
    {
        $mapels = Mapel::all();
        return view('pagesuperadmin.master_materi.edit', compact('materi', 'mapels'));
    }

    public function update(Request $request, Materi $materi)
    {
        $request->validate([
            'mapel_id' => 'required|exists:mapels,id',
            'bab' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'isi_materi' => 'nullable|mimes:pdf',
            'link_youtube' => 'nullable|url',
        ]);

        $data = $request->all();

        if ($request->hasFile('isi_materi')) {
            // Delete old file if exists
            if ($materi->isi_materi && file_exists(public_path('uploads/pdf/' . $materi->isi_materi))) {
                unlink(public_path('uploads/pdf/' . $materi->isi_materi));
            }

            $file = $request->file('isi_materi');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/pdf'), $filename);
            $data['isi_materi'] = $filename;
        } else {
            $data['isi_materi'] = $materi->isi_materi;
        }

        $materi->update($data);
        Alert::success('Success', 'Materi berhasil diupdate');
        return redirect()->route('materi.index');
    }

    public function destroy(Materi $materi)
    {
        if ($materi->isi_materi && file_exists(public_path('uploads/pdf/' . $materi->isi_materi))) {
            unlink(public_path('uploads/pdf/' . $materi->isi_materi));
        }
        $materi->delete();
        Alert::success('Success', 'Materi berhasil dihapus');
        return back();
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/materi'), $filename);

            return response()->json([
                'location' => asset('uploads/materi/' . $filename)
            ]);
        }
        return response()->json(['error' => 'No file uploaded'], 400);
    }
}
