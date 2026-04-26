<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'materi_id',
        'soal',
    ];

    protected $casts = [
        'soal' => 'array',
    ];

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
}
