<?php

namespace Tests\Feature\Services;

use App\Models\PenjaminanMutu;
use App\Services\PenjaminanMutuService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PenjaminanMutuServiceTest extends TestCase
{

    use RefreshDatabase;

    private PenjaminanMutuService $penjaminanMutuService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->penjaminanMutuService = $this->app->make(PenjaminanMutuService::class);
    }


    public function test_provider_penjaminan_mutu()
    {
        self::assertTrue(true);
    }

    public function test_add_penjaminan_mutu_success()
    {
        $nama = 'Standar Penjaminan Mutu';
        $keterangan = 'test keterangan';

        $this->penjaminanMutuService->add($nama, $keterangan);

        $this->assertDatabaseCount('penjaminan_mutu', 1);
        $this->assertDatabaseHas('penjaminan_mutu', [
            'nama' => 'Standar Penjaminan Mutu',
            'keterangan' => 'test keterangan',
        ]);

    }

    public function test_list_penjaminan_mutu()
    {
        PenjaminanMutu::factory(20)->create();

        $list = $this->penjaminanMutuService->list();

        self::assertSame(10, $list->count());

        $list = $this->penjaminanMutuService->list('salah');

        self::assertSame(0 , $list->count());

        $list = $this->penjaminanMutuService->list('', 5);

        self::assertSame(5 , $list->count());

    }

    public function test_update_penjaminan_mutu_success()
    {
        $penjaminanMutu = PenjaminanMutu::factory()->create();

        $nama = 'test update';
        $keterangan = 'keterangan update';

        $result = $this->penjaminanMutuService->update($nama, $keterangan, $penjaminanMutu->id);

        $this->assertDatabaseCount('penjaminan_mutu', 1);
        self::assertNotSame($penjaminanMutu->nama, $result->nama);
        self::assertNotSame($penjaminanMutu->keterangan, $result->ketarangan);
        $this->assertDatabaseCount('penjaminan_mutu', 1);
    }

    public function test_delete_penjaminan_mutu_success()
    {
        $penjaminanMutu = PenjaminanMutu::factory()->create();

        $this->assertDatabaseCount('penjaminan_mutu', 1);
        $this->penjaminanMutuService->delete($penjaminanMutu->id);
        $this->assertDatabaseCount('penjaminan_mutu', 0);
    }


}
