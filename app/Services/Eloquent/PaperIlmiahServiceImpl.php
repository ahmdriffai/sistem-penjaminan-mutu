<?php

namespace App\Services\Eloquent;

use App\Exceptions\InvariantException;
use App\Http\Requests\PaperIlmiahAddRequest;
use App\Http\Requests\PaperIlmiahUpdateRequest;
use App\Models\Dosen;
use App\Models\PaperIlmiah;
use App\Services\PaperIlmiahService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class PaperIlmiahServiceImpl implements PaperIlmiahService
{

    function add(PaperIlmiahAddRequest $request, string $owner): PaperIlmiah
    {
        $judul = $request->input('judul');
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');
        $media = $request->input('media');
        $issn = $request->input('issn');
        $sebagai = $request->input('sebagai');
        $indexs = $request->input('indexs');
        $kriteria = $request->input('kriteria');
        $link = $request->input('link');

        $dosen = Dosen::find($owner);

        if ($dosen == null) {
            throw new InvariantException('Gagal menemukan owner pengabdian');
        }

        try {
            DB::beginTransaction();
            $papaerIlmiah = new PaperIlmiah([
                'judul' => $judul,
                'tahun' => $tahun,
                'bulan' => $bulan,
                'media' => $media,
                'issn' => $issn,
                'sebagai' => $sebagai,
                'indexs' => $indexs,
                'kriteria' => $kriteria,
                'link' => $link
            ]);

            $dosen->paperIlmiah()->save($papaerIlmiah);
            DB::commit();
        }catch (\Exception $exception) {
            DB::rollBack();
            throw new InvariantException($exception->getMessage());
        }

        return $papaerIlmiah;
    }

    function list(string $key = '', int $size = 10): LengthAwarePaginator
    {
        $paperIlmiah = PaperIlmiah::where('judul', 'like', '%'. $key .'%')
            ->orderBy('created_at', 'DESC')->paginate($size);

        return $paperIlmiah;
    }

    function update(PaperIlmiahUpdateRequest $request, int $id): PaperIlmiah
    {
        $judul = $request->input('judul');
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');
        $media = $request->input('media');
        $issn = $request->input('issn');
        $sebagai = $request->input('sebagai');
        $indexs = $request->input('indexs');
        $kriteria = $request->input('kriteria');
        $link = $request->input('link');

        $paperIlmiah = PaperIlmiah::find($id);

        try {
            $paperIlmiah->judul = $judul;
            $paperIlmiah->tahun = $tahun;
            $paperIlmiah->bulan = $bulan;
            $paperIlmiah->media = $media;
            $paperIlmiah->issn = $issn;
            $paperIlmiah->sebagai = $sebagai;
            $paperIlmiah->indexs = $indexs;
            $paperIlmiah->kriteria = $kriteria;
            $paperIlmiah->link = $link;
            $paperIlmiah->save();
        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        return $paperIlmiah;
    }

    function delete(int $id): void
    {
        $paperIlmiah = PaperIlmiah::find($id);
        try {
            $paperIlmiah->delete();
        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }
    }

    function publish(int $id): PaperIlmiah
    {
        $paperIlmiah = PaperIlmiah::find($id);

        try {
            $paperIlmiah->publis = true;
            $paperIlmiah->save();
        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        return $paperIlmiah;
    }
}
