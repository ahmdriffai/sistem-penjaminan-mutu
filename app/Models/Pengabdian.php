<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengabdian extends Model
{
    use HasFactory;

    protected $table = 'pengabdian';
    protected $fillable = [
        'judul', 'tanggal_mulai', 'tanggal_selesai', 'sumber_dana',
        'jumlah', 'sebagai', 'publis', 'owner'
    ];

    public function dosen() {
        return $this->belongsTo(Dosen::class, 'owner', 'nidn', 'dosen');
    }
}
