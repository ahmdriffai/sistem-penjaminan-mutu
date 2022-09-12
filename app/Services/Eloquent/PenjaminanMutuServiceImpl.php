<?php

namespace App\Services\Eloquent;

use App\Exceptions\InvariantException;
use App\Models\PenjaminanMutu;
use App\Services\PengabdianService;
use App\Services\PenjaminanMutuService;
use Illuminate\Pagination\LengthAwarePaginator;
use PHPUnit\Exception;

class PenjaminanMutuServiceImpl implements PenjaminanMutuService
{

    function add($nama, $keterangan): PenjaminanMutu
    {
        try {
            $penjaminanMutu = new PenjaminanMutu([
                'nama' => $nama,
                'keterangan' => $keterangan
            ]);

            $penjaminanMutu->save();
        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        return $penjaminanMutu;
    }

    function list(string $key = '', int $size = 10): LengthAwarePaginator
    {
        $penjaminanMutu = PenjaminanMutu::where('nama', 'like', '%' . $key . '%')
            ->orderBy('id', 'DESC')->paginate($size);

        return $penjaminanMutu;
    }

    function update($nama, $ketarangan, $id): PenjaminanMutu
    {
        $penjaminanMutu = PenjaminanMutu::find($id);

        try {
            $penjaminanMutu->nama = $nama;
            $penjaminanMutu->keterangan = $ketarangan;
            $penjaminanMutu->save();
        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        return $penjaminanMutu;
    }

    function delete(int $id): void
    {
        $penjaminanMutu = PenjaminanMutu::find($id);

        try {
            $penjaminanMutu->delete();
        }catch (Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }
    }
}
