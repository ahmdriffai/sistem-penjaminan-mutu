<?php

namespace App\Http\Controllers;

use App\Exceptions\InvariantException;
use App\Http\Requests\PenjaminanMutuAddRequest;
use App\Http\Requests\PenjaminanMutuUpdateRequest;
use App\Models\PenjaminanMutu;
use App\Services\DokumenMutuService;
use App\Services\PenjaminanMutuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PenjaminanMutuController extends Controller
{

    private string $title = 'Penjaminan Mutu';

    private PenjaminanMutuService $penjaminanMutuService;
    private DokumenMutuService $dokumenMutuService;

    public function __construct(PenjaminanMutuService $penjaminanMutuService, DokumenMutuService $dokumenMutuService)
    {
        $this->penjaminanMutuService = $penjaminanMutuService;
        $this->dokumenMutuService = $dokumenMutuService;
    }


    public function index(Request $request)
    {
        $title = $this->title;
        $key = $request->query('key') ?? '';
        $size = $request->query('size') ?? 10;
        $penjaminanMutu = $this->penjaminanMutuService->list('', 5);
        $dokumenMutu = $this->dokumenMutuService->list($key, $size);
        return response()->view('penjaminan-mutu.index', compact('title', 'penjaminanMutu', 'dokumenMutu'));
    }


    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'keterangan' => 'max:255',
            'icon' => 'image|mimes:jpg,png,jpeg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
        ]);

        if ($request->file('icon')) {
            $validatedData['icon']=$request->file('icon')->store('icon-mutu');
        }

        PenjaminanMutu::create($validatedData); 

        return redirect('/penjaminan-mutu')->with('success', 'Penjaminan mutu berhasil ditambahkan');
        // $nama = $request->input('nama');
        // $keterangan = $request->input('keterangan');
        // try {
        //     $this->penjaminanMutuService->add($nama, $keterangan);
        //     return redirect()->back()->with('success', 'Penjaminan mutu berhasil ditambahkan');
        // }catch (\Exception $exception) {
        //     return redirect()->back()->with('error', 'Penjaminan mutu gagal ditambahkan')->withInput($request->all());
        // }
    }

    public function edit($id)
    {
        $title = $this->title;
        $penjaminanMutu = PenjaminanMutu::find($id);
        return response()->view('penjaminan-mutu.edit', compact('penjaminanMutu', 'title'));
    }


    public function update(Request $request,PenjaminanMutu $penjaminanMutu)
    {
        //
        $rules = [
            'nama' => 'required|max:255',
            'keterangan' => 'max:255',
            'icon' => 'image|mimes:jpg,png,jpeg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
        ];

        $validatedData=$request->validate($rules);

        if ($request->file('icon')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['icon']=$request->file('icon')->store('icon-mutu');
        }

        PenjaminanMutu::where('id',$penjaminanMutu->id)
            ->update($validatedData); 

        return redirect('/penjaminan-mutu')->with('success','Penjaminan mutu berhasil diubah!');

        // $rules = [
        //     'nama' => 'required|max:255',
        //     'keterangan' => 'required|max:255',
        //     'icon' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
        // ];

        // $validatedData=$request->validate($rules);

        // if ($request->file('icon')) {
        //     if ($request->oldImage) {
        //         Storage::delete($request->oldImage);
        //     }
        //     $validatedData['icon']=$request->file('icon')->store('icon-mutu');
        // }

        // PenjaminanMutu::where('id',$penjaminanMutu->id)
        //     ->update($validatedData); 

        // return redirect('/penjaminan-mutu')->with('success', 'Penjaminan mutu berhasil diubah');
        
        // $nama = $request->input('nama');
        // $keterangan = $request->input('keterangan');

        
        // try {
        //     $this->penjaminanMutuService->update($nama, $keterangan, $id);
        //     return redirect(route('penjaminan-mutu.index'))->with('success', 'Penjaminan mutu berhasil diubah');
        // }catch (InvariantException $exception) {
        //     return redirect()->back()->with('error', 'Penjaminan mutu gagal diubah')->withInput($request->all());
        // }
    }

    public function destroy(PenjaminanMutu $penjaminanMutu)
    {
        if ($penjaminanMutu->icon) {
            Storage::delete($penjaminanMutu->icon);
        }
        PenjaminanMutu::destroy($penjaminanMutu->id); 

        return redirect('/penjaminan-mutu')->with('success','Penjaminan mutu berhasil dihapus!');
        // try {
        //     $this->penjaminanMutuService->delete($id);
        //     return redirect()->back()->with('success', 'Penjaminan mutu berhasil dihapus');
        // }catch (InvariantException $exception) {
        //     return redirect()->back()->with('error', 'Penjaminan mutu gagal dihapus');
        // }
    }
}
