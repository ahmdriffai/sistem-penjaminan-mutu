<?php

namespace App\Services;

use App\Http\Requests\BeritaAddRequest;
use App\Http\Requests\BeritaUpdateRequest;
use App\Models\Berita;
use Illuminate\Pagination\LengthAwarePaginator;

interface BeritaService
{
    function add(BeritaAddRequest $request): Berita;
    function list(string $key, int $size): LengthAwarePaginator;
    function update(BeritaUpdateRequest $request, int $id): Berita;
    function delete(int $id): void;
    function addImage(int $id, $image): Berita;
    function deleteImage(int $id): Berita;
    function updateImage(int $id, $image): Berita;
}
