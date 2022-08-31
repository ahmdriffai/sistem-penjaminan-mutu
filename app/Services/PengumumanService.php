<?php

namespace App\Services;

use App\Http\Requests\PengumumanUpdateRequest;
use App\Models\Pengumuman;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface PengumumanService
{
    function list(string $key, $size): LengthAwarePaginator;
    function show(int $id): Pengumuman;
    function add(string $judul, string $isi): Pengumuman;
    function edit(PengumumanUpdateRequest $request, int $id): Pengumuman;
    function delete(int $id): void;
    function addFile(int $id, $file): Pengumuman;
    function deleteFile(int $id, $file): Pengumuman;
    function editFile(int $id, $file): Pengumuman;
}
