<?php

namespace App\Http\Controllers;

use App\Exceptions\InvariantException;
use App\Http\Requests\PengumumanAddRequest;
use App\Models\Pengumuman;
use App\Services\PengumumanService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PengumumanController extends Controller
{
    private $title = 'Pengumuman';

    private PengumumanService $pengumumanService;

    public function __construct(PengumumanService $pengumumanService)
    {
        $this->middleware(['role:admin'])->only(['index']);
        $this->pengumumanService = $pengumumanService;
    }


    public function index(Request $request)
    {
        $title = $this->title;
        $key = $request->query('key') ?? '';
        $size = $request->query('size') ?? 10;
        $data = $this->pengumumanService->list($key, $size);
        return response()->view('pengumuman.index', compact('data', 'title'));
    }

    public function create()
    {
        $title = $this->title;
        return response()->view('pengumuman.create', compact('title'));
    }


    public function store(PengumumanAddRequest $request)
    {
        $judul = $request->input('judul');
        $isi = $request->input('judul');
        $file = $request->file('file');
        try {
            $pengumuman = $this->pengumumanService->add($judul, $isi);
            $this->pengumumanService->addFile($pengumuman->id, $file);
            return response()->redirectTo(route('pengumuman.index'))->with('success', 'Pengumuman berhasil ditambah');
        }catch (InvariantException $exception) {
            return redirect()->back()->with('error', 'Gagal menambah pengumuman, terjadi kesalahan pada server')
                ->withInput($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
