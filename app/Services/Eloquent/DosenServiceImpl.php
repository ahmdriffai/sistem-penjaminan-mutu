<?php

namespace App\Services\Eloquent;

use App\Exceptions\InvariantException;
use App\Helper\Media;
use App\Http\Requests\DosenAddRequest;
use App\Http\Requests\DosenUpdateRequest;
use App\Models\Dosen;
use App\Services\DosenService;
use App\UseCase\DosenUC;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class DosenServiceImpl implements DosenService
{

    use Media;
    function add(DosenAddRequest $request): Dosen
    {
        $nidn = $request->input('nidn');
        $nama = $request->input('nama');
        $tempatLahir = $request->input('tempat_lahir');
        $tanggalLahir = $request->input('tanggal_lahir');
        $nik = $request->input('nik');
        $jenisKelamin = $request->input('jenis_kelamin');
        $nomerHp = $request->input('nomer_hp');
        $alamat = $request->input('alamat');
        try {
            DB::beginTransaction();
            $dosen = new Dosen([
                'nidn' => $nidn,
                'nama' => $nama,
                'tempat_lahir' => $tempatLahir,
                'tanggal_lahir' => $tanggalLahir,
                'nik' => $nik,
                'jenis_kelamin' => $jenisKelamin,
                'nomer_hp' => $nomerHp,
                'alamat' => $alamat,
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

    function update(DosenUpdateRequest $request, string $nidn): Dosen
    {

        $nama = $request->input('nama');
        $tempatLahir = $request->input('tempat_lahir');
        $tanggalLahir = $request->input('tanggal_lahir');
        $nik = $request->input('nik');
        $jenisKelamin = $request->input('jenis_kelamin');
        $nomerHp = $request->input('nomer_hp');
        $alamat = $request->input('alamat');

        $dosen = Dosen::find($nidn);

        try {
            $dosen->nama = $nama;
            $dosen->tempat_lahir = $tempatLahir;
            $dosen->tanggal_lahir = $tanggalLahir;
            $dosen->nik = $nik;
            $dosen->jenis_kelamin = $jenisKelamin;
            $dosen->nomer_hp = $nomerHp;
            $dosen->alamat = $alamat;
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
