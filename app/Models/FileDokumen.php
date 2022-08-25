<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileDokumen extends Model
{
    use HasFactory;

    protected $table = 'file_dokumen';
    protected $guarded = ['id'];


    public function dokumenMutu(){
        return $this->belongsTo(DokumenMutu::class);
    }
}
