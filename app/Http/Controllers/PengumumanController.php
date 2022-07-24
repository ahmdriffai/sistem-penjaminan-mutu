<?php

namespace App\Http\Controllers;

use App\Exceptions\InvariantException;
use App\Http\Requests\PengumumanAddRequest;
use App\Models\Pengumuman;
use App\Services\PengumumanService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PengumumanController extends Controller
{
    private $title = 'Pengumuman';

    private PengumumanService $pengumumanService;

    public function __construct(PengumumanService $pengumumanService)
    {
        $this->middleware(['role:admin'])->only(['index']);
        $this->pengumumanService = $pengumumanService;
    }


    public function index(Request $request)
    {
        $title = $this->title;
        $key = $request->query('key') ?? '';
        $size = $request->query('size') ?? 10;
        $data = $this->pengumumanService->list($key, $size);
        return response()->view('pengumuman.index', compact('data', 'title'));
    }

    public function create()
    {
        $title = $this->title;
        return response()->view('pengumuman.create', compact('title'));
    }


    public function store(PengumumanAddRequest $request)
    {
        $judul = $request->input('judul');
        $isi = $request->input('judul');
        $file = $request->file('file');
        try {
            $pengumuman = $this->pengumumanService->add($judul, $isi);
            $this->pengumumanService->addFile($pengumuman->id, $file);
            return response()->redirectTo(route('pengumuman.index'))->with('success', 'Pengumuman berhasil ditambah');
        }catch (InvariantException $exception) {
            return redirect()->back()->with('error', 'Gagal menambah pengumuman, terjadi kesalahan pada server')
                ->withInput($request->all());
        }
    }

    public function show($id)
    {
        $pengumuman = Pengumuman::find($id);
        $listPengumuman = \App\Models\Pengumuman::orderBy('created_at', 'DESC')->paginate(3);
        return response()->view('pengumuman.detail', compact('pengumuman', 'listPengumuman'));
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
        //
    }
}
