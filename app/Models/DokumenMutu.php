<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenMutu extends Model
{
    use HasFactory;

    protected $table = 'dokumen_mutu';

    protected $fillable = [
        'kode_dokumen', 'nama', 'tahun', 'deskripsi', 'file_url', 'file_path', 'penjaminan_mutu_id'
    ];

    public function penjaminanMutu() {
        return $this->belongsTo(PenjaminanMutu::class, 'penjaminan_mutu_id', 'id', 'penjaminan_mutu');
    }
}
