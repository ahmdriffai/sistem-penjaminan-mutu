<?php

namespace App\Http\Controllers;

use App\Exceptions\InvariantException;
use App\Http\Requests\PenelitianAddRequest;
use App\Http\Requests\PengabdianAddRequest;
use App\Http\Requests\PengabdianUpdateRequest;
use App\Models\Pengabdian;
use App\Services\PengabdianService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengabdianController extends Controller
{
    private $title = 'Pengabdian';

    private PengabdianService $pengabdianService;


    public function __construct(PengabdianService $pengabdianService)
    {
        $this->pengabdianService = $pengabdianService;
    }

    public function index(Request $request)
    {
        $title = $this->title;
        $key = $request->query('key') ?? '';
        $size = $request->query('size') ?? 10;
        $data = $this->pengabdianService->list($key, $size);
        return response()->view('pengabdian.index', compact('title', 'data'));
    }

    public function create()
    {
        $title = $this->title;
        return response()->view('pengabdian.create', compact('title'));
    }

    public function store(PengabdianAddRequest $request)
    {
        $owner = Auth::user()->dosen->nidn ?? null;

        try {
            $penelitian = $this->pengabdianService->add($request, $owner);
            return response()->redirectTo(route('pengabdian.index'))->with('success', 'Berhasil menambah pengabdian baru');
        }catch (InvariantException $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


    public function edit($id)
    {
        $pengabdian = Pengabdian::find($id);
        $title = $this->title;
        return response()->view('pengabdian.edit', compact('title', 'pengabdian'));
    }

    public function update(PengabdianUpdateRequest $request, $id)
    {
        try {
            $penelitian = $this->pengabdianService->update($request, $id);
            return response()->redirectTo(route('pengabdian.index'))->with('success', 'Berhasil mengubah pengabdian');
        }catch (InvariantException $exception) {
            return redirect()->back()->with('error', 'Gagal mengubah pengabdian');
        }
    }

    public function destroy($id)
    {
        try {
            $this->pengabdianService->delete($id);
            return response()->redirectTo(route('pengabdian.index'))->with('success', 'Berhasil mengubah pengabdian');
        }catch (InvariantException $exception) {
            return redirect()->back()->with('error', 'Hapus Gagal');
        }
    }
}
