<?php

namespace App\Services;

use App\Models\DokumenMutu;
use Illuminate\Pagination\LengthAwarePaginator;

interface DokumenMutuService
{
    function add($kodeDokument, $nama, $tahun, $deskripsi, $penjaminan_mutu_id): DokumenMutu;
    function list(string $key, int $size) : LengthAwarePaginator;
    function update($kodeDokumen, $nama, $tahun, $deskripsi, $penjaminan_mutu_id, int $id) : DokumenMutu;
    function delete(int $id): void;
    function show(int $id): DokumenMutu;
    function addFile(int $id, $file): DokumenMutu;
    function updateFile(int $id, $file): DokumenMutu;
    function deleteFile(int $id): DokumenMutu;
}
