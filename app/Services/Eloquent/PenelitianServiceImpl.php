<?php

namespace App\Services\Eloquent;

use App\Exceptions\InvariantException;
use App\Http\Requests\PenelitianAddRequest;
use App\Http\Requests\PenelitianUpdateRequest;
use App\Models\Dosen;
use App\Models\Penelitian;
use App\Services\PenelitianService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class PenelitianServiceImpl implements PenelitianService
{

    function add(PenelitianAddRequest $request, string $owner): Penelitian
    {
        $judul = $request->input('judul');
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');
        $sumber_dana = $request->input('sumber_dana');
        $jumlah = $request->input('jumlah');
        $sebagai = $request->input('sebagai');
        $dosen = Dosen::find($owner);

        if ($dosen == null) {
            throw new InvariantException('Gagal menumukan owner penelitian');
        }

        try {
            DB::beginTransaction();;
            $penelitian = new Penelitian([
                'judul' => $judul,
                'tanggal_mulai' => $tanggalMulai,
                'tanggal_selesai' => $tanggalSelesai,
                'sumber_dana' => $sumber_dana,
                'jumlah' => $jumlah,
                'sebagai' => $sebagai,
                'publis' => false,
            ]);

            $dosen->penelitian()->save($penelitian);

            DB::commit();
        }catch (\Exception $exception) {
            DB::rollBack();
            throw new InvariantException($exception->getMessage());
        }

        return $penelitian;
    }

    function list(string $key = '', int $size = 10): LengthAwarePaginator
    {
        $penelitian = Penelitian::where('judul', 'like', '%'. $key .'%')
            ->orderBy('created_at', 'DESC')->paginate($size);

        return $penelitian;
    }

    function update(PenelitianUpdateRequest $request, int $id): Penelitian
    {
        $judul = $request->input('judul');
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');
        $sumber_dana = $request->input('sumber_dana');
        $jumlah = $request->input('jumlah');
        $sebagai = $request->input('sebagai');

        $penelitian = Penelitian::find($id);

        try {
            DB::beginTransaction();
            $penelitian->judul = $judul;
            $penelitian->tanggal_mulai = $tanggalMulai;
            $penelitian->tanggal_selesai= $tanggalSelesai;
            $penelitian->sumber_dana = $sumber_dana;
            $penelitian->jumlah = $jumlah;
            $penelitian->sebagai = $sebagai;
            $penelitian->save();
            DB::commit();
        }catch (\Exception $exception) {
            DB::rollBack();
        }

        return $penelitian;
    }

    function delete(int $id): void
    {
        $penelitian = Penelitian::find($id);
        try {
            $penelitian->delete();
        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }
    }

    function publis(int $id): Penelitian
    {
        $penelitian = Penelitian::find($id);

        try {
            $penelitian->publis = true;
            $penelitian->save();
        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        return $penelitian;
    }

    function listByNidn(string $owner, string $key = '', int $size = 10): LengthAwarePaginator
    {
        $penelitian = Penelitian::where('owner', $owner)
            ->where('judul', 'like', '%'. $key .'%')
            ->orderBy('created_at', 'DESC')->paginate($size);

        return $penelitian;
    }
}
