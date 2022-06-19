<?php

namespace Tests\Feature\Services;

use App\Exceptions\InvariantException;
use App\Http\Requests\PengabdianAddRequest;
use App\Http\Requests\PengabdianUpdateRequest;
use App\Models\Dosen;
use App\Models\Pengabdian;
use App\Services\PengabdianService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PengabdianServiceTest extends TestCase
{
    use RefreshDatabase;

    private PengabdianService $pengabdianService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->pengabdianService = $this->app->make(PengabdianService::class);
    }


    public function test_provider_pengabdian()
    {
        self::assertTrue(true);
    }

    public function test_add_pegabdian_with_owner()
    {
        $request = new PengabdianAddRequest([
            'judul' => 'test',
            'tanggal_mulai' => '2020-10-10',
            'tanggal_selesai' => '2021-10-10',
            'sumber_dana' => 'pemerintah',
            'jumlah' => 500000000,
            'sebagai' => 'Penulis 1',
        ]);

        $dosen = Dosen::factory()->create();


        $result = $this->pengabdianService->add($request, $dosen->nidn);

        $this->assertDatabaseCount('pengabdian', 1);
        $this->assertDatabaseHas('pengabdian', [
            'judul' => 'test',
            'tanggal_mulai' => '2020-10-10',
            'tanggal_selesai' => '2021-10-10',
            'sumber_dana' => 'pemerintah',
            'jumlah' => 500000000,
            'publis' => 0,
            'owner' => $dosen->nidn,
        ]);
    }

    public function test_add_pengabdian_without_owner()
    {
        $this->expectException(InvariantException::class);
        $request = new PengabdianAddRequest([
            'judul' => 'test',
            'tanggal_mulai' => '2020-10-10',
            'tanggal_selesai' => '2021-10-10',
            'sumber_dana' => 'pemerintah',
            'jumlah' => 500000000,
            'sebagai' => 'Penulis 1',
        ]);

        $owner = 'not found';

        $this->pengabdianService->add($request, $owner);

    }

    public function test_list_penelitian()
    {
        Pengabdian::factory(20)->create();

        $list = $this->pengabdianService->list();

        self::assertSame(10, $list->count());

        $list = $this->pengabdianService->list('salah');

        self::assertSame(0 , $list->count());

        $list = $this->pengabdianService->list('', 5);

        self::assertSame(5 , $list->count());

    }

    public function test_update_penelitian()
    {
        $pengabdian = Pengabdian::factory()->create();

        $request = new PengabdianUpdateRequest([
            'judul' => 'test',
            'tanggal_mulai' => '2020-10-10',
            'tanggal_selesai' => '2021-10-10',
            'sumber_dana' => 'edit',
            'jumlah' => 100000,
            'sebagai' => 'Penulis 2 Update',
        ]);

        $result = $this->pengabdianService->update($request, $pengabdian->id);

        self::assertNotSame($pengabdian->judul, $result->judul);
        self::assertNotSame($pengabdian->tanggal_mulai, $result->tanggal_mulai);
        self::assertNotSame($pengabdian->tanggal_selesai, $result->tanggal_selesai);
        self::assertNotSame($pengabdian->sumber_dana, $result->sumber_dana);
        self::assertNotSame($pengabdian->jumlah, $result->jumlah);
        self::assertNotSame($pengabdian->sebagai, $result->sebagai);
        $this->assertDatabaseCount('pengabdian', 1);
    }

    public function test_delete_penelitian()
    {
        $pengabdian = Pengabdian::factory()->create();

        $this->assertDatabaseCount('pengabdian', 1);

        $this->pengabdianService->delete($pengabdian->id);

        $this->assertDatabaseCount('pengabdian', 0);
    }

    public function test_publis_penelitian()
    {
        $pengabdian = Pengabdian::factory()->create();

        $this->assertDatabaseHas('pengabdian', [
            'publis' => 0
        ]);

        $this->pengabdianService->publis($pengabdian->id);


        $this->assertDatabaseHas('pengabdian', [
            'publis' => 1
        ]);
    }



}
