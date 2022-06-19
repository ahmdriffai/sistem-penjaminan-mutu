<?php

namespace Tests\Feature\Services;

use App\Exceptions\InvariantException;
use App\Http\Requests\PaperIlmiahAddRequest;
use App\Http\Requests\PaperIlmiahUpdateRequest;
use App\Models\Dosen;
use App\Models\PaperIlmiah;
use App\Services\PaperIlmiahService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaperIlmiahSeriviceTest extends TestCase
{

    use RefreshDatabase;

    private PaperIlmiahService $paperIlmiahService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->paperIlmiahService = $this->app->make(PaperIlmiahService::class);

    }


    public function test_provider_jurnal_ilmiah()
    {
        self::assertTrue(true);
    }

    public function test_add_paper_with_owner()
    {
        $dosen = Dosen::factory()->create();
        $request = new PaperIlmiahAddRequest([
            'judul' => 'test judul',
            'tahun' => 2020,
            'bulan' => 'juli',
            'media' => 'websote',
            'issn' => '1234',
            'sebagai' => 'penulis test',
            'indexs' => 'corpus',
            'kriteria' => 'jurnal internasional',
            'link' => 'http:\\test.test',
        ]);

        $owner = $dosen->nidn;

        $this->paperIlmiahService->add($request, $owner);

        $this->assertDatabaseCount('paper_ilmiah', 1);

        $this->assertDatabaseHas('paper_ilmiah', [
            'judul' => 'test judul',
            'tahun' => 2020,
            'bulan' => 'juli',
            'media' => 'websote',
            'issn' => '1234',
            'sebagai' => 'penulis test',
            'indexs' => 'corpus',
            'kriteria' => 'jurnal internasional',
            'link' => 'http:\\test.test',
        ]);

    }

    public function test_add_paper_without_owner() {
        $this->expectException(InvariantException::class);
        $request = new PaperIlmiahAddRequest([
            'judul' => 'test judul',
            'tahun' => 2020,
            'bulan' => 'juli',
            'media' => 'websote',
            'issn' => '1234',
            'sebagai' => 'penulis test',
            'indexs' => 'corpus',
            'kriteria' => 'jurnal internasional',
            'link' => 'http:\\test.test',
        ]);

        $owner = 'not found';

        $this->paperIlmiahService->add($request, $owner);
    }

    public function test_list_papaer_ilmiah()
    {
        PaperIlmiah::factory(20)->create();

        $list = $this->paperIlmiahService->list();

        self::assertSame(10, $list->count());

        $list = $this->paperIlmiahService->list('salah');

        self::assertSame(0 , $list->count());

        $list = $this->paperIlmiahService->list('', 5);

        self::assertSame(5 , $list->count());
    }


    public function test_update_paper_ilmiah_success()
    {
        $paperIlmiah = PaperIlmiah::factory()->create();

        $request = new PaperIlmiahUpdateRequest([
            'judul' => 'test judul update',
            'tahun' => 2021,
            'bulan' => 'juli update',
            'media' => 'websote update',
            'issn' => '1234124',
            'sebagai' => 'penulis test update',
            'indexs' => 'corpus update',
            'kriteria' => 'jurnal internasional update',
            'link' => 'http:\\test-update.test',
        ]);

        $result = $this->paperIlmiahService->update($request, $paperIlmiah->id);

        self::assertNotSame($paperIlmiah->judul , $result->judul);
        self::assertNotSame($paperIlmiah->tahun , $result->tahun);
        self::assertNotSame($paperIlmiah->bulan , $result->bulan);
        self::assertNotSame($paperIlmiah->media , $result->media);
        self::assertNotSame($paperIlmiah->issn , $result->issn);
        self::assertNotSame($paperIlmiah->sebagai , $result->sebagai);
        self::assertNotSame($paperIlmiah->indexs , $result->indexs);
        self::assertNotSame($paperIlmiah->kriteria , $result->kriteria);
        self::assertNotSame($paperIlmiah->link , $result->link);

        $this->assertDatabaseCount('paper_ilmiah', 1);
    }

    public function test_delete_paper_ilmiah_success()
    {
        $paperIlmiah = PaperIlmiah::factory()->create();

        $this->assertDatabaseCount('paper_ilmiah', 1);

        $this->paperIlmiahService->delete($paperIlmiah->id);

        $this->assertDatabaseCount('paper_ilmiah', 0);
    }

    public function test_publish_paper_ilmiah()
    {
        $paperIlmiah = PaperIlmiah::factory()->create();

        $this->assertDatabaseHas('paper_ilmiah', [
            'publis' => 0
        ]);

        $this->paperIlmiahService->publish($paperIlmiah->id);

        $this->assertDatabaseHas('paper_ilmiah', [
            'publis' => 1
        ]);
    }


}
