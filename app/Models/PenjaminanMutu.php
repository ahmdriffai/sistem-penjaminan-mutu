<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjaminanMutu extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'penjaminan_mutu';


    public function dokumenMutu() {
        return $this->hasMany(DokumenMutu::class, 'penjaminan_mutu_id', 'id');
    }
}
