<?php

namespace App\Services\Eloquent;

use App\Exceptions\InvariantException;
use App\Http\Requests\PenelitianUpdateRequest;
use App\Http\Requests\PengabdianAddRequest;
use App\Http\Requests\PengabdianUpdateRequest;
use App\Models\Dosen;
use App\Models\Pengabdian;
use App\Services\PengabdianService;
use App\Services\PengumumanService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class PengabdianServiceImpl implements PengabdianService
{

    function add(PengabdianAddRequest $request, string $owner): Pengabdian
    {
        $judul = $request->input('judul');
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');
        $sumberDana = $request->input('sumber_dana');
        $jumlah = $request->input('jumlah');
        $sebagai = $request->input('sebagai');

        $dosen = Dosen::find($owner);

        if ($dosen == null) {
            throw new InvariantException('Gagal menemukan owner pengabdian');
        }

        try {
            DB::beginTransaction();
            $pengabdian = new Pengabdian([
                'judul' => $judul,
                'tanggal_mulai' => $tanggalMulai,
                'tanggal_selesai' => $tanggalSelesai,
                'sumber_dana' => $sumberDana,
                'jumlah' => $jumlah,
                'sebagai' => $sebagai,
                'publis' => false,
            ]);

            $dosen->pengabdian()->save($pengabdian);
            DB::commit();
        }catch (\Exception $exception) {
            DB::rollBack();
            throw new InvariantException($exception->getMessage());
        }

        return $pengabdian;
    }

    function list(string $key = '', int $size = 10): LengthAwarePaginator
    {
        $pengabdian = Pengabdian::where('judul', 'like', '%' . $key . '%')
            ->orderby('created_at', 'DESC')->paginate($size);

        return $pengabdian;
    }

    function update(PengabdianUpdateRequest $request, int $id): Pengabdian
    {
        $pengabdian = Pengabdian::find($id);

        $judul = $request->input('judul');
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');
        $sumberDana = $request->input('sumber_dana');
        $jumlah = $request->input('jumlah');
        $sebagai = $request->input('sebagai');

        try {
            $pengabdian->judul = $judul;
            $pengabdian->tanggal_mulai = $tanggalMulai;
            $pengabdian->tanggal_selesai = $tanggalSelesai;
            $pengabdian->sumber_dana = $sumberDana;
            $pengabdian->jumlah = $jumlah;
            $pengabdian->sebagai = $sebagai;
            $pengabdian->save();
        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        return $pengabdian;
    }

    function delete(int $id): void
    {
        $pengabdian = Pengabdian::find($id);
        try {
            $pengabdian->delete();
        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }
    }

    function publis(int $id): Pengabdian
    {
        $pengabdian = Pengabdian::find($id);

        try {
            $pengabdian->publis = true;
            $pengabdian->save();
        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        return $pengabdian;
    }
}
