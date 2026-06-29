<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'nama',
        'alamat',
        'no_hp',
        'jenis_kelamin',
        'tanggal_daftar',
        'status',
    ];

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }

    public function targets()
    {
        return $this->hasMany(ParticipantTarget::class);
    }

    // Accessors for ease of reporting
    public function getTotalDepositsAttribute()
    {
        return $this->deposits()->sum('jumlah');
    }

    public function getTotalWithdrawalsAttribute()
    {
        return $this->withdrawals()->sum('jumlah');
    }

    public function getBalanceAttribute()
    {
        return $this->total_deposits - $this->total_withdrawals;
    }

    public function activeTarget()
    {
        return $this->targets()->where('tahun_qurban', date('Y'))->first()
            ?? $this->targets()->orderBy('tahun_qurban', 'desc')->first();
    }
}
