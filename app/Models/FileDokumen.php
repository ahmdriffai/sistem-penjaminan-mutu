<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileDokumen extends Model
{
    use HasFactory;

    protected $table = 'file_dokumen';
    protected $fillable = [
        'nama_file', 'file_url', 'file_path', 'format', 'dokumen_mutu_id'
    ];

}
