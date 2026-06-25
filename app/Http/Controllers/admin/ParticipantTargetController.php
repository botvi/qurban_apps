<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ParticipantTarget;
use App\Models\Participant;
use App\Models\QurbanCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ParticipantTargetController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role !== 'admin') {
                abort(403, 'Akses Ditolak');
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $query = ParticipantTarget::with(['participant', 'category']);

        if ($request->search) {
            $query->whereHas('participant', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            })->orWhereHas('category', function ($q) use ($request) {
                $q->where('nama_kategori', 'like', '%' . $request->search . '%');
            });
        }

        $targets = $query->latest()->paginate(10)->withQueryString();

        return view('admin.targets.index', compact('targets'));
    }

    public function create()
    {
        $participants = Participant::where('status', 'aktif')->orderBy('nama')->get();
        $categories = QurbanCategory::orderBy('nama_kategori')->get();
        return view('admin.targets.create', compact('participants', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'participant_id' => 'required|exists:participants,id',
            'category_id' => 'required|exists:qurban_categories,id',
            'target_dana' => 'required|numeric|min:0',
            'tahun_qurban' => 'required|numeric|digits:4',
        ], [
            'participant_id.required' => 'Peserta wajib dipilih.',
            'category_id.required' => 'Kategori qurban wajib dipilih.',
            'target_dana.required' => 'Target dana wajib diisi.',
            'tahun_qurban.required' => 'Tahun qurban wajib diisi.',
        ]);

        // Cek jika peserta sudah memiliki target untuk tahun tersebut
        $exists = ParticipantTarget::where('participant_id', $request->participant_id)
            ->where('tahun_qurban', $request->tahun_qurban)
            ->exists();

        if ($exists) {
            Alert::error('Gagal', 'Peserta ini sudah terdaftar mengikuti program qurban pada tahun ' . $request->tahun_qurban);
            return back()->withInput();
        }

        ParticipantTarget::create($request->all());
        Alert::success('Berhasil', 'Target qurban peserta berhasil didaftarkan.');
        return redirect()->route('targets.index');
    }

    public function edit(ParticipantTarget $target)
    {
        $participants = Participant::orderBy('nama')->get();
        $categories = QurbanCategory::orderBy('nama_kategori')->get();
        return view('admin.targets.edit', compact('target', 'participants', 'categories'));
    }

    public function update(Request $request, ParticipantTarget $target)
    {
        $request->validate([
            'participant_id' => 'required|exists:participants,id',
            'category_id' => 'required|exists:qurban_categories,id',
            'target_dana' => 'required|numeric|min:0',
            'tahun_qurban' => 'required|numeric|digits:4',
        ], [
            'participant_id.required' => 'Peserta wajib dipilih.',
            'category_id.required' => 'Kategori qurban wajib dipilih.',
            'target_dana.required' => 'Target dana wajib diisi.',
            'tahun_qurban.required' => 'Tahun qurban wajib diisi.',
        ]);

        // Cek duplikasi jika participant_id atau tahun_qurban diubah
        if ($target->participant_id != $request->participant_id || $target->tahun_qurban != $request->tahun_qurban) {
            $exists = ParticipantTarget::where('participant_id', $request->participant_id)
                ->where('tahun_qurban', $request->tahun_qurban)
                ->exists();

            if ($exists) {
                Alert::error('Gagal', 'Peserta ini sudah terdaftar mengikuti program qurban pada tahun ' . $request->tahun_qurban);
                return back()->withInput();
            }
        }

        $target->update($request->all());
        Alert::success('Berhasil', 'Target qurban peserta berhasil diperbarui.');
        return redirect()->route('targets.index');
    }

    public function destroy(ParticipantTarget $target)
    {
        $target->delete();
        Alert::success('Berhasil', 'Target qurban peserta berhasil dihapus.');
        return redirect()->route('targets.index');
    }
}
