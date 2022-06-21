<?php

namespace App\Services;

use App\Http\Requests\DosenAddRequest;
use App\Http\Requests\DosenUpdateRequest;
use App\Models\Dosen;
use App\UseCase\DosenUC;
use Illuminate\Pagination\LengthAwarePaginator;

interface DosenService
{
    function add(DosenAddRequest $request): Dosen;
    function list(string $key, int $size): LengthAwarePaginator;
    function update(DosenUpdateRequest $request, string $nidn): Dosen;
    function delete(string $nidn): void;
    function show(string $nidn): Dosen;
    function addImage(string $nidn, $image): Dosen;
    function deleteImage(string $nidn): Dosen;
    function updateImage(string $nidn, $image): Dosen;

}
