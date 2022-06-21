<?php

namespace App\Services;

use App\Http\Requests\AuditAddRequest;
use App\Http\Requests\AuditUpdateRequest;
use App\Models\Audit;
use Illuminate\Pagination\LengthAwarePaginator;

interface AuditService
{
    function add(AuditAddRequest $request): Audit;
    function list(string $key, int $size): LengthAwarePaginator;
    function update(AuditUpdateRequest $request, int $id): Audit;
    function delete(int $id): void;
    function show(int $id): Audit;
    function addFile($file, int $id): Audit;
    function updateFile($file, int $id): Audit;
    function deleteFile($file, int $id): Audit;
}
