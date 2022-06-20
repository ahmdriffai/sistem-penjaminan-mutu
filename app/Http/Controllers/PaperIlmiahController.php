<?php

namespace App\Http\Controllers;

use App\Exceptions\InvariantException;
use App\Http\Requests\PaperIlmiahAddRequest;
use App\Http\Requests\PaperIlmiahUpdateRequest;
use App\Models\PaperIlmiah;
use App\Services\PaperIlmiahService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaperIlmiahController extends Controller
{
    private $title = 'Jurnal Ilmiah';

    private PaperIlmiahService $paperIlmiahService;

    public function __construct(PaperIlmiahService $paperIlmiahService)
    {
        $this->paperIlmiahService = $paperIlmiahService;
    }


    public function index(Request $request)
    {
        $title = $this->title;
        $key = $request->query('key') ?? '';
        $size = $request->query('size') ?? 10;
        $data = $this->paperIlmiahService->list($key, $size);
        return response()->view('paper-ilmiah.index', compact('title', 'data'));
    }

    public function create()
    {
        $title = $this->title;
        return response()->view('paper-ilmiah.create', compact('title'));
    }

    public function store(PaperIlmiahAddRequest $request)
    {
        $owner = Auth::user()->dosen->nidn ?? null;
        try {
            $this->paperIlmiahService->add($request, $owner);
            return response()->redirectTo(route('paper-ilmiah.index'))->with('success', 'Jurnal ilmiah berhasil ditambahkan');
        }catch (InvariantException $exception) {
            return redirect()->back()->with('error', 'Gagal menambah jurnal ilmiah')->withInput($request->all());
        }
    }

    public function edit($id)
    {
        $title = $this->title;
        $paperIlmiah = PaperIlmiah::find($id);
        return response()->view('paper-ilmiah.edit', compact('title', 'paperIlmiah'));
    }

    public function update(PaperIlmiahUpdateRequest $request, $id)
    {
        try {
            $this->paperIlmiahService->update($request, $id);
            return response()->redirectTo(route('paper-ilmiah.index'))->with('success', 'Jurnal ilmiah berhasil diubah');
        }catch (InvariantException $exception){
            return redirect()->back()->with('error', 'Gagal menambah jurnal ilmiah')->withInput($request->all());
        }
    }

    public function destroy($id)
    {
        try {
            $this->paperIlmiahService->delete($id);
            return response()->redirectTo(route('paper-ilmiah.index'))->with('success', 'Jurnal ilmiah berhasil dihapus');
        }catch (InvariantException $exception) {
            return redirect()->back()->with('error', 'Gagal menghapus jurnal ilmiah');

        }
    }
}
