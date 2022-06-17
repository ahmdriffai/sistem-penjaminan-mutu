<?php

namespace Tests\Feature\Services;

use App\Helper\Media;
use App\Models\Pengumuman;
use App\Services\PengumumanService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class PengumumanServiceTest extends TestCase
{

    use RefreshDatabase, Media;

    private PengumumanService $pengumumanService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->pengumumanService = $this->app->make(PengumumanService::class);
    }

    public function test_provider()
    {
        self::assertTrue(true);
    }

    public function test_tambah_pengumuman_sukses()
    {
        $judul = 'test judul';
        $isi = 'test isi';
        $result = $this->pengumumanService->add($judul, $isi);

        $this->assertDatabaseCount('pengumuman', 1);
        $this->assertDatabaseHas('pengumuman', [
           'judul' => 'test judul',
           'isi' => 'test isi',
            'file_path' => null,
            'file_url' => null,
        ]);
    }

    public function test_edit_pengumuman_sukses()
    {
        $pengumuman = Pengumuman::factory()->create();

        $judul = 'edit judul';
        $isi = 'edit isi';


        $this->assertDatabaseCount('pengumuman', 1);

        $result = $this->pengumumanService->edit($pengumuman->id, $judul, $isi);

        $this->assertDatabaseCount('pengumuman', 1);

        self::assertNotSame($pengumuman->judul, $result->judul);
        self::assertNotSame($pengumuman->isi, $result->isi);

        $this->assertDatabaseHas('pengumuman', [
            'judul' => 'edit judul',
            'isi' => 'edit isi',
        ]);
    }

    public function test_hapus_pengumuman_tanpa_file_test()
    {
        $pengumuman = Pengumuman::factory()->create();

        $this->assertDatabaseCount('pengumuman', 1);

        $this->pengumumanService->delete($pengumuman->id);

        $this->assertDatabaseCount('pengumuman', 0);
    }

    public function test_hapus_pengumuman_dengan_file_test() {
        $file = UploadedFile::fake()->create('file.pdf');

        $uploads = $this->uploads($file, 'test/');

        $pengumuman = Pengumuman::factory()->create(['file_path' => public_path('storage/'. $uploads['filePath'])]);

        self::assertFileExists($pengumuman->file_path);
        $this->assertDatabaseCount('pengumuman', 1);

        $this->pengumumanService->delete($pengumuman->id);

        $this->assertDatabaseCount('pengumuman', 0);
        self::assertFileDoesNotExist($pengumuman->file_path);
    }


    public function test_tambah_file_pengumuman_sukses()
    {
        $pengumuman = Pengumuman::factory()->create();

        $file = UploadedFile::fake()->create('file.pdf');

        $result = $this->pengumumanService->addFile($pengumuman->id, $file);

        $this->assertDatabaseCount('pengumuman', 1);
        $this->assertDatabaseHas('pengumuman', [
           'file_path' => $result->file_path,
           'file_url' => $result->file_url,
        ]);

        self::assertFileExists($result->file_path);

        @unlink($result->file_path);
    }

    public function test_delete_file_sukses()
    {

        $file = UploadedFile::fake()->create('file.pdf');
        $uploads = $this->uploads($file, 'test/');
        $pengumuman = Pengumuman::factory()->create([
            'file_path' => public_path('storage/' . $uploads['filePath']),
            'file_url' => 'url'
        ]);

        self::assertFileExists($pengumuman->file_path);
        $this->assertDatabaseCount('pengumuman', 1);

        $this->pengumumanService->deleteFile($pengumuman->id, $file);

        $this->assertDatabaseCount('pengumuman', 1);
        self::assertFileDoesNotExist($pengumuman->file_path);

    }

    public function test_edit_file_sukses()
    {
        $file = UploadedFile::fake()->create('file.pdf');
        $uploads = $this->uploads($file, 'test/');
        $pengumuman = Pengumuman::factory()->create([
            'file_path' => public_path('storage/' . $uploads['filePath']),
            'file_url' => 'url'
        ]);


        self::assertFileExists($pengumuman->file_path);
        $this->assertDatabaseCount('pengumuman', 1);

        $newFile = UploadedFile::fake()->create('file.pdf');
        $result = $this->pengumumanService->editFile($pengumuman->id, $newFile);

        $this->assertDatabaseCount('pengumuman', 1);

        self::assertFileDoesNotExist($pengumuman->file_path);

        self::assertFileExists($result->file_path);

        self::assertNotSame($pengumuman->file_path , $result->file_path);
        self::assertNotSame($pengumuman->file_url , $result->file_url);

        @unlink($result->file_path);

    }

    public function test_list_pengumuman()
    {
        Pengumuman::factory(20)->create();

        $list = $this->pengumumanService->list();

        self::assertSame(20, $list->count());

        Pengumuman::factory()->create(['judul' => 'test']);

        $search = $this->pengumumanService->list('test');

        self::assertSame(1, $search->count());

    }

    public function test_detail_pengumuman()
    {
        $pengumuman = Pengumuman::factory()->create([]);

        $result = $this->pengumumanService->show($pengumuman->id);

        self::assertSame($pengumuman->judul, $result->judul);
        self::assertSame(1, $result->count());
    }


}
