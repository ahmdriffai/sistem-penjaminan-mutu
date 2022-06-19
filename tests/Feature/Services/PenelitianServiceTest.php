<?php

namespace Tests\Feature\Services;

use App\Exceptions\InvariantException;
use App\Http\Requests\PenelitianAddRequest;
use App\Http\Requests\PenelitianUpdateRequest;
use App\Models\Dosen;
use App\Models\Penelitian;
use App\Models\User;
use App\Services\PenelitianService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PenelitianServiceTest extends TestCase
{

    use RefreshDatabase;

    private PenelitianService $penelitianService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->penelitianService = $this->app->make(PenelitianService::class);
    }


    public function test_penelitian_provider()
    {
        self::assertTrue(true);
    }

    public function test_add_penelitian_has_owner()
    {
        $request = new PenelitianAddRequest([
            'judul' => 'test',
            'tanggal_mulai' => '2020-10-10',
            'tanggal_selesai' => '2021-10-10',
            'sumber_dana' => 'pemerintah',
            'jumlah' => 500000000,
            'sebagai' => 'Penulis 1',
        ]);

        $dosen = Dosen::factory()->create();


        $result = $this->penelitianService->add($request, $dosen->nidn);

        $this->assertDatabaseCount('penelitian', 1);
        $this->assertDatabaseHas('penelitian', [
            'judul' => 'test',
            'tanggal_mulai' => '2020-10-10',
            'tanggal_selesai' => '2021-10-10',
            'sumber_dana' => 'pemerintah',
            'jumlah' => 500000000,
            'publis' => 0,
            'owner' => $dosen->nidn,
        ]);
    }

    public function test_add_penelitian_without_owner()
    {
        $this->expectException(InvariantException::class);
        $request = new PenelitianAddRequest([
            'judul' => 'test',
            'tanggal_mulai' => '2020-10-10',
            'tanggal_selesai' => '2021-10-10',
            'sumber_dana' => 'pemerintah',
            'jumlah' => 500000000,
            'sebagai' => 'Penulis 1',
        ]);

        $owner = 'not found';

        $this->penelitianService->add($request, $owner);

    }

    public function test_list_penelitian()
    {
        Penelitian::factory(20)->create();

        $list = $this->penelitianService->list();

        self::assertSame(10, $list->count());

        $list = $this->penelitianService->list('salah');

        self::assertSame(0 , $list->count());

        $list = $this->penelitianService->list('', 5);

        self::assertSame(5 , $list->count());

    }

    public function test_update_penelitian()
    {
        $penelitian = Penelitian::factory()->create();

        $request = new PenelitianUpdateRequest([
            'judul' => 'test',
            'tanggal_mulai' => '2020-10-10',
            'tanggal_selesai' => '2021-10-10',
            'sumber_dana' => 'edit',
            'jumlaah' => 100000,
            'sebagai' => 'Peneliti 2',
        ]);

        $result = $this->penelitianService->update($request, $penelitian->id);

        self::assertNotSame($penelitian->judul, $result->judul);
        self::assertNotSame($penelitian->tanggal_mulai, $result->tanggal_mulai);
        self::assertNotSame($penelitian->tanggal_selesai, $result->tanggal_selesai);
        self::assertNotSame($penelitian->sumber_dana, $result->sumber_dana);
        self::assertNotSame($penelitian->jumlah, $result->jumlah);
        self::assertNotSame($penelitian->sebagai, $result->sebagai);
        $this->assertDatabaseCount('penelitian', 1);
    }

    public function test_delete_penelitian()
    {
        $penelitian = Penelitian::factory()->create();

        $this->assertDatabaseCount('penelitian', 1);

        $this->penelitianService->delete($penelitian->id);

        $this->assertDatabaseCount('penelitian', 0);
    }

    public function test_publis_penelitian()
    {
        $penelitian = Penelitian::factory()->create();

        $this->assertDatabaseHas('penelitian', [
            'publis' => 0
        ]);

        $this->penelitianService->publis($penelitian->id);


        $this->assertDatabaseHas('penelitian', [
            'publis' => 1
        ]);
    }


}
