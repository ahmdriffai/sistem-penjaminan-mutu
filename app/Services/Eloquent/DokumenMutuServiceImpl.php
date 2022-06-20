<?php

namespace App\Services\Eloquent;

use App\Exceptions\InvariantException;
use App\Helper\Media;
use App\Models\DokumenMutu;
use App\Models\PenjaminanMutu;
use App\Services\DokumenMutuService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class DokumenMutuServiceImpl implements DokumenMutuService
{

    use Media;

    function add($kodeDokument, $nama, $tahun, $deskripsi, $penjaminan_mutu_id) : DokumenMutu
    {
        $penjaminanMutu = PenjaminanMutu::find($penjaminan_mutu_id);
        try {
            DB::beginTransaction();
            $dokumenMutu = new DokumenMutu([
                'kode_dokumen' => $kodeDokument,
                'nama' => $nama,
                'tahun' => $tahun,
                'deskripsi' => $deskripsi
            ]);

            $penjaminanMutu->dokumenMutu()->save($dokumenMutu);

            $dokumenMutu->save();
            DB::commit();
        }catch (\Exception $exception) {
            DB::rollBack();
            throw new InvariantException($exception->getMessage());
        }

        return $dokumenMutu;
    }

    function list(string $key = '', int $size = 10): LengthAwarePaginator
    {
        $paginate = DokumenMutu::where('kode_dokumen', 'like', '%' . $key . '%')
            ->orWhere('nama', 'like', '%' . $key . '%')
            ->oderBy('created_at', 'DESC')
            ->paginate($size);

        return $paginate;
    }

    function update($kodeDokumen, $nama, $tahun, $deskripsi, $penjaminan_mutu_id, int $id): DokumenMutu
    {
        $dokumenMutu = DokumenMutu::find($id);
        try {
            DB::beginTransaction();
            $dokumenMutu->kode_dokumen = $kodeDokumen;
            $dokumenMutu->nama = $nama;
            $dokumenMutu->tahun = $tahun;
            $dokumenMutu->deskripsi = $deskripsi;

            $dokumenMutu->penjaminanMutu()->associate($penjaminan_mutu_id);

            DB::commit();
        }catch (\Exception $exception) {
            DB::rollBack();
            throw new InvariantException($exception->getMessage());
        }

        return $dokumenMutu;
    }

    function delete(int $id): void
    {
        $dokumenMutu = DokumenMutu::find($id);
        try {
            if ($dokumenMutu->file_url != null || $dokumenMutu->file_path != null) {
                unlink($dokumenMutu->file_path);
            }

            $dokumenMutu->delete();

        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }
    }

    function show(int $id): DokumenMutu
    {
        $dokumenMutu = DokumenMutu::find($id);
        return $dokumenMutu;
    }

    function addFile(int $id, $file): DokumenMutu
    {
        $dokumenMutu = DokumenMutu::find($id);


        try {
            $dataFile = $this->uploads($file, 'dokumen-mutu/');
            $fileUrl = asset('storage/'. $dataFile['filePath']);
            $filePath = public_path('storage/'. $dataFile['filePath']);

            $dokumenMutu->file_url = $fileUrl;
            $dokumenMutu->file_path = $filePath;
            $dokumenMutu->save();
        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        return $dokumenMutu;
    }

    function updateFile(int $id, $file): DokumenMutu
    {
        $dokumenMutu = DokumenMutu::find($id);

        try {
            if ($dokumenMutu->file_url != null || $dokumenMutu->file_path != null) {
                unlink($dokumenMutu->file_path);
            }

            $dataFile = $this->uploads($file, 'dokumen-mutu/');
            $filePath = public_path('storage/'. $dataFile['filePath']);
            $fileUrl = asset('storage/'. $dataFile['filePath']);

            $dokumenMutu->file_path = $filePath;
            $dokumenMutu->file_url = $fileUrl;
            $dokumenMutu->save();

        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        return $dokumenMutu;
    }

    function deleteFile(int $id): DokumenMutu
    {
        $dokumenMutu = DokumenMutu::find($id);

        try {
            if ($dokumenMutu->file_url != null || $dokumenMutu->file_path != null) {
                unlink($dokumenMutu->file_path);
            }

            $dokumenMutu->file_url = null;
            $dokumenMutu->file_path = null;
            $dokumenMutu->save();
        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        return $dokumenMutu;
    }
}
