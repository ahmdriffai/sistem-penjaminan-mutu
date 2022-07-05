<?php

namespace App\Http\Controllers;

use App\Exceptions\InvariantException;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserChangePasswordRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Jobs\SendEmailJob;
use App\Models\Dosen;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    private $title = 'User Akun';
    private UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    public function index(Request $request)
    {
        $title = $this->title;
        $key = $request->query('key') ?? '';
        $size = $request->query('size') ?? 10;
        $data = $this->userService->list($key, $size);
        return response()->view('user.index', compact('title', 'data'));
    }

    public function create()
    {
        $title = $this->title;
        $dosen = Dosen::where('user_id', null)->pluck('nama', 'nidn');
        $roles = Role::pluck('name','name')->all();
        return response()->view('user.create', compact('title', 'dosen', 'roles'));
    }


    public function store(UserAddRequest $request)
    {
        $dosenId = $request->input('dosen_id');
        try {
            $result = $this->userService->add($request, $dosenId);
            $this->dispatch(new SendEmailJob($result->email, $result->password));
            return response()->redirectTo(route('user.index'))->with('success', 'Berhasil membuat user');
        }catch (InvariantException $exception) {
            return redirect()->back()->with('error', 'User gagal ditambahkan, terjadi kesalahan pada server kami')
                ->withInput($request->all());
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        try {
            $this->userService->delete($id);
        }catch (InvariantException $exception) {
            return redirect()->back()->with('error', 'User gagal dihapus, terjadi kesalahan pada server kami');
        }
    }

    public function changePasswordGet() {
        $title = 'Ganti Password';
        return view('user.change-password', compact('title'));
    }

    public function changePasswordPost(UserChangePasswordRequest $request) {
        $user = Auth::user();
        try {
            $this->userService->changePassword($request, $user->id);
            return redirect()->back()->with('success', 'Password berhasil diubah');
        }catch (InvariantException $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
