<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjaminanMutu extends Model
{
    use HasFactory;

    protected $table = 'penjaminan_mutu';

    protected $fillable = ['nama', 'keterangan'];

    public function dokumenMutu() {
        return $this->hasMany(DokumenMutu::class, 'penjaminan_mutu_id', 'id');
    }
}
