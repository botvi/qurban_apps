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
            'mapel_ids'    => 'required|array|min:1',
            'mapel_ids.*'  => 'required|exists:mapels,id',
            'bab'          => 'required',
            'judul'        => 'required',
            'deskripsi'    => 'required',
            'isi_materi'   => 'nullable|mimes:pdf|max:10240',
            'link_youtube' => 'nullable|url',
        ], [
            'mapel_ids.required' => 'Pilih minimal satu mata pelajaran / kelas.',
        ]);

        $mapelIds    = $request->input('mapel_ids');
        $mapelLama   = $materi->mapel_id;

        // Tentukan mapel utama: jika mapel lama masih dicentang → pakai itu,
        // jika tidak → pakai yang pertama dipilih
        $mapelPrimary = in_array($mapelLama, $mapelIds) ? $mapelLama : $mapelIds[0];

        // Handle upload / retain file PDF
        $newFilename = null;
        if ($request->hasFile('isi_materi')) {
            // Hapus file lama
            if ($materi->isi_materi && file_exists(public_path('uploads/pdf/' . $materi->isi_materi))) {
                unlink(public_path('uploads/pdf/' . $materi->isi_materi));
            }
            $file        = $request->file('isi_materi');
            $newFilename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/pdf'), $newFilename);
        }

        $baseFilename = $newFilename ?? $materi->isi_materi;

        // Update record utama
        $materi->update([
            'mapel_id'     => $mapelPrimary,
            'bab'          => $request->bab,
            'judul'        => $request->judul,
            'deskripsi'    => $request->deskripsi,
            'link_youtube' => $request->link_youtube,
            'isi_materi'   => $baseFilename,
        ]);

        // Duplikasi ke mapel tambahan
        $dupCount = 0;
        foreach ($mapelIds as $idx => $mapelId) {
            if ($mapelId == $mapelPrimary) continue; // sudah diupdate

            // Salin file PDF agar nama unik per kelas
            $copyFilename = $baseFilename;
            if ($baseFilename) {
                $copyFilename = time() . '_dup' . ($dupCount + 1) . '_' . basename($baseFilename);
                if (file_exists(public_path('uploads/pdf/' . $baseFilename))) {
                    copy(
                        public_path('uploads/pdf/' . $baseFilename),
                        public_path('uploads/pdf/' . $copyFilename)
                    );
                }
            }

            Materi::create([
                'mapel_id'     => $mapelId,
                'bab'          => $request->bab,
                'judul'        => $request->judul,
                'deskripsi'    => $request->deskripsi,
                'link_youtube' => $request->link_youtube,
                'isi_materi'   => $copyFilename,
            ]);
            $dupCount++;
        }

        $msg = 'Materi berhasil diupdate.';
        if ($dupCount > 0) {
            $msg .= " Diduplikasi ke {$dupCount} kelas baru.";
        }

        Alert::success('Success', $msg);
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
