<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ParticipantController extends Controller
{
    public function index(Request $request)
    {
        $query = Participant::query();

        if ($request->search) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('nik', 'like', '%' . $request->search . '%');
        }

        $participants = $query->latest()->paginate(10)->withQueryString();

        return view('admin.participants.index', compact('participants'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses Ditolak');
        }
        return view('admin.participants.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses Ditolak');
        }

        $request->validate([
            'nik' => 'required|numeric|digits:16|unique:participants,nik',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:20',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_daftar' => 'required|date',
            'status' => 'required|in:aktif,nonaktif',
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.numeric' => 'NIK harus berupa angka.',
            'nik.digits' => 'NIK harus tepat 16 digit.',
            'nik.unique' => 'NIK ini sudah terdaftar.',
            'nama.required' => 'Nama wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib dipilih.',
            'tanggal_daftar.required' => 'Tanggal Daftar wajib diisi.',
            'status.required' => 'Status wajib diisi.',
        ]);

        Participant::create($request->all());
        Alert::success('Berhasil', 'Data peserta berhasil ditambahkan.');
        return redirect()->route('participants.index');
    }

    public function show(Participant $participant)
    {
        $participant->load([
            'deposits' => function($q) { $q->latest(); },
            'withdrawals' => function($q) { $q->latest(); },
            'targets.category'
        ]);

        return view('admin.participants.show', compact('participant'));
    }

    public function edit(Participant $participant)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses Ditolak');
        }
        return view('admin.participants.edit', compact('participant'));
    }

    public function update(Request $request, Participant $participant)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses Ditolak');
        }

        $request->validate([
            'nik' => 'required|numeric|digits:16|unique:participants,nik,' . $participant->id,
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:20',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_daftar' => 'required|date',
            'status' => 'required|in:aktif,nonaktif',
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.numeric' => 'NIK harus berupa angka.',
            'nik.digits' => 'NIK harus tepat 16 digit.',
            'nik.unique' => 'NIK ini sudah terdaftar.',
            'nama.required' => 'Nama wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib dipilih.',
            'tanggal_daftar.required' => 'Tanggal Daftar wajib diisi.',
            'status.required' => 'Status wajib diisi.',
        ]);

        $participant->update($request->all());
        Alert::success('Berhasil', 'Data peserta berhasil diperbarui.');
        return redirect()->route('participants.index');
    }

    public function destroy(Participant $participant)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses Ditolak');
        }

        $participant->delete();
        Alert::success('Berhasil', 'Data peserta berhasil dihapus.');
        return redirect()->route('participants.index');
    }
}
