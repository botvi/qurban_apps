<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use App\Models\Participant;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class WithdrawalController extends Controller
{
    public function index(Request $request)
    {
        $query = Withdrawal::with(['participant', 'user']);

        if ($request->search) {
            $query->whereHas('participant', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            });
        }

        $withdrawals = $query->latest()->paginate(10)->withQueryString();

        return view('admin.withdrawals.index', compact('withdrawals'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses Ditolak');
        }
        $participants = Participant::where('status', 'aktif')->orderBy('nama')->get();
        return view('admin.withdrawals.create', compact('participants'));
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
            'alasan' => 'required|string',
        ], [
            'participant_id.required' => 'Peserta wajib dipilih.',
            'tanggal.required' => 'Tanggal penarikan wajib diisi.',
            'jumlah.required' => 'Jumlah penarikan wajib diisi.',
            'jumlah.numeric' => 'Jumlah penarikan harus berupa angka.',
            'jumlah.min' => 'Jumlah penarikan minimal Rp 1.000.',
            'alasan.required' => 'Alasan penarikan wajib diisi.',
        ]);

        $participant = Participant::findOrFail($request->participant_id);
        $balance = $participant->balance;

        if ($request->jumlah > $balance) {
            Alert::error('Gagal', 'Jumlah penarikan melebihi saldo tabungan peserta (Saldo Saat Ini: Rp ' . number_format($balance, 0, ',', '.') . ').');
            return back()->withInput();
        }

        $data = $request->all();
        $data['user_id'] = auth()->id();

        $withdrawal = Withdrawal::create($data);

        Alert::success('Berhasil', 'Penarikan/pengembalian dana berhasil disimpan.');
        return redirect()->route('withdrawals.index');
    }

    public function show(Withdrawal $withdrawal)
    {
        $withdrawal->load(['participant', 'user']);
        return view('admin.withdrawals.receipt', compact('withdrawal'));
    }

    public function destroy(Withdrawal $withdrawal)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses Ditolak');
        }

        $withdrawal->delete();
        Alert::success('Berhasil', 'Transaksi penarikan berhasil dibatalkan/dihapus.');
        return redirect()->route('withdrawals.index');
    }
}
