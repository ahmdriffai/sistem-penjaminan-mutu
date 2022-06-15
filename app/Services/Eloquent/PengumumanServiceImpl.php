<?php

namespace App\Services\Eloquent;

use App\Exceptions\InvariantException;
use App\Helper\Media;
use App\Models\Pengumuman;
use App\Services\PengumumanService;

class PengumumanServiceImpl implements PengumumanService
{
    use Media;

    function add(string $judul, string $isi): Pengumuman
    {
        try {
            $pengumuman = new Pengumuman([
                'judul' => $judul,
                'isi' => $isi,
                'file_url' => null,
                'file_path' => null,
            ]);
            $pengumuman->save();

            return $pengumuman;
        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }
    }

    function addFile(int $id, $file): Pengumuman
    {
        $pengumuman = Pengumuman::find($id);


        try {
            $dataFile = $this->uploads($file, 'pengumuman/');
            $fileUrl = asset('storage/'. $dataFile['filePath']);
            $filePath = public_path('storage/'. $dataFile['filePath']);

            $pengumuman->file_url = $fileUrl;
            $pengumuman->file_path = $filePath;
            $pengumuman->save();
        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        return $pengumuman;
    }

    function edit(int $id, string $judul, string $isi): Pengumuman
    {
        $pengumuman = Pengumuman::find($id);

        try {
            $pengumuman->judul = $judul;
            $pengumuman->isi = $isi;
            $pengumuman->save();
        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        return $pengumuman;
    }

    function delete(int $id): void
    {
        $pengumuman = Pengumuman::find($id);
        try {
            if ($pengumuman->file_url != null || $pengumuman->file_path != null) {
                unlink($pengumuman->file_path);
            }

            $pengumuman->delete();

        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }
    }

    function deleteFile(int $id, $file): Pengumuman
    {
        $pengumuman = Pengumuman::find($id);

        try {
            if ($pengumuman->file_url != null || $pengumuman->file_path != null) {
                unlink($pengumuman->file_path);
            }

            $pengumuman->file_url = null;
            $pengumuman->file_path = null;
            $pengumuman->save();
        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        return $pengumuman;
    }

    function editFile(int $id, $file): Pengumuman
    {
        $pengumuman = Pengumuman::find($id);

        try {
            if ($pengumuman->file_url != null || $pengumuman->file_path != null) {
                unlink($pengumuman->file_path);
            }

            $dataFile = $this->uploads($file, 'pengumuman/');
            $filePath = public_path('storage/'. $dataFile['filePath']);
            $fileUrl = asset('storage/'. $dataFile['filePath']);

            $pengumuman->file_path = $filePath;
            $pengumuman->file_url = $fileUrl;
            $pengumuman->save();

        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        return $pengumuman;
    }
}
