<?php

namespace App\Services\Eloquent;

use App\Exceptions\InvariantException;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserChangePasswordRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Dosen;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserServiceImpl implements UserService
{

    function add(UserAddRequest $request, string $nidn): User
    {
        $dosen = Dosen::find($nidn);

        $email = $request->input('email');
        $roles = $request->input('roles');
        $password = Str::random(5);

        $hashPassword = Hash::make($password);

        try {
            DB::beginTransaction();
            $user = new User();
            $user->name = $dosen->nama;
            $user->email = $email;
            $user->password = $hashPassword;
            $user->save();

            $dosen->user_id = $user->id;
            $dosen->save();

            $user->assignRole($roles);
            DB::commit();
        }catch (\Exception $exception) {
            DB::rollBack();
            throw new InvariantException($exception->getMessage());
        }

        $user->password = $password;
        return $user;

    }

    function list(string $key = '', int $size = 10): LengthAwarePaginator
    {
        $paginate = User::where('email', 'like', '%' . $key . '%')
            ->orWhere('name', 'like', '%' . $key . '%')
            ->orderBy('created_at', 'DESC')
            ->paginate($size);

        return $paginate;
    }

    function update(UserUpdateRequest $request, int $id): User
    {
        $user = User::find($id);

        $email = $request->input('email');
        $password = $request->input('password');
        $roles = $request->input('roles');

        try {
            $user->email = $email;
            if ($password != null) {
                $user->password = Hash::make($password);
            }
            $user->save();
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $user->assignRole($roles);

        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        $user->password = $password;
        return $user;
    }

    function delete(int $id): void
    {
        $user = User::find($id);

        try {
            $user->delete();
        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }
    }

    public function changePassword(UserChangePasswordRequest $request, $userId): User
    {
        $oldPassword = $request->input('old_password');
        $newPassword = $request->input('new_password');
        try {
            DB::beginTransaction();
            $user = User::findOrFail($userId);

            if (!Hash::check($oldPassword, $user->password)){
                throw new InvariantException('Password lama salah');
            }

            $user->password = Hash::make($newPassword);
            $user->save();
            DB::commit();
        }catch (\Exception $exception) {
            DB::rollBack();
            throw new InvariantException($exception->getMessage());
        }

        return $user;
    }
}
