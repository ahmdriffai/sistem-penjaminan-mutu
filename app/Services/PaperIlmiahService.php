<?php

namespace App\Services;

use App\Http\Requests\PaperIlmiahAddRequest;
use App\Http\Requests\PaperIlmiahUpdateRequest;
use App\Models\PaperIlmiah;
use Illuminate\Pagination\LengthAwarePaginator;

interface PaperIlmiahService
{
    function add(PaperIlmiahAddRequest $request, string $owner) :PaperIlmiah;
    function list(string $key, int $size) : LengthAwarePaginator;
    function update(PaperIlmiahUpdateRequest $request, int $id) : PaperIlmiah;
    function delete(int $id): void;
    function publish(int $id): PaperIlmiah;
}
