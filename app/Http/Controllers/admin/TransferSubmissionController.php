<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TransferSubmission;
use App\Models\Participant;
use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class TransferSubmissionController extends Controller
{
    /**
     * Form publik — kirim bukti transfer (no auth)
     */
    public function create()
    {
        $participants = Participant::where('status', 'aktif')->orderBy('nama')->get();
        return view('public.transfer-create', compact('participants'));
    }

    /**
     * Simpan pengajuan transfer (no auth)
     */
    public function store(Request $request)
    {
        $request->validate([
            'participant_id'      => 'required|exists:participants,id',
            'jumlah'              => 'required|numeric|min:10000',
            'tanggal_transfer'    => 'required|date',
            'no_rekening_pengirim'=> 'nullable|string|max:50',
            'nama_bank'           => 'nullable|string|max:50',
            'bukti_tf'            => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'keterangan'          => 'nullable|string|max:500',
        ], [
            'participant_id.required'   => 'Nama peserta wajib dipilih.',
            'participant_id.exists'     => 'Peserta tidak ditemukan.',
            'jumlah.required'           => 'Jumlah transfer wajib diisi.',
            'jumlah.min'                => 'Jumlah transfer minimal Rp 10.000.',
            'tanggal_transfer.required' => 'Tanggal transfer wajib diisi.',
            'bukti_tf.required'         => 'Foto bukti transfer wajib diunggah.',
            'bukti_tf.image'            => 'File harus berupa gambar (jpg, png, webp).',
            'bukti_tf.max'              => 'Ukuran gambar maksimal 5 MB.',
        ]);

        // Upload bukti TF
        $path = $request->file('bukti_tf')->store('bukti_tf', 'public');

        TransferSubmission::create([
            'participant_id'       => $request->participant_id,
            'jumlah'               => $request->jumlah,
            'tanggal_transfer'     => $request->tanggal_transfer,
            'no_rekening_pengirim' => $request->no_rekening_pengirim,
            'nama_bank'            => $request->nama_bank,
            'bukti_tf'             => $path,
            'keterangan'           => $request->keterangan,
            'status'               => 'pending',
        ]);

        return redirect()->route('transfer.success');
    }

    /**
     * Halaman sukses setelah submit
     */
    public function success()
    {
        return view('public.transfer-success');
    }

    /**
     * Admin: daftar semua pengajuan transfer
     */
    public function index(Request $request)
    {
        $query = TransferSubmission::with(['participant', 'reviewer']);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->search) {
            $query->whereHas('participant', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            });
        }

        $submissions = $query->latest()->paginate(15)->withQueryString();

        $pendingCount   = TransferSubmission::where('status', 'pending')->count();
        $approvedCount  = TransferSubmission::where('status', 'approved')->count();
        $rejectedCount  = TransferSubmission::where('status', 'rejected')->count();

        return view('admin.transfers.index', compact('submissions', 'pendingCount', 'approvedCount', 'rejectedCount'));
    }

    /**
     * Admin: detail pengajuan
     */
    public function show(TransferSubmission $transfer)
    {
        $transfer->load(['participant', 'reviewer']);
        return view('admin.transfers.show', compact('transfer'));
    }

    /**
     * Admin: konfirmasi / ACC transfer → buat deposit
     */
    public function approve(Request $request, TransferSubmission $transfer)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses Ditolak');
        }

        if ($transfer->status !== 'pending') {
            Alert::error('Gagal', 'Pengajuan ini sudah diproses sebelumnya.');
            return back();
        }

        // Buat deposit otomatis
        Deposit::create([
            'participant_id' => $transfer->participant_id,
            'tanggal'        => $transfer->tanggal_transfer,
            'jumlah'         => $transfer->jumlah,
            'keterangan'     => 'Setoran via transfer bank — dikonfirmasi admin. ' . ($transfer->keterangan ?? ''),
            'user_id'        => auth()->id(),
        ]);

        // Update status pengajuan
        $transfer->update([
            'status'      => 'approved',
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        Alert::success('Berhasil', 'Transfer dikonfirmasi dan setoran berhasil dicatat.');
        return redirect()->route('transfers.index');
    }

    /**
     * Admin: tolak transfer
     */
    public function reject(Request $request, TransferSubmission $transfer)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses Ditolak');
        }

        if ($transfer->status !== 'pending') {
            Alert::error('Gagal', 'Pengajuan ini sudah diproses sebelumnya.');
            return back();
        }

        $request->validate([
            'catatan_admin' => 'required|string|max:500',
        ], [
            'catatan_admin.required' => 'Alasan penolakan wajib diisi.',
        ]);

        $transfer->update([
            'status'        => 'rejected',
            'catatan_admin' => $request->catatan_admin,
            'reviewed_by'   => auth()->id(),
            'reviewed_at'   => now(),
        ]);

        Alert::warning('Transfer Ditolak', 'Pengajuan transfer berhasil ditolak.');
        return redirect()->route('transfers.index');
    }
}
