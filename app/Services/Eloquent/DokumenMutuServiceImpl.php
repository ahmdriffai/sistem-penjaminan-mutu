<?php

namespace App\Services\Eloquent;

use App\Exceptions\InvariantException;
use App\Helper\Media;
use App\Http\Requests\DokumenMutuAddRequest;
use App\Http\Requests\DokumenMutuUpdateRequest;
use App\Models\DokumenMutu;
use App\Models\PenjaminanMutu;
use App\Services\DokumenMutuService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class DokumenMutuServiceImpl implements DokumenMutuService
{

    function add(DokumenMutuAddRequest $request, $penjaminan_mutu_id) : DokumenMutu
    {
        $kodeDokumen = $request->input('kode_dokumen');
        $nama = $request->input('nama');
        $tahun = $request->input('tahun');
        $deskripsi = $request->input('deskripsi');
        $penjaminanMutu = PenjaminanMutu::find($penjaminan_mutu_id);

        try {
            DB::beginTransaction();
            $dokumenMutu = new DokumenMutu([
                'kode_dokumen' => $kodeDokumen,
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
            ->orderBy('penjaminan_mutu_id', 'ASC')
            ->orderBy('created_at', 'ASC')
            ->paginate($size);

        return $paginate;
    }

    function update(DokumenMutuUpdateRequest $request, $penjaminan_mutu_id, int $id): DokumenMutu
    {
        $kodeDokumen = $request->input('kode_dokumen');
        $nama = $request->input('nama');
        $tahun = $request->input('tahun');
        $deskripsi = $request->input('deskripsi');

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

    function listById(int $id, string $key = '', int $size = 10): LengthAwarePaginator
    {
        if ($id == null) {
            throw new InvariantException("Dokumen Mutu tidak ditemukan");
        }
        $paginate = DokumenMutu::where('penjaminan_mutu_id', $id)
            ->where('nama', 'like', '%' . $key . '%')
            ->orderBy('penjaminan_mutu_id', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->paginate($size);

        return $paginate;
    }
}
