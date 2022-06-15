<?php

namespace App\Services;

use App\Models\Pengumuman;

interface PengumumanService
{
    function add(string $judul, string $isi): Pengumuman;
    function edit(int $id, string $judul, string $isi): Pengumuman;
    function delete(int $id): void;
    function addFile(int $id, $file): Pengumuman;
    function deleteFile(int $id, $file): Pengumuman;
    function editFile(int $id, $file): Pengumuman;
}
