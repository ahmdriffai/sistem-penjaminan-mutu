<?php

namespace Tests\Feature\Services;

use App\Helper\Media;
use App\Http\Requests\DokumenMutuAddRequest;
use App\Http\Requests\DokumenMutuUpdateRequest;
use App\Models\DokumenMutu;
use App\Models\PenjaminanMutu;
use App\Services\DokumenMutuService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class DokumenMutuServiceTest extends TestCase
{
    use RefreshDatabase, Media;

    private DokumenMutuService $dokumenMutuService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->dokumenMutuService = $this->app->make(DokumenMutuService::class);
    }

    public function test_provider()
    {
        self::assertTrue(true);
    }

    public function test_add_dokumen_mutu_success()
    {
        $penjaminanMutu = PenjaminanMutu::factory()->create();

        $request = new DokumenMutuAddRequest([
            'kode_dokumen' => 'DOC-029098',
            'nama' => 'SOP Tahun 2020',
            'tahun' => 2022,
            'deskripsi' => 'test deskripsi',
        ]);


        $this->dokumenMutuService->add($request, $penjaminanMutu->id);

        $this->assertDatabaseCount('dokumen_mutu', 1);
        $this->assertDatabaseHas('dokumen_mutu', [
            'kode_dokumen' => 'DOC-029098',
            'nama' => 'SOP Tahun 2020',
            'tahun' => 2022,
            'deskripsi' => 'test deskripsi',
            'penjaminan_mutu_id' => $penjaminanMutu->id
        ]);
    }

    public function test_list_dokumen_mutu()
    {
        DokumenMutu::factory(20)->create();

        $list = $this->dokumenMutuService->list();

        self::assertSame(10, $list->count());

        $list = $this->dokumenMutuService->list('salah');

        self::assertSame(0 , $list->count());

        $list = $this->dokumenMutuService->list('', 5);

        self::assertSame(5 , $list->count());

    }

    public function test_list_dokumen_mutu_by_id()
    {
        $dokumenMutu1 = DokumenMutu::factory()->create();
        $dokumenMutu2 = DokumenMutu::factory()->create();

        $list = $this->dokumenMutuService->listById($dokumenMutu1->id);

        self::assertSame(1, $list->count());

        $list = $this->dokumenMutuService->listById($dokumenMutu1->id, 'salah');

        self::assertSame(0 , $list->count());

        $list = $this->dokumenMutuService->listById($dokumenMutu2->id);

        self::assertSame(1, $list->count());
    }

    public function test_update_dokumen_mutu_success()
    {
        $dokumentMutu = DokumenMutu::factory()->create();
        $penjaminaMutu = PenjaminanMutu::factory()->create();

        $request = new DokumenMutuUpdateRequest([
            'kode_dokumen' => 'kode-update-test',
            'nama' => 'nama update',
            'tahun' => 2050,
            'deskripsi' => 'deskripsi test',
        ]);


        $result = $this->dokumenMutuService->update(
            $request,
            $penjaminaMutu->id,
            $dokumentMutu->id
        );

        $this->assertDatabaseCount('dokumen_mutu' ,1);
        self::assertNotSame($dokumentMutu->kode_dokumen, $result->kode_dokumen);
        self::assertNotSame($dokumentMutu->nama, $result->nama);
        self::assertNotSame($dokumentMutu->tahun, $result->tahun);
        self::assertNotSame($dokumentMutu->deskripsi, $result->deskripsi);
        self::assertNotSame($dokumentMutu->penjaminan_mutu_id, $result->penjaminan_mutu_id);
    }

    public function test_delete_dokumen_mutu_()
    {
        $dokumenMutu = DokumenMutu::factory()->create();

        $this->assertDatabaseCount('dokumen_mutu', 1);

        $this->dokumenMutuService->delete($dokumenMutu->id);

        $this->assertDatabaseCount('dokumen_mutu', 0);
    }


    public function test_detail_penjaminan_mutu()
    {
        $dokumenMutu = DokumenMutu::factory()->create([]);

        $result = $this->dokumenMutuService->show($dokumenMutu->id);

        self::assertSame($dokumenMutu->judul, $result->judul);
        self::assertSame(1, $result->count());
    }
}
