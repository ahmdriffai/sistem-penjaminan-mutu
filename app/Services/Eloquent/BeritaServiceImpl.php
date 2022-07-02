<?php

namespace App\Services\Eloquent;

use App\Exceptions\InvariantException;
use App\Helper\Media;
use App\Http\Requests\BeritaAddRequest;
use App\Http\Requests\BeritaUpdateRequest;
use App\Models\Berita;
use App\Services\BeritaService;
use Illuminate\Pagination\LengthAwarePaginator;

class BeritaServiceImpl implements BeritaService
{
    use Media;

    function add(BeritaAddRequest $request): Berita
    {
        $judul = $request->input('judul');
        $isi = $request->input('isi');
        $penulis = $request->input('penulis');
        try {

            $berita = new Berita([
                'judul' => $judul,
                'isi' => $isi,
                'penulis' => $penulis
            ]);

            $berita->save();

        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        return $berita;
    }

    function list(string $key = '', int $size = 10): LengthAwarePaginator
    {
        $paginate = Berita::where('judul', 'like', '%' . $key . '%')
            ->orWhere('isi', 'like', '%' . $key . '%')
            ->orderBy('created_at', 'DESC')
            ->paginate($size);

        return $paginate;
    }

    function update(BeritaUpdateRequest $request, int $id): Berita
    {
        $berita = Berita::find($id);
        $judul = $request->input('judul');
        $isi = $request->input('isi');
        $penulis = $request->input('penulis');

        try {
            $berita->judul = $judul;
            $berita->isi = $isi;
            $berita->penulis = $penulis;
            $berita->save();
        }catch (\Exception $exception) {
            throw new  InvariantException($exception->getMessage());
        }

        return $berita;
    }

    function delete(int $id): void
    {
        $berita = Berita::find($id);
        try {
            if ($berita->gambar_path != null) {
                unlink($berita->gambar_path);
            }

            $berita->delete();

        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }
    }

    function addImage(int $id, $image): Berita
    {
        $berita = Berita::find($id);

        try {
            if ($berita->gambar_path != null) {
                unlink($berita->gambar_path);
            }

            $dataFile = $this->uploads($image, 'berita/gambar/');
            $filePath = public_path('storage/'. $dataFile['filePath']);
            $fileUrl = asset('storage/'. $dataFile['filePath']);

            $berita->gambar_path = $filePath;
            $berita->gambar_url = $fileUrl;
            $berita->save();

        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        return $berita;
    }

    function deleteImage(int $id): Berita
    {
        $berita = Berita::find($id);

        try {
            if ($berita->gambar_path != null) {
                unlink($berita->gambar_path);
            }

            $berita->gambar_url = null;
            $berita->gambar_path = null;
            $berita->save();
        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        return $berita;
    }

    function updateImage(int $id, $image): Berita
    {
        $berita = Berita::find($id);

        try {
            if ($berita->gambar_path != null) {
                unlink($berita->gambar_path);
            }

            $dataFile = $this->uploads($image, 'pengumuman/');
            $filePath = public_path('storage/'. $dataFile['filePath']);
            $fileUrl = asset('storage/'. $dataFile['filePath']);

            $berita->gambar_path = $filePath;
            $berita->gambar_url = $fileUrl;
            $berita->save();

        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        return $berita;
    }
}
