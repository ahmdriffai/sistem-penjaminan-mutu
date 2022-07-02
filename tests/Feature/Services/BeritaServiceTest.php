<?php

namespace Tests\Feature\Services;

use App\Helper\Media;
use App\Http\Requests\BeritaAddRequest;
use App\Http\Requests\BeritaUpdateRequest;
use App\Models\Berita;
use App\Services\BeritaService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class BeritaServiceTest extends TestCase
{
    use RefreshDatabase, Media;
    private BeritaService $beritaService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->beritaService = $this->app->make(BeritaService::class);
    }


    public function test_provider()
    {
        self::assertTrue(true);
    }

    public function test_add_berita_success()
    {
        $request = new BeritaAddRequest([
            'judul' => 'test judul',
            'isi' => 'test isi',
            'penulis' => 'test penulis',
        ]);

        $this->beritaService->add($request);

        $this->assertDatabaseCount('berita', 1);
        $this->assertDatabaseHas('berita', [
            'judul' => 'test judul',
            'isi' => 'test isi',
            'penulis' => 'test penulis',
        ]);
    }

    public function test_list_berita()
    {
        Berita::factory(20)->create();

        $list = $this->beritaService->list();

        self::assertSame(10, $list->count());

        $list = $this->beritaService->list('salah');

        self::assertSame(0 , $list->count());

        $list = $this->beritaService->list('', 5);

        self::assertSame(5 , $list->count());
    }

    public function test_update_berita_success()
    {
        $berita = Berita::factory()->create();

        $request = new BeritaUpdateRequest([
            'judul' => 'update judul',
            'isi' => 'update isi',
            'penulis' => 'update penulis'
        ]);

        $this->assertDatabaseCount('berita', 1);

        $this->beritaService->update($request,$berita->id);

        $this->assertDatabaseCount('berita', 1);

        $this->assertDatabaseHas('berita', [
            'judul' => 'update judul',
            'isi' => 'update isi',
            'penulis' => 'update penulis',
        ]);
    }

    public function test_delete_berita_withot_file_test()
    {
        $berita = Berita::factory()->create();

        $this->assertDatabaseCount('berita', 1);

        $this->beritaService->delete($berita->id);

        $this->assertDatabaseCount('berita', 0);
    }

    public function test_delete_berita_with_file() {
        $file = UploadedFile::fake()->create('file.jpg');
        $uploads = $this->uploads($file, 'test/');
        $berita = Berita::factory()->create(['gambar_path' => public_path('storage/'. $uploads['filePath'])]);

        self::assertFileExists($berita->gambar_path);
        $this->assertDatabaseCount('berita', 1);

        $this->beritaService->delete($berita->id);

        $this->assertDatabaseCount('berita', 0);
        self::assertFileDoesNotExist($berita->gambar_path);
    }

    public function test_add_image_berite_success()
    {
        $berita = Berita::factory()->create();

        $file = UploadedFile::fake()->create('file.jpg');

        $result = $this->beritaService->addImage($berita->id, $file);

        $this->assertDatabaseCount('berita', 1);
        $this->assertDatabaseHas('berita', [
            'gambar_path' => $result->gambar_path,
            'gambar_url' => $result->gambar_url,
        ]);

        self::assertFileExists($result->gambar_path);

        @unlink($result->file_path);
    }

    public function test_delete_image_success()
    {

        $file = UploadedFile::fake()->create('file.jpg');
        $uploads = $this->uploads($file, 'test/');
        $berita = Berita::factory()->create([
            'gambar_path' => public_path('storage/' . $uploads['filePath']),
            'gambar_url' => 'url'
        ]);

        self::assertFileExists($berita->gambar_path);
        $this->assertDatabaseCount('berita', 1);

        $this->beritaService->deleteImage($berita->id);

        $this->assertDatabaseCount('berita', 1);
        self::assertFileDoesNotExist($berita->gambar_path);

    }

    public function test_update_file_succes()
    {
        $file = UploadedFile::fake()->create('file.jpg');
        $uploads = $this->uploads($file, 'test/');
        $berita = Berita::factory()->create([
            'gambar_path' => public_path('storage/' . $uploads['filePath']),
            'gambar_url' => 'url'
        ]);


        self::assertFileExists($berita->gambar_path);
        $this->assertDatabaseCount('berita', 1);

        $newFile = UploadedFile::fake()->image('update-file.jpg');
        $result = $this->beritaService->updateImage($berita->id, $newFile);

        $this->assertDatabaseCount('berita', 1);

        self::assertFileDoesNotExist($berita->gambar_path);

        self::assertFileExists($result->gambar_path);

        self::assertNotSame($berita->gambar_path , $result->gambar_path);
        self::assertNotSame($berita->gambar_url , $result->gambar_url);

        @unlink($result->gambar_path);

    }
}
