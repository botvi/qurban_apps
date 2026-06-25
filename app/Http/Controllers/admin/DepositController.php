<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Participant;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DepositController extends Controller
{
    public function index(Request $request)
    {
        $query = Deposit::with(['participant', 'user']);

        if ($request->search) {
            $query->whereHas('participant', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            });
        }

        $deposits = $query->latest()->paginate(10)->withQueryString();

        return view('admin.deposits.index', compact('deposits'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses Ditolak');
        }
        $participants = Participant::where('status', 'aktif')->orderBy('nama')->get();
        return view('admin.deposits.create', compact('participants'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses Ditolak');
        }

        $request->validate([
            'participant_id' => 'required|exists:participants,id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:1000',
            'keterangan' => 'nullable|string',
        ], [
            'participant_id.required' => 'Peserta wajib dipilih.',
            'tanggal.required' => 'Tanggal setoran wajib diisi.',
            'jumlah.required' => 'Jumlah setoran wajib diisi.',
            'jumlah.numeric' => 'Jumlah setoran harus berupa angka.',
            'jumlah.min' => 'Jumlah setoran minimal Rp 1.000.',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();

        $deposit = Deposit::create($data);
        
        Alert::success('Berhasil', 'Setoran berhasil disimpan.');
        return redirect()->route('deposits.index');
    }

    public function show(Deposit $deposit)
    {
        $deposit->load(['participant', 'user']);
        return view('admin.deposits.receipt', compact('deposit'));
    }

    public function destroy(Deposit $deposit)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses Ditolak');
        }

        $deposit->delete();
        Alert::success('Berhasil', 'Transaksi setoran berhasil dibatalkan/dihapus.');
        return redirect()->route('deposits.index');
    }
}
