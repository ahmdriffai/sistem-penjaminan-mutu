<?php

namespace App\Services;

use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserChangePasswordRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserService
{
    function add(UserAddRequest $request, string $nidn): User;
    function list(string $key, int $size): LengthAwarePaginator;
    function update(UserUpdateRequest $request, int $id): User;
    function delete(int $id): void;
    public function changePassword(UserChangePasswordRequest $request, $userId): User;
}
