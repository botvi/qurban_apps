<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipantTarget extends Model
{
    use HasFactory;

    protected $table = 'participant_targets';

    protected $fillable = [
        'participant_id',
        'category_id',
        'target_dana',
        'tahun_qurban',
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function category()
    {
        return $this->belongsTo(QurbanCategory::class, 'category_id');
    }
}
