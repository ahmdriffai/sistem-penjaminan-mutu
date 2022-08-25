<?php

namespace App\Http\Controllers;

use App\Exceptions\InvariantException;
use App\Http\Requests\FileDokumenAddRequest;
use App\Models\FileDokumen;
use App\Services\FileDokumenService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FileDokumenController extends Controller
{
    private FileDokumenService $fileDokumenService;

    public function __construct(FileDokumenService $fileDokumenService)
    {
        $this->fileDokumenService = $fileDokumenService;
    }

    public function store(Request $request) {
        //
        // dd($request);
        $validatedData = $request->validate([
            'nama_file' => 'required|max:255',
            'file' => 'mimes:csv,txt,xlx,xls,pdf|file|max:1024',  
            'dokumen_mutu_id'=>'required'	
        ]);

        if ($request->file('file')) {
            $validatedData['file']=$request->file('file')->store('file-upload');
        }

        FileDokumen::create($validatedData); 

        return redirect()->back()->with('success','File berhasil ditambahkan!');
        // $dokumenMutuId = $request->input('dokumen_mutu_id');
        // $file = $request->file('file');
        // try {
        //     $fileDokumen = $this->fileDokumenService->add($request, $dokumenMutuId);
        //     $this->fileDokumenService->addFile($file, $fileDokumen->id);
        //     return redirect()->back()->with('success', 'File berhasil ditambahkan');
        // }catch (InvariantException $exception) {
        //     return redirect()->back()->with('error', 'File gagal ditambahkan')->withInput($request->all());
        // }
    }

    public function destroy(FileDokumen $fileDokumen) {
        //
        if ($fileDokumen->file) {
            Storage::delete($fileDokumen->file);
        }
        FileDokumen::destroy($fileDokumen->id); 

        return redirect()->back()->with('success','File berhasil dihapus!');


        // try {
        //     $this->fileDokumenService->deleteFile($id);
        //     return redirect()->back()->with('success', 'File berhasil dihapus');
        // }catch (InvariantException $exception) {
        //     return redirect()->back()->with('error', 'File gagal dihapus');
        // }
    }

}
