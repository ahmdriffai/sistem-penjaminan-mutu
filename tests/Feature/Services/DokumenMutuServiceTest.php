<?php

namespace Tests\Feature\Services;

use App\Helper\Media;
use App\Models\DokumenMutu;
use App\Models\PenjaminanMutu;
use App\Services\DokumenMutuService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class DokumenMutuServiceTest extends TestCase
{
    use RefreshDatabase, WithFaker, Media;

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

        $kodeDokumen = 'DOC-029098';
        $nama = 'SOP Tahun 2020';
        $tahun = 2022;
        $deskripsi = $this->faker->text();

        $this->dokumenMutuService->add($kodeDokumen, $nama, $tahun, $deskripsi, $penjaminanMutu->id);

        $this->assertDatabaseCount('dokumen_mutu', 1);
        $this->assertDatabaseHas('dokumen_mutu', [
            'kode_dokumen' => $kodeDokumen,
            'nama' => $nama,
            'tahun' => $tahun,
            'deskripsi' => $deskripsi,
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

    public function test_update_dokumen_mutu_success()
    {
        $dokumentMutu = DokumenMutu::factory()->create();
        $penjaminaMutu = PenjaminanMutu::factory()->create();

        $kodeDokumen = 'kode-update-test';
        $nama = 'nama update';
        $tahun = 2050;
        $deskripsi = 'deskripsi test';

        $result = $this->dokumenMutuService->update(
            $kodeDokumen,
            $nama,
            $tahun,
            $deskripsi,
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

    public function test_delete_dokumen_mutu_without_file()
    {
        $dokumenMutu = DokumenMutu::factory()->create();

        $this->assertDatabaseCount('dokumen_mutu', 1);

        $this->dokumenMutuService->delete($dokumenMutu->id);

        $this->assertDatabaseCount('dokumen_mutu', 0);
    }

    public function test_delete_dokumen_mutu_with_file()
    {
        $file = UploadedFile::fake()->create('file.pdf');
        $uploads = $this->uploads($file, 'test/');
        $dokumenMutu = DokumenMutu::factory()->create(['file_path' => public_path('storage/'. $uploads['filePath'])]);

        self::assertFileExists($dokumenMutu->file_path);
        $this->assertDatabaseCount('dokumen_mutu', 1);

        $this->dokumenMutuService->delete($dokumenMutu->id);

        $this->assertDatabaseCount('dokumen_mutu', 0);
        self::assertFileDoesNotExist($dokumenMutu->file_path);

    }

    public function test_add_file_dokumen_mutu()
    {
        $dokumenMutu = DokumenMutu::factory()->create();

        $file = UploadedFile::fake()->create('file.pdf');

        $result = $this->dokumenMutuService->addFile($dokumenMutu->id, $file);

        $this->assertDatabaseCount('dokumen_mutu', 1);
        $this->assertDatabaseHas('dokumen_mutu', [
            'file_path' => $result->file_path,
            'file_url' => $result->file_url,
        ]);

        self::assertFileExists($result->file_path);

        @unlink($result->file_path);
    }

    public function test_delete_file_success()
    {
        $file = UploadedFile::fake()->create('file.pdf');
        $uploads = $this->uploads($file, 'test/');
        $dokumenMutu = DokumenMutu::factory()->create([
            'file_path' => public_path('storage/' . $uploads['filePath']),
            'file_url' => 'url'
        ]);

        self::assertFileExists($dokumenMutu->file_path);
        $this->assertDatabaseCount('dokumen_mutu', 1);

        $this->dokumenMutuService->deleteFile($dokumenMutu->id, $file);

        $this->assertDatabaseCount('dokumen_mutu', 1);
        $this->assertDatabaseHas('dokumen_mutu', [
            'file_path' => null,
            'file_url' => null,
        ]);
        self::assertFileDoesNotExist($dokumenMutu->file_path);

    }

    public function test_update_file_penjaminan_mutu_success()
    {
        $file = UploadedFile::fake()->create('file.pdf');
        $uploads = $this->uploads($file, 'test/');
        $dokumenMutu = DokumenMutu::factory()->create([
            'file_path' => public_path('storage/' . $uploads['filePath']),
            'file_url' => 'url'
        ]);


        self::assertFileExists($dokumenMutu->file_path);
        $this->assertDatabaseCount('dokumen_mutu', 1);

        $newFile = UploadedFile::fake()->create('file.pdf');
        $result = $this->dokumenMutuService->updateFile($dokumenMutu->id, $newFile);

        $this->assertDatabaseCount('dokumen_mutu', 1);

        self::assertFileDoesNotExist($dokumenMutu->file_path);

        self::assertFileExists($result->file_path);

        self::assertNotSame($dokumenMutu->file_path , $result->file_path);
        self::assertNotSame($dokumenMutu->file_url , $result->file_url);

        @unlink($result->file_path);

    }

    public function test_detail_pengumuman()
    {
        $dokumenMutu = DokumenMutu::factory()->create([]);

        $result = $this->dokumenMutuService->show($dokumenMutu->id);

        self::assertSame($dokumenMutu->judul, $result->judul);
        self::assertSame(1, $result->count());
    }
}
