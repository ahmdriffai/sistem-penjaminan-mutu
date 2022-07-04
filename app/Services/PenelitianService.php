<?php

namespace App\Services;

use App\Http\Requests\PenelitianAddRequest;
use App\Http\Requests\PenelitianUpdateRequest;
use App\Models\Penelitian;
use Illuminate\Pagination\LengthAwarePaginator;

interface PenelitianService
{
    function add(PenelitianAddRequest $request, string $owner): Penelitian;
    function list(string $key, int $size): LengthAwarePaginator;
    function listByNidn(string $owner, string $key, int $size): LengthAwarePaginator;
    function update(PenelitianUpdateRequest $request, int $id): Penelitian;
    function delete(int $id): void;
    function publis(int $id): Penelitian;
}
