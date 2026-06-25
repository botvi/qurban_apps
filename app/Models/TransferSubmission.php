<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferSubmission extends Model
{
    use HasFactory;

    protected $table = 'transfer_submissions';

    protected $fillable = [
        'participant_id',
        'jumlah',
        'tanggal_transfer',
        'no_rekening_pengirim',
        'nama_bank',
        'bukti_tf',
        'keterangan',
        'status',
        'catatan_admin',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
        'tanggal_transfer' => 'date',
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending'  => 'Menunggu Konfirmasi',
            'approved' => 'Dikonfirmasi',
            'rejected' => 'Ditolak',
            default    => 'Unknown',
        };
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'pending'  => 'warning',
            'approved' => 'success',
            'rejected' => 'danger',
            default    => 'secondary',
        };
    }
}
