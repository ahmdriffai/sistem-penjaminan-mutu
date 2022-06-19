<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaperIlmiah extends Model
{
    use HasFactory;

    protected $table = 'paper_ilmiah';
    protected $fillable = [
      'judul', 'tahun', 'bulan', 'media', 'issn', 'sebagai',
        'indexs', 'kriteria', 'link', 'owner'
    ];

    public function dosen() {
        return $this->belongsTo(Dosen::class, 'owner', 'nidn', 'dosen');
    }
}
