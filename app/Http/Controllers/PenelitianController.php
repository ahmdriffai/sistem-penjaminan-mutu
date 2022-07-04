<?php

namespace App\Http\Controllers;

use App\Exceptions\InvariantException;
use App\Http\Requests\PenelitianAddRequest;
use App\Http\Requests\PenelitianUpdateRequest;
use App\Models\Penelitian;
use App\Services\PenelitianService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenelitianController extends Controller
{


    private $title = 'Penelitian';

    private PenelitianService $penelitianService;


    public function __construct(PenelitianService $penelitianService)
    {
        $this->penelitianService = $penelitianService;
    }


    public function index(Request $request)
    {
        $owner = Auth::user()->dosen->nidn ?? null;
        $title = $this->title;
        $key = $request->query('key') ?? '';
        $size = $request->query('size') ?? 10;

        if (Auth::user()->getRoleNames()->first() == 'dosen'){
            $data = $this->penelitianService->listByNidn($owner, $key, $size);
        }else{
            $data = $this->penelitianService->list($key, $size);
        }
        return response()->view('penelitian.index', compact('title', 'data'));
    }


    public function create()
    {
        $title = $this->title;
        return response()->view('penelitian.create', compact('title'));
    }

    public function store(PenelitianAddRequest $request)
    {
        $owner = Auth::user()->dosen->nidn ?? null;

        try {
            $penelitian = $this->penelitianService->add($request, $owner);
            return response()->redirectTo(route('penelitian.index'))->with('success', 'Berhasil menambah penelitian baru');
        }catch (InvariantException $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function edit($id)
    {
        $penelitian = Penelitian::find($id);
        $title = $this->title;
        return response()->view('penelitian.edit', compact('title', 'penelitian'));
    }


    public function update(PenelitianUpdateRequest $request, $id)
    {
        try {
            $penelitian = $this->penelitianService->update($request, $id);
            return response()->redirectTo(route('penelitian.index'))->with('success', 'Berhasil mengubah penelitian');
        }catch (InvariantException $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->penelitianService->delete($id);
            return response()->redirectTo(route('penelitian.index'))->with('success', 'Berhasil mengubah penelitian');
        }catch (InvariantException $exception) {
            return redirect()->back()->with('error', 'Hapus Gagal');
        }
    }
}
