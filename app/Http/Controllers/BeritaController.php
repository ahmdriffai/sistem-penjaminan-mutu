<?php

namespace App\Http\Controllers;

use App\Exceptions\InvariantException;
use App\Http\Requests\BeritaAddRequest;
use App\Http\Requests\BeritaUpdateRequest;
use App\Models\Berita;
use App\Services\BeritaService;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    private $title = 'Berita';

    private BeritaService $beritaService;

    public function __construct(BeritaService $beritaService)
    {
        $this->beritaService = $beritaService;
    }

    public function index(Request $request)
    {
        $title = $this->title;
        $key = $request->query('key') ?? '';
        $data = $this->beritaService->list($key, 10);
        return response()->view('berita.index', compact('title', 'data'));
    }

    public function create()
    {
        $title = $this->title;
        return response()->view('berita.create', compact('title'));
    }

    public function store(BeritaAddRequest $request)
    {
        $gambar = $request->file('gambar');
        try {
            $berita = $this->beritaService->add($request);
            $this->beritaService->addImage($berita->id, $gambar);
            return response()->redirectTo(route('berita.index'))->with('success', 'Berhasil menambahkan berita');
        }catch (InvariantException $exception) {
            return redirect()->back()->with('error', $exception->getMessage())->withInput($request->all());
        }
    }

    public function show($id)
    {
        $title = $this->title;
        $berita = Berita::find($id);
        return response()->view('berita.show', compact('berita', 'title'));
    }

    public function edit($id)
    {
        $title = $this->title;
        $berita = Berita::find($id);
        return response()->view('berita.edit', compact('title', 'berita'));

    }

    public function update(BeritaUpdateRequest $request, $id)
    {
        $gambar = $request->file('gambar');

        try {
            $result = $this->beritaService->update($request, $id);
            if ($gambar != null) {
                $this->beritaService->updateImage($id, $gambar);
            }
            return response()->redirectTo(route('berita.index'))->with('success', 'Berhasil mengubah berita');
        }catch (InvariantException $exception) {
            return redirect()->back()->with('error', $exception->getMessage())->withInput($request->all());
        }
    }

    public function destroy($id)
    {
        try {
            $this->beritaService->delete($id);
            return response()->redirectTo(route('berita.index'))->with('success', 'Berhasil menghapus berita');
        }catch (InvariantException $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
