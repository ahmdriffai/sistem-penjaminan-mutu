<?php

namespace App\Http\Controllers;

use App\Exceptions\InvariantException;
use App\Http\Requests\AuditAddRequest;
use App\Http\Requests\AuditUpdateRequest;
use App\Models\Audit;
use App\Services\AuditService;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    private $title = 'Audit';

    private AuditService $auditService;

    public function __construct(AuditService $auditService)
    {
        $this->auditService = $auditService;
    }

    public function index(Request $request)
    {
        $key = $request->query('key') ?? '';
        $size = $request->query('size') ?? 10;
        $title = $this->title;
        $data = $this->auditService->list($key, $size);
        return response()->view('audit.index', compact('title', 'data'));
    }

    public function create()
    {
        $title =$this->title;
        return response()->view('audit.create', compact('title'));
    }

    public function store(AuditAddRequest $request)
    {
        $file = $request->file('file');
        try {
            $audit = $this->auditService->add($request);
            $this->auditService->addFile($file, $audit->id);
            return response()->redirectTo(route('audit.index'))->with('success', 'Audit berhasil ditambahkan');
        }catch (InvariantException $exception){
            return redirect()->back()->with('error' , 'Gagal menambah audit, terjadi kesalahan pada server ')
                ->withInput($request->all());
        }
    }

    public function edit($id)
    {
        $title = $this->title;
        $audit = Audit::find($id);
        return response()->view('audit.edit', compact('audit', 'title'));
    }

    public function update(AuditUpdateRequest $request, $id)
    {
        try {
            $this->auditService->update($request, $id);
            return response()->redirectTo(route('audit.index'))->with('success', 'Audit berhasil diubah');
        }catch (InvariantException $exception) {
            return redirect()->back()->with('error', 'Gagal mengubah audit, terjadi kesalahan pada server')
                ->withInput($request->all());
        }
    }

    public function destroy($id)
    {
        try {
            $this->auditService->delete($id);
            return response()->redirectTo(route('audit.index'))->with('success', 'Audit berhasil dihapus');
        }catch (InvariantException $exception) {
            return redirect()->back()->with('error', 'Gagal mengubah audit, terjadi kesalahan pada server');
        }
    }
}
