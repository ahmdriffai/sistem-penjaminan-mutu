<?php

namespace App\Services;

use App\Http\Requests\DokumenMutuAddRequest;
use App\Http\Requests\DokumenMutuUpdateRequest;
use App\Models\DokumenMutu;
use Illuminate\Pagination\LengthAwarePaginator;

interface DokumenMutuService
{
    function add(DokumenMutuAddRequest $request, $penjaminan_mutu_id): DokumenMutu;
    function list(string $key, int $size) : LengthAwarePaginator;
    function listById(int $id, string $key, int $size) : LengthAwarePaginator;
    function update(DokumenMutuUpdateRequest $request, $penjaminan_mutu_id, int $id) : DokumenMutu;
    function delete(int $id): void;
    function show(int $id): DokumenMutu;
}
