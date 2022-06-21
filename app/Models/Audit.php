<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    use HasFactory;
    protected $table = 'audit';
    protected $fillable = [
        'nama', 'tahun', 'semester', 'file_url', 'file_path'
    ];
}
