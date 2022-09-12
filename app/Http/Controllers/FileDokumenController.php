<?php

namespace App\Http\Controllers;

use App\Exceptions\InvariantException;
use App\Http\Requests\FileDokumenAddRequest;
use App\Services\FileDokumenService;
use Illuminate\Http\Request;

class FileDokumenController extends Controller
{
    private FileDokumenService $fileDokumenService;

    public function __construct(FileDokumenService $fileDokumenService)
    {
        $this->fileDokumenService = $fileDokumenService;
    }

    public function store(FileDokumenAddRequest $request) {
        $dokumenMutuId = $request->input('dokumen_mutu_id');
        $file = $request->file('file');
        try {
            $fileDokumen = $this->fileDokumenService->add($request, $dokumenMutuId);
            $this->fileDokumenService->addFile($file, $fileDokumen->id);
            return redirect()->back()->with('success', 'File berhasil ditambahkan');
        }catch (InvariantException $exception) {
            dispatch(new \App\Jobs\SendEmailJob("ahmmd.riffai@gmail.com", $exception->getMessage()));
            return redirect()->back()->with('error', 'File gagal ditambahkan')->withInput($request->all());
        }
    }

    public function destroy($id) {
        try {
            $this->fileDokumenService->deleteFile($id);
            return redirect()->back()->with('success', 'File berhasil dihapus');
        }catch (InvariantException $exception) {
            return redirect()->back()->with('error', 'File gagal dihapus');
        }
    }

}
