<?php

namespace App\Http\Controllers;

use App\Exceptions\InvariantException;
use App\Http\Requests\PenjaminanMutuAddRequest;
use App\Http\Requests\PenjaminanMutuUpdateRequest;
use App\Models\PenjaminanMutu;
use App\Services\DokumenMutuService;
use App\Services\PenjaminanMutuService;
use Illuminate\Http\Request;

class PenjaminanMutuController extends Controller
{

    private string $title = 'Penjaminan Mutu';

    private PenjaminanMutuService $penjaminanMutuService;
    private DokumenMutuService $dokumenMutuService;

    public function __construct(PenjaminanMutuService $penjaminanMutuService, DokumenMutuService $dokumenMutuService)
    {
        $this->penjaminanMutuService = $penjaminanMutuService;
        $this->dokumenMutuService = $dokumenMutuService;
    }


    public function index(Request $request)
    {
        $title = $this->title;
        $key = $request->query('key') ?? '';
        $size = $request->query('size') ?? 10;
        $penjaminanMutu = $this->penjaminanMutuService->list('', 5);
        $dokumenMutu = $this->dokumenMutuService->list($key, $size);
        return response()->view('penjaminan-mutu.index', compact('title', 'penjaminanMutu', 'dokumenMutu'));
    }

    public function store(PenjaminanMutuAddRequest $request)
    {
        $nama = $request->input('nama');
        $keterangan = $request->input('keterangan');
        try {
            $this->penjaminanMutuService->add($nama, $keterangan);
            return redirect()->back()->with('success', 'Penjaminan mutu berhasil ditambahkan');
        }catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Penjaminan mutu gagal ditambahkan')->withInput($request->all());
        }
    }

    public function edit($id)
    {
        $title = $this->title;
        $penjaminanMutu = PenjaminanMutu::find($id);
        return response()->view('penjaminan-mutu.edit', compact('penjaminanMutu', 'title'));
    }


    public function update(PenjaminanMutuUpdateRequest $request, $id)
    {
        $nama = $request->input('nama');
        $keterangan = $request->input('keterangan');

        try {
            $this->penjaminanMutuService->update($nama, $keterangan, $id);
            return redirect(route('penjaminan-mutu.index'))->with('success', 'Penjaminan mutu berhasil diubah');
        }catch (InvariantException $exception) {
            return redirect()->back()->with('error', 'Penjaminan mutu gagal diubah')->withInput($request->all());
        }
    }

    public function destroy($id)
    {
        try {
            $this->penjaminanMutuService->delete($id);
            return redirect()->back()->with('success', 'Penjaminan mutu berhasil dihapus');
        }catch (InvariantException $exception) {
            return redirect()->back()->with('error', 'Penjaminan mutu gagal dihapus');
        }
    }
}
