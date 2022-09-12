<?php

namespace App\Services\Eloquent;

use App\Exceptions\InvariantException;
use App\Helper\Media;
use App\Http\Requests\FileDokumenAddRequest;
use App\Http\Requests\FileDokumenRenameRequest;
use App\Models\FileDokumen;
use App\Services\FileDokumenService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class FileDokumenServiceImpl implements FileDokumenService
{

    use Media;

    function add(FileDokumenAddRequest $request, int $dokumenMutuId): FileDokumen
    {

        $namaFile = $request->input('nama_file');
        try {
            DB::beginTransaction();
            $fileDokumen = new FileDokumen([
                'nama_file' => $namaFile,
                'file_url' => null,
                'file_path' => null,
                'format' => null,
                'dokumen_mutu_id' => $dokumenMutuId
            ]);
            $fileDokumen->save();
            DB::commit();
        }catch (\Exception $exception) {
            DB::rollBack();
            throw new InvariantException($exception->getMessage());
        }

        return $fileDokumen;
    }

    function list(string $key = ''): Collection
    {
        $collection = FileDokumen::where('nama_file', 'like', '%' . $key . '%')
            ->orderBy('created_at', 'DESC')
            ->get();

        return $collection;
    }

    function rename(FileDokumenRenameRequest $request, int $id): FileDokumen
    {
        $nameFile = $request->input('nama_file');

        $fileDokumen = FileDokumen::find($id);

        try {
            $fileDokumen->nama_file = $nameFile;
            $fileDokumen->save();
        }catch (\Exception $exception) {
            throw new InvariantException($exception);
        }

        return $fileDokumen;
    }

    function addFile($file, int $id): FileDokumen
    {
        $fileDokumen = FileDokumen::find($id);

        try {
            $dataFile = $this->uploads($file, 'file-dokumen/');
        
            $fileUrl = asset('storage/'. $dataFile['filePath']);
            $filePath = public_path('storage/'. $dataFile['filePath']);
            $fileFormat = $dataFile['fileType'];

            $fileDokumen->file_url = $fileUrl;
            $fileDokumen->file_path = $filePath;
            $fileDokumen->format = $fileFormat;
            $fileDokumen->save();
        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        return $fileDokumen;
    }

    function updateFile($file, int $id): FileDokumen
    {
        $fileDokumen = FileDokumen::find($id);

        try {
            if ($fileDokumen->file_path != null) {
                unlink($fileDokumen->file_path);
            }

            $dataFile = $this->uploads($file, 'pengumuman/');
            $filePath = public_path('storage/'. $dataFile['filePath']);
            $fileUrl = asset('storage/'. $dataFile['filePath']);
            $fileFormat = $dataFile['fileType'];

            $fileDokumen->file_path = $filePath;
            $fileDokumen->file_url = $fileUrl;
            $fileDokumen->format = $fileFormat;
            $fileDokumen->save();

        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        return $fileDokumen;
    }

    function deleteFile(int $id): void
    {
        $fileDokumen = FileDokumen::find($id);

        try {
            if ($fileDokumen->file_path != null) {
                unlink($fileDokumen->file_path);
            }
            $fileDokumen->delete();
        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }
    }
}
