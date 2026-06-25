<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QurbanCategory extends Model
{
    use HasFactory;

    protected $table = 'qurban_categories';

    protected $fillable = [
        'kode_kategori',
        'nama_kategori',
        'target_dana',
        'keterangan',
    ];

    public function targets()
    {
        return $this->hasMany(ParticipantTarget::class, 'category_id');
    }
}
