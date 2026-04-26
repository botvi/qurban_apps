<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameProgress extends Model
{
    use HasFactory;

    protected $table = 'game_progress';

    protected $fillable = [
        'user_id',
        'level',
        'stars',
        'best_moves',
        'best_time',
        'unlocked',
    ];

    protected $casts = [
        'unlocked' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
