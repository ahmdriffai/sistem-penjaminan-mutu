<?php

namespace App\Services\Eloquent;

use App\Exceptions\InvariantException;
use App\Helper\Media;
use App\Http\Requests\AuditAddRequest;
use App\Http\Requests\AuditUpdateRequest;
use App\Models\Audit;
use App\Services\AuditService;
use Illuminate\Pagination\LengthAwarePaginator;

class AuditServiceImpl implements AuditService
{

    use Media;

    function add(AuditAddRequest $request): Audit
    {
        $nama = $request->input('nama');
        $tahun = $request->input('tahun');
        $semester = $request->input('semester');

        try {
            $audit = new Audit([
                'nama' => $nama,
                'tahun' => $tahun,
                'semester' => $semester,
                'file_url' => null,
                'file_path' => null,
            ]);
            $audit->save();
        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        return $audit;
    }

    function list(string $key = '', int $size = 10): LengthAwarePaginator
    {
        $paginate = Audit::where('nama', 'like', '%' . $key . '%')
            ->orderBy('created_at', 'DESC')
            ->paginate($size);

        return $paginate;
    }

    function update(AuditUpdateRequest $request, int $id): Audit
    {
        $nama = $request->input('nama');
        $tahun = $request->input('tahun');
        $semester = $request->input('semester');

        $audit = Audit::find($id);

        try {
            $audit->nama = $nama;
            $audit->tahun = $tahun;
            $audit->semester = $semester;
            $audit->save();
        }catch (\Exception $exception){
            throw new InvariantException($exception->getMessage());
        }

        return $audit;
    }

    function delete(int $id): void
    {
        $audit = Audit::find($id);
        try {
            if ($audit->file_path != null) {
                unlink($audit->file_path);
            }

            $audit->delete();
        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }
    }

    function show(int $id): Audit
    {
        $audit = Audit::find($id);
        return $audit;
    }

    function addFile($file, int $id): Audit
    {
        $audit = Audit::find($id);

        try {
            $dataFile = $this->uploads($file, 'audit/');
            $fileUrl = asset('storage/'. $dataFile['filePath']);
            $filePath = public_path('storage/'. $dataFile['filePath']);

            $audit->file_url = $fileUrl;
            $audit->file_path = $filePath;
            $audit->save();
        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        return $audit;
    }

    function updateFile($file, int $id): Audit
    {
        $audit = Audit::find($id);

        try {
            if ($audit->file_path != null) {
                unlink($audit->file_path);
            }

            $dataFile = $this->uploads($file, 'audit/');
            $filePath = public_path('storage/'. $dataFile['filePath']);
            $fileUrl = asset('storage/'. $dataFile['filePath']);

            $audit->file_path = $filePath;
            $audit->file_url = $fileUrl;
            $audit->save();

        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        return $audit;
    }

    function deleteFile($file, int $id): Audit
    {
        $audit = Audit::find($id);

        try {
            if ($audit->file_path != null) {
                unlink($audit->file_path);
            }

            $audit->file_url = null;
            $audit->file_path = null;
            $audit->save();
        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        return $audit;
    }
}
