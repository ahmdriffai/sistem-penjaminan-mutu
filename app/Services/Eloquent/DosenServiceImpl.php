<?php

namespace App\Services\Eloquent;

use App\Exceptions\InvariantException;
use App\Helper\Media;
use App\Models\Dosen;
use App\Services\DosenService;
use App\UseCase\DosenUC;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class DosenServiceImpl implements DosenService
{

    use Media;
    function add(DosenUC $request): Dosen
    {
        try {
            DB::beginTransaction();
            $dosen = new Dosen([
                'nidn' => $request->getNidn(),
                'nama' => $request->getNama(),
                'tempat_lahir' => $request->getTempatLahir(),
                'tanggal_lahir' => $request->getTanggalLahir(),
                'nik' => $request->getNik(),
                'jenis_kelamin' => $request->getJenisKelamin(),
                'nomer_hp' => $request->getNomerHp(),
                'alamat' => $request->getAlamat(),
                'foto_url' => null,
                'foto_path' => null,
                'user_id' => null
            ]);
            $dosen->save();
            DB::commit();
        }catch (\Exception $exception) {
            DB::rollBack();
            throw new InvariantException($exception->getMessage());
        }

        return $dosen;
    }

    function list(string $key = '', int $size = 10): LengthAwarePaginator
    {
        $dosen = Dosen::where('nama', 'like', '%'.$key.'%')->paginate($size);

        return $dosen;
    }

    function update(DosenUC $request, string $nidn): Dosen
    {
        $dosen = Dosen::find($nidn);
        try {
            $dosen->nama = $request->getNama();
            $dosen->tempat_lahir = $request->getTempatLahir();
            $dosen->tanggal_lahir = $request->getTanggalLahir();
            $dosen->nik = $request->getNik();
            $dosen->jenis_kelamin = $request->getJenisKelamin();
            $dosen->nomer_hp = $request->getNomerHp();
            $dosen->alamat = $request->getAlamat();
            $dosen->alamat = $request->getAlamat();
            $dosen->save();
        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        return $dosen;
    }

    function delete(string $nidn): void
    {
        $dosen = Dosen::find($nidn);
        try {
            if ($dosen->foto_url != null || $dosen->foto_path != null) {
                unlink($dosen->foto_path);
            }

            $dosen->delete();
        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }
    }

    function addImage(string $nidn, $image): Dosen
    {
        $dosen = Dosen::find($nidn);


        try {
            $dataFile = $this->uploads($image, 'dosen/foto');
            $fileUrl = asset('storage/'. $dataFile['filePath']);
            $filePath = public_path('storage/'. $dataFile['filePath']);

            $dosen->foto_url = $fileUrl;
            $dosen->foto_path = $filePath;
            $dosen->save();
        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        return $dosen;
    }

    function deleteImage(string $nidn): Dosen
    {
        $dosen = Dosen::find($nidn);

        try {
            if ($dosen->foto_url != null || $dosen->foto_path != null) {
                unlink($dosen->foto_path);
            }

            $dosen->foto_url = null;
            $dosen->foto_path = null;
            $dosen->save();
        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        return $dosen;
    }

    function updateImage(string $nidn, $image): Dosen
    {
        $dosen = Dosen::find($nidn);

        try {
            if ($dosen->foto_url != null || $dosen->foto_path != null) {
                unlink($dosen->foto_path);
            }

            $dataFile = $this->uploads($image, 'dosen/foto');
            $filePath = public_path('storage/'. $dataFile['filePath']);
            $fileUrl = asset('storage/'. $dataFile['filePath']);

            $dosen->foto_path = $filePath;
            $dosen->foto_url = $fileUrl;
            $dosen->save();

        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        return $dosen;
    }

    function show(string $nidn): Dosen
    {
        $dosen = Dosen::find($nidn);

        return $dosen;
    }
}
