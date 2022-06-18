<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';
    protected $primaryKey = 'nidn';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'nidn', 'nama', 'tempat_lahir', 'tanggal_lahir', 'nik',
        'jenis_kelamin', 'nomer_hp', 'alamat', 'foto_url', 'foto_path', 'user_id'
    ];
}
