<?php

namespace App\Http\Controllers;

use App\Exceptions\InvariantException;
use App\Http\Requests\DosenAddRequest;
use App\Http\Requests\DosenUpdateRequest;
use App\Models\Dosen;
use App\Services\DosenService;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    private $title = 'Dosen';

    private DosenService $dosenService;

    public function __construct(DosenService $dosenService)
    {
        $this->dosenService = $dosenService;
    }


    public function index(Request $request)
    {
        //
        $key = $request->query('key') ?? '';
        $size = $request->query('size') ?? 10;
        $title = $this->title;
        $data = $this->dosenService->list($key, $size);
        return response()->view('dosen.index', compact('title','data'));
    }

    public function create()
    {
        //
        $title = $this->title;
        return response()->view('dosen.create', compact('title'));
    }


    public function store(DosenAddRequest $request)
    {
        try {
            $this->dosenService->add($request);
            return response()->redirectTo(route('dosen.index'))->with('success', 'Berhasil menambahkan dosen');
        }catch (InvariantException $exception) {
            return redirect()->back()->with('error', 'Gagal menambah dosen, terjadi kesalahan pada server')
                ->withInput($request->all());
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $title = $this->title;
        $dosen = Dosen::find($id);
        return response()->view('dosen.edit', compact('title', 'dosen'));
    }


    public function update(DosenUpdateRequest $request, $id)
    {
        try {
            $this->dosenService->update($request, $id);
            return response()->redirectTo(route('dosen.index'))->with('success', 'Berhasil mengubah dosen');
        }catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Gagal mengubah dosen, terjadi kesalahan pada server')
                ->withInput($request->all());
        }
    }

    public function destroy($id)
    {
        try {
            $this->dosenService->delete($id);
            return response()->redirectTo(route('dosen.index'))->with('success', 'Berhasil mengubah dosen');
        }catch (InvariantException $exception) {
            return redirect()->back()->with('error', 'Gagal menghapus dosen, terjadi kesalahan pada server');
        }
    }
}
