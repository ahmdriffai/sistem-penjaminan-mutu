<?php

namespace App\Services;

use App\Http\Requests\FileDokumenAddRequest;
use App\Http\Requests\FileDokumenRenameRequest;
use App\Models\FileDokumen;
use Illuminate\Database\Eloquent\Collection;

interface FileDokumenService
{
    function add(FileDokumenAddRequest $request, int $dokumenMutuId): FileDokumen;
    function list(string $key): Collection;
    function rename(FileDokumenRenameRequest $request, int $id): FileDokumen;
    function addFile($file, int $id): FileDokumen;
    function updateFile($file, int $id): FileDokumen;
    function deleteFile(int $id): void;
}
