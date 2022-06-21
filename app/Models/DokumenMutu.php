<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenMutu extends Model
{
    use HasFactory;

    protected $table = 'dokumen_mutu';

    protected $fillable = [
        'kode_dokumen', 'nama', 'tahun', 'deskripsi', 'penjaminan_mutu_id'
    ];

    public function penjaminanMutu() {
        return $this->belongsTo(PenjaminanMutu::class, 'penjaminan_mutu_id', 'id', 'penjaminan_mutu');
    }

    public function fileDokumen() {
        return $this->hasMany(FileDokumen::class, 'dokumen_mutu_id', 'id');
    }
}
