<?php

namespace App\Services;

use App\Http\Requests\PengabdianAddRequest;
use App\Http\Requests\PengabdianUpdateRequest;
use App\Models\Pengabdian;
use Illuminate\Pagination\LengthAwarePaginator;

interface PengabdianService
{
    function add(PengabdianAddRequest $request, string $owner): Pengabdian;
    function list(string $key, int $size): LengthAwarePaginator;
    function update(PengabdianUpdateRequest $request, int $id): Pengabdian;
    function delete(int $id): void;
    function publis(int $id): Pengabdian;
}
