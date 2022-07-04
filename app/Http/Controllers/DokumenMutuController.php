<?php

namespace App\Http\Controllers;

use App\Exceptions\InvariantException;
use App\Http\Requests\DokumenMutuAddRequest;
use App\Http\Requests\DokumenMutuUpdateRequest;
use App\Models\DokumenMutu;
use App\Models\PenjaminanMutu;
use App\Services\DokumenMutuService;
use Illuminate\Http\Request;

class DokumenMutuController extends Controller
{

    private $title = 'Dokumen';

    private DokumenMutuService $dokumenMutuService;

    public function __construct(DokumenMutuService $dokumenMutuService)
    {
        $this->dokumenMutuService = $dokumenMutuService;
    }


    public function index(Request $request)
    {
        $title = $this->title;
        $key = $request->input('key') ?? '';
        $data = $this->dokumenMutuService->list($key, 10);
        return response()->view('dokumen-mutu.index', compact('title', 'data'));
    }

    public function create()
    {
        $title = $this->title;
        $penjaminanMutu = PenjaminanMutu::pluck('nama','id')->all();
        return response()->view('dokumen-mutu.create', compact('title', 'penjaminanMutu'));
    }

    public function createById($id)
    {
        $title = $this->title;
        $penjaminanMutu = PenjaminanMutu::find($id);
        return response()->view('dokumen-mutu.create-by-id', compact('title', 'penjaminanMutu'));
    }

    public function store(DokumenMutuAddRequest $request)
    {
        $penjaminanMutuId = $request->input('penjaminan_mutu_id');
        try {
            $this->dokumenMutuService->add($request, $penjaminanMutuId);
            return response()->redirectTo(route('dokumen-mutu.index'))->with('success', 'Dokumen berhasil ditambahkan');
        }catch (InvariantException $exception) {
            return redirect()->back()->with('error', 'Gagal menambah dokumen penjaminan mutu')->withInput($request->all());
        }
    }


    public function show($id)
    {
        $title = $this->title;
        $dokumenMutu = DokumenMutu::find($id);
        return response()->view('dokumen-mutu.show', compact('dokumenMutu', 'title'));
    }


    public function edit($id)
    {
        $title = $this->title;
        $penjaminanMutu = PenjaminanMutu::pluck('nama','id')->all();
        $dokumenMutu = DokumenMutu::find($id);
        return response()->view('dokumen-mutu.edit', compact('title', 'penjaminanMutu', 'dokumenMutu'));
    }

    public function update(DokumenMutuUpdateRequest $request, $id)
    {
        $penjaminanMutuId = $request->input('penjaminan_mutu_id');
        try {
            $this->dokumenMutuService->update($request, $penjaminanMutuId, $id);
            return response()->redirectTo(route('dokumen-mutu.index'))->with('success', 'Dokumen berhasil diubah');
        }catch (InvariantException $exception) {
            return redirect()->back()->with('error', 'Gagal mengubah dokumen penjaminan mutu')->withInput($request->all());
        }
    }

    public function destroy($id)
    {
        try {
            $this->dokumenMutuService->delete($id);
            return response()->redirectTo(route('dokumen-mutu.index'))->with('success', 'Dokumen berhasil dihapus');
        }catch (InvariantException $exception) {
            return redirect()->back()->with('error', 'Gagal menghapus dokumen penjaminan mutu, dokumen masih berisi file');
        }
    }

    public function listShow(Request $request, $id) {
        $key = $request->input('key') ?? '';
        $data = $this->dokumenMutuService->listById($id, $key, 10);
        $penjaminanMutu = PenjaminanMutu::find($id);
        $title = $this->title . " " . $penjaminanMutu->nama;

        return response()->view('dokumen-mutu.list-show', compact('title', 'data', 'penjaminanMutu'));
    }
}
