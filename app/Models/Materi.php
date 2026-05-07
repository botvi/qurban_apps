<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $fillable = [
        'mapel_id',
        'bab',
        'judul',
        'deskripsi',
        'isi_materi',
        'link_youtube',
    ];

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function nilaiQuizzes()
    {
        return $this->hasMany(NilaiQuiz::class);
    }
}
